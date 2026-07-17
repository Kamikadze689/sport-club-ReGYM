@extends('layouts.app')

@section('title', 'Оплата - ReGYM')

@section('content')
<style>
    .payment-card {
        background: linear-gradient(135deg, rgba(255,215,0,0.1), rgba(255,215,0,0.05));
        border-radius: 20px;
        padding: 30px;
        text-align: center;
    }
    
    .btn-yookassa {
        background: linear-gradient(135deg, #1a73e8, #0d47a1);
        color: white !important;
        width: 100%;
        padding: 16px;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    
    .btn-yookassa:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(26,115,232,0.3);
    }
</style>

<section class="section">
    <div class="container" style="max-width: 550px;">
        <div class="form-container fade-in" style="text-align: center; padding: 40px;">
            <div style="margin-bottom: 25px;">
                <i class="fas fa-credit-card" style="font-size: 48px; color: var(--color-yellow);"></i>
            </div>
            <h2 style="color: var(--color-yellow); margin-bottom: 10px;">Оплата абонемента</h2>
            <p style="color: var(--color-text-light); margin-bottom: 25px;">Завершите покупку</p>
            
            <div class="payment-card">
                <div style="margin-bottom: 20px;">
                    <p><strong style="color: var(--color-white);">📦 Товар:</strong></p>
                    <p style="font-size: 18px; font-weight: bold; color: var(--color-yellow);">{{ $subscription->type }}</p>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
                    <div style="background: rgba(0,0,0,0.2); padding: 12px; border-radius: 10px;">
                        <p style="font-size: 12px; color: var(--color-text-light);">Сумма</p>
                        <p style="font-size: 24px; font-weight: bold; color: var(--color-yellow);">{{ number_format($subscription->price, 0, ',', ' ') }} ₽</p>
                    </div>
                    <div style="background: rgba(0,0,0,0.2); padding: 12px; border-radius: 10px;">
                        <p style="font-size: 12px; color: var(--color-text-light);">Действует до</p>
                        <p style="font-size: 18px; font-weight: bold; color: var(--color-white);">{{ $subscription->expires_at->format('d.m.Y') }}</p>
                    </div>
                </div>
            </div>
            
            
            <form method="POST" action="{{ route('yookassa.payment') }}">
                @csrf
                <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
                <button type="submit" class="btn-yookassa">
                    <i class="fas fa-lock"></i> Оплатить {{ number_format($subscription->price, 0, ',', ' ') }} ₽
                </button>
            </form>
            
            <div style="margin-top: 25px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1);">
                <a href="{{ route('prices') }}" style="color: var(--color-text-light); text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fas fa-arrow-left"></i> Вернуться к выбору абонемента
                </a>
            </div>
        </div>
    </div>
</section>
@endsection