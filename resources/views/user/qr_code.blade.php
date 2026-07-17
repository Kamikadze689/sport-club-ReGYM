@extends('layouts.app')

@section('title', 'QR-код для входа - ReGYM')

@section('content')
<style>
    .qr-container {
        background: white;
        padding: 25px;
        border-radius: 24px;
        display: inline-block;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }
    
    .info-card {
        background: rgba(255,215,0,0.1);
        border-radius: 16px;
        padding: 20px;
        text-align: left;
        margin: 20px 0;
    }
    
    @media print {
        .header, .footer, .btn, .btn-outline-light, .btn-primary, nav, .scroll-indicator, .no-print {
            display: none !important;
        }
        .form-container {
            box-shadow: none;
            background: white;
            padding: 0;
        }
        .qr-container {
            box-shadow: none;
            padding: 0;
        }
        .info-card {
            background: #f5f5f5;
            color: black;
        }
    }
</style>

<section class="section">
    <div class="container" style="max-width: 550px;">
        <div class="form-container fade-in" style="text-align: center;">
            <div style="margin-bottom: 20px;">
                <i class="fas fa-qrcode" style="font-size: 48px; color: var(--color-yellow);"></i>
            </div>
            <h2 style="color: var(--color-yellow); margin-bottom: 10px;">Ваш пропуск в клуб</h2>
            <p style="color: var(--color-text-light); margin-bottom: 25px;">Покажите этот QR-код на входе</p>
            
            <div class="qr-container">
                @if($subscription->qr_code)
                    <img src="{{ $subscription->qr_code }}" alt="QR-код для входа" style="width: 250px; height: 250px;">
                @else
                    <div style="width: 250px; height: 250px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border-radius: 16px;">
                        <span style="color: #999;">QR-код не сгенерирован</span>
                    </div>
                @endif
            </div>
            
            <div class="info-card">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div>
                        <p style="font-size: 11px; color: var(--color-yellow); text-transform: uppercase;">👤 Владелец</p>
                        <p style="font-weight: 600;">{{ $subscription->user->name }}</p>
                    </div>
                    <div>
                        <p style="font-size: 11px; color: var(--color-yellow); text-transform: uppercase;">📱 Телефон</p>
                        <p style="font-weight: 600;">{{ $subscription->user->phone }}</p>
                    </div>
                    <div>
                        <p style="font-size: 11px; color: var(--color-yellow); text-transform: uppercase;">🏷️ Абонемент</p>
                        <p style="font-weight: 600; font-size: 13px;">{{ $subscription->type }}</p>
                    </div>
                    <div>
                        <p style="font-size: 11px; color: var(--color-yellow); text-transform: uppercase;">📅 Действует до</p>
                        <p style="font-weight: 600;">{{ $subscription->expires_at->format('d.m.Y') }}</p>
                    </div>
                    <div>
                        <p style="font-size: 11px; color: var(--color-yellow); text-transform: uppercase;">💰 Стоимость</p>
                        <p style="font-weight: 600;">{{ number_format($subscription->price, 0, ',', ' ') }} ₽</p>
                    </div>
                    <div>
                        <p style="font-size: 11px; color: var(--color-yellow); text-transform: uppercase;">🆔 ID</p>
                        <p style="font-weight: 600;">#{{ $subscription->id }}</p>
                    </div>
                </div>
            </div>
            
            <div class="no-print" style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 20px;">
                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-light">
                    <i class="fas fa-arrow-left"></i> В личный кабинет
                </a>
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="fas fa-print"></i> Распечатать
                </button>
                <button onclick="downloadQR()" class="btn btn-outline-light">
                    <i class="fas fa-download"></i> Скачать QR
                </button>
            </div>
        </div>
    </div>
</section>

<script>
    function downloadQR() {
        const qrImg = document.querySelector('.qr-container img');
        if (qrImg && qrImg.src) {
            const link = document.createElement('a');
            link.download = 'qrcode_{{ $subscription->id }}.png';
            link.href = qrImg.src;
            link.click();
        } else {
            alert('QR-код недоступен для скачивания');
        }
    }
</script>
@endsection