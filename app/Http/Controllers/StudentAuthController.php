<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentAuthController extends Controller
{
    // ── صفحة Login ──
    public function showLogin()
    {
        if (auth('student')->check()) {
            return redirect()->route('course');
        }
        return view('auth.login');
    }

    // ── معالجة Login ──
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $student = Student::where('username', $request->username)->first();

        if (! $student || ! Hash::check($request->password, $student->password)) {
            return back()->with('error', 'Invalid username or password.');
        }

        if (! $student->is_active) {
            return back()->with('error', 'Your account has been deactivated.');
        }

        auth('student')->login($student);

        return redirect()->route('course');
    }

    // ── Logout ──
    public function logout()
    {
        auth('student')->logout();
        return redirect()->route('login');
    }

    // ── صفحة الكورس ──
    public function course()
    {
        $student = auth('student')->user();
        return view('course', compact('student'));
    }
}
