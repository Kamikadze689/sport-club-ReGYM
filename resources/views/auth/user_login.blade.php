@extends('layouts.app')

@section('title', 'Вход - ReGYM')

@section('content')
<div class="container" style="max-width: 500px; margin: 80px auto;">
    <div class="form-container" style="background: var(--color-gray); padding: 40px; border-radius: 12px;">
        <h2 style="color: var(--color-white); text-align: center; margin-bottom: 30px;">Вход в аккаунт</h2>
        
        @if(session('success'))
            <div style="background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; padding: 12px; border-radius: 8px; margin-bottom: 20px; color: #10b981;">
                {{ session('success') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                @error('email') <small style="color: #ff6b6b;">{{ $message }}</small> @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Пароль</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%;">Войти</button>
            <p style="text-align:center;margin-top:15px;">
                <a
                    href="{{ route('password.request') }}"
                    style="color:var(--color-yellow);">
                    Забыли пароль?
                </a>
            </p>
        </form>
        
        <p style="text-align: center; margin-top: 20px; color: var(--color-text-light);">
            Нет аккаунта? <a href="{{ route('register') }}" style="color: var(--color-yellow);">Зарегистрироваться</a>
        </p>
    </div>
</div>
@endsection