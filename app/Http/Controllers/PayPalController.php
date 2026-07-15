<?php
namespace App\Http\Controllers;

use App\Mail\NewSaleAdminMail;
use App\Mail\RepeatPurchaseMail;
use App\Mail\StudentCredentialsMail;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    // ── صفحة الـ Checkout ──
    public function index()
    {
        return view('checkout');
    }

    // ── بدء عملية الدفع ──
    public function payment()
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent"              => "CAPTURE",
            "application_context" => [
                "brand_name"   => "Obada-Ar",
                "locale"       => "en-US",
                "landing_page" => "BILLING",
                "user_action"  => "PAY_NOW",
                "return_url"   => route('paypal.success'),
                "cancel_url"   => route('paypal.cancel'),
            ],
            "purchase_units"      => [[
                "description" => "Obada-Ar — Beginner's Course",
                "amount"      => [
                    "currency_code" => "USD",
                    "value"         => "49.00",
                ],
            ]],
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()->route('checkout')
            ->with('error', 'Something went wrong. Please try again.');
    }

    // ── بعد الدفع الناجح ──
    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {

            $payerName  = $response['payer']['name']['given_name'] ?? 'Student';
            $payerEmail = $response['payer']['email_address'];
            $orderId    = $response['id'];

            $this->fulfillOrder($payerName, $payerEmail, $orderId);

            return redirect()->route('thank-you')
                ->with('payer_name', $payerName);

        }

        return redirect()->route('checkout')
            ->with('error', 'Payment was not completed. Please try again.');
    }

    // ── لو ألغى الزبون الدفع ──
    public function paymentCancel()
    {
        return redirect()->route('checkout')
            ->with('error', 'Payment was cancelled.');
    }

    // ── Webhook: شبكة أمان لو المستخدم دفع بس ما رجع لصفحة success (تاب مسكرة/نت مقطوع) ──
    public function webhook(Request $request)
    {
        $event = $request->json()->all();

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $verification = $provider->verifyWebHook([
            'auth_algo'         => $request->header('PAYPAL-AUTH-ALGO'),
            'cert_url'          => $request->header('PAYPAL-CERT-URL'),
            'transmission_id'   => $request->header('PAYPAL-TRANSMISSION-ID'),
            'transmission_sig'  => $request->header('PAYPAL-TRANSMISSION-SIG'),
            'transmission_time' => $request->header('PAYPAL-TRANSMISSION-TIME'),
            'webhook_id'        => config('paypal.webhook_id'),
            'webhook_event'     => $event,
        ]);

        if (($verification['verification_status'] ?? null) !== 'SUCCESS') {
            Log::warning('PayPal webhook signature verification failed.', ['event' => $event]);
            return response()->json(['status' => 'invalid signature'], 400);
        }

        if (($event['event_type'] ?? null) === 'CHECKOUT.ORDER.COMPLETED') {
            $resource   = $event['resource'];
            $orderId    = $resource['id'] ?? null;
            $payerEmail = $resource['payer']['email_address'] ?? null;
            $payerName  = $resource['payer']['name']['given_name'] ?? 'Student';

            if ($orderId && $payerEmail) {
                $this->fulfillOrder($payerName, $payerEmail, $orderId);
            }
        }

        return response()->json(['status' => 'ok']);
    }

    // ── إنشاء/تحديث حساب الطالب وإرسال الإيميلات — مستعملة من مسار الـ redirect ومن الـ webhook معاً ──
    private function fulfillOrder(string $payerName, string $payerEmail, string $orderId): void
    {
        // idempotency: إذا سبق وعولج نفس الـ order (عن طريق الـ redirect أو الـ webhook)، ما نكرر شي
        if (Student::where('paypal_order_id', $orderId)->exists()) {
            return;
        }

        $existingStudent = Student::where('email', $payerEmail)->first();

        if ($existingStudent) {
            // ── طالب سبق واشترى: ما نلمس بيانات الدخول القديمة، فقط نحدّث حالة الطلب ──
            $existingStudent->update([
                'paypal_order_id' => $orderId,
                'is_active'       => true,
            ]);

            Mail::to($payerEmail)->queue(
                new RepeatPurchaseMail($payerName, $existingStudent->username)
            );
        } else {
            // ── طالب جديد: نولّد بيانات دخول ونرسلها ──
            $username = $this->generateUsername();
            $password = $this->generatePassword();

            Student::create([
                'name'            => $payerName,
                'email'           => $payerEmail,
                'username'        => $username,
                'password'        => Hash::make($password),
                'paypal_order_id' => $orderId,
                'is_active'       => true,
            ]);

            $pdfUrl = asset('files/arabic-pro-course.pdf');
            Mail::to($payerEmail)->queue(
                new StudentCredentialsMail($payerName, $username, $password, $pdfUrl)
            );
        }

        // ── إشعار الإدارة ببيع جديد ──
        Mail::to(config('services.admin_email'))->queue(
            new NewSaleAdminMail($payerName, $payerEmail, $orderId)
        );
    }

    // ── توليد Username فريد ──
    private function generateUsername(): string
    {
        do {
            $username = 'arabic_' . strtolower(Str::random(6));
        } while (Student::where('username', $username)->exists());

        return $username;
    }

    // ── توليد Password قوي ──
    private function generatePassword(): string
    {
        $lower = 'abcdefghjkmnpqrstuvwxyz';
        $upper = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        $nums  = '23456789';
        $spec  = '@#$!';

        $password = $upper[rand(0, strlen($upper) - 1)]
        . $lower[rand(0, strlen($lower) - 1)]
        . $nums[rand(0, strlen($nums) - 1)]
        . $spec[rand(0, strlen($spec) - 1)]
        . Str::random(5);

        // رتّب الحروف عشوائياً
        return str_shuffle($password);
    }
}
