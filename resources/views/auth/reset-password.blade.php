@extends('layouts.app')

@section('title', 'Новый пароль')

@section('content')
<div class="container" style="max-width:500px;margin:80px auto;">
    <div class="form-container" style="background:var(--color-gray);padding:40px;border-radius:12px;">

        <h2 style="color:white;text-align:center;margin-bottom:30px;">
            Новый пароль
        </h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="form-group">
                <label class="form-label">
                    Новый пароль
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label">
                    Повторите пароль
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    required
                >
            </div>

            <button
                type="submit"
                class="btn btn-primary"
                style="width:100%;">
                Сохранить пароль
            </button>

        </form>

    </div>
</div>
@endsection