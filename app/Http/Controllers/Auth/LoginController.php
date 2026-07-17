<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private const ADMIN_EMAIL = 'admin@gym.com';
    private const ADMIN_PASSWORD = 'admin123'; 

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($request->email === self::ADMIN_EMAIL && 
            $request->password === self::ADMIN_PASSWORD) {
            
            session(['admin_logged_in' => true]);
            session()->regenerate(); 

            return redirect()->route('admin.dashboard')
                ->with('success', 'Вы успешно вошли');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Неверный email или пароль']);
    }

    public function logout(Request $request)
    {
        session()->forget('admin_logged_in');
        session()->regenerateToken(); 

        return redirect('/')
            ->with('success', 'Вы вышли из системы');
    }
}