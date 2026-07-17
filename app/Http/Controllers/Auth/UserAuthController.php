<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmailMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class UserAuthController extends Controller
{
    
    public function showRegisterForm()
    {
        return view('auth.user_register');
    }

    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_admin' => false,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addHours(24),
            [
                'id' => $user->id
            ]
        );

        Mail::to($user->email)
            ->send(new VerifyEmailMail($verificationUrl));

        return redirect()
            ->route('login')
            ->with(
                'success',
                'На вашу почту отправлено письмо для подтверждения регистрации.'
            );
    }

    
    public function verifyEmail(Request $request, $id)
    {
        if (! $request->hasValidSignature()) {
            abort(403);
        }

        $user = User::findOrFail($id);

        if (is_null($user->email_verified_at)) {
            $user->email_verified_at = now();
            $user->save();
        }

        return redirect()
            ->route('login')
            ->with('success', 'Почта успешно подтверждена.');
    }

    
    public function showLoginForm()
    {
        return view('auth.user_login');
    }

    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Пользователь не найден.',
            ]);
        }

        if (!$user->email_verified_at) {
            return back()->withErrors([
                'email' => 'Подтвердите Email перед входом в аккаунт.',
            ]);
        }

        if (Auth::attempt(
            $request->only('email', 'password')
        )) {
            $request->session()->regenerate();

            if (Auth::user()->is_admin) {
                return redirect()
                    ->route('admin.dashboard');
            }

            return redirect()
                ->intended(route('user.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Неверный email или пароль',
        ]);
    }

    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    
    public function dashboard()
    {
        $user = Auth::user();

        if ($user->is_admin) {
            return redirect()
                ->route('admin.dashboard');
        }

        $subscriptions = $user
            ->subscriptions()
            ->orderBy('created_at', 'desc')
            ->get();

        $activeSubscription = $user->activeSubscription();

        return view(
            'user.dashboard',
            compact(
                'user',
                'subscriptions',
                'activeSubscription'
            )
        );
    }
}