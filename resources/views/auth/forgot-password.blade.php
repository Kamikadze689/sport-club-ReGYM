@extends('layouts.app')

@section('title', 'Восстановление пароля')

@section('content')
<div class="container" style="max-width:500px;margin:80px auto;">
    <div class="form-container" style="background:var(--color-gray);padding:40px;border-radius:12px;">

        <h2 style="color:white;text-align:center;margin-bottom:30px;">
            Восстановление пароля
        </h2>

        @if(session('success'))
            <div style="background:rgba(16,185,129,.2);padding:12px;border-radius:8px;color:#10b981;margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Email</label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    required
                >

                @error('email')
                    <small style="color:#ff6b6b;">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <button
                type="submit"
                class="btn btn-primary"
                style="width:100%;">
                Отправить ссылку
            </button>
        </form>

    </div>
</div>
@endsection