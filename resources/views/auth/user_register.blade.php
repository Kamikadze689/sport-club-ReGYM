@extends('layouts.app')

@section('title', 'Регистрация - ReGYM')

@section('content')
<div class="container" style="max-width: 500px; margin: 80px auto;">
    <div class="form-container" style="background: var(--color-gray); padding: 40px; border-radius: 12px;">
        <h2 style="color: var(--color-white); text-align: center; margin-bottom: 30px;">Регистрация</h2>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Имя и фамилия</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name') <small style="color: #ff6b6b;">{{ $message }}</small> @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email') <small style="color: #ff6b6b;">{{ $message }}</small> @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Телефон</label>
                <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="+7 (___) ___-__-__" required>
                @error('phone') <small style="color: #ff6b6b;">{{ $message }}</small> @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Пароль</label>
                <input type="password" name="password" class="form-control" required>
                @error('password') <small style="color: #ff6b6b;">{{ $message }}</small> @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Подтверждение пароля</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%;">Зарегистрироваться</button>
        </form>
        
        <p style="text-align: center; margin-top: 20px; color: var(--color-text-light);">
            Уже есть аккаунт? <a href="{{ route('login') }}" style="color: var(--color-yellow);">Войти</a>
        </p>
    </div>
</div>
@endsection