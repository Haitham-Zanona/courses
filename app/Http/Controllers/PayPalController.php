<?php
namespace App\Http\Controllers;

use App\Mail\StudentCredentialsMail;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

            // ── توليد بيانات تسجيل الدخول ──
            $username = $this->generateUsername();
            $password = $this->generatePassword();

            // البحث عن الطالب بالإيميل، إذا وجده يحدث بياناته، وإذا لم يجده ينشئ حساباً جديداً
            Student::updateOrCreate(
                ['email' => $payerEmail], // شرط البحث
                [
                    'name'            => $payerName,
                    'username'        => $username,
                    'password'        => Hash::make($password),
                    'paypal_order_id' => $orderId,
                    'is_active'       => true,
                ]
            );

            // ── إرسال الإيميل مع بيانات الدخول والـ PDF ──
            Mail::to($payerEmail)->send(
                new StudentCredentialsMail($payerName, $username, $password)
            );

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