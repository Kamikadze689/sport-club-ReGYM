<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SimpleAuthController extends Controller
{
    
    private $adminCredentials = [
        'email' => 'admin@gym.com',
        'password' => 'admin123', 
        'name' => 'Администратор'
    ];

    
    public function showLoginForm()
    {
        return view('auth.simple_login');
    }

    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        
        if ($request->email === $this->adminCredentials['email'] && 
            $request->password === $this->adminCredentials['password']) {
            
            
            session([
                'admin_logged_in' => true,
                'admin_name' => $this->adminCredentials['name'],
                'admin_email' => $this->adminCredentials['email']
            ]);
            
            return redirect()->intended('admin');
        }

        return back()->withErrors([
            'email' => 'Неверные учетные данные',
        ]);
    }

    
    public function logout(Request $request)
    {
        session()->forget(['admin_logged_in', 'admin_name', 'admin_email']);
        return redirect('/');
    }
}