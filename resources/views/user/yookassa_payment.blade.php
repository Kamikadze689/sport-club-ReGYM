@extends('layouts.app')

@section('title', 'Оплата через Юкассу - ReGYM')

@section('content')
<section class="section">
    <div class="container" style="max-width: 600px;">
        <div class="form-container fade-in" style="text-align: center;">
            <h2 style="color: var(--color-yellow); margin-bottom: 20px;">Оплата через Юкассу</h2>
            
            <div style="background: rgba(255,215,0,0.1); padding: 20px; border-radius: 12px; margin-bottom: 30px;">
                <p><strong>Товар:</strong> {{ $payment['item_name'] }}</p>
                <p><strong>Сумма к оплате:</strong> {{ number_format($amount, 0, ',', ' ') }} ₽</p>
                <p><strong>Номер платежа:</strong> {{ $paymentId }}</p>
            </div>
            
            
            <div style="background: rgba(16, 185, 129, 0.1); padding: 30px; border-radius: 12px; margin-bottom: 30px; border: 2px solid #10b981;">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" style="margin: 0 auto 20px;">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                    <line x1="1" y1="10" x2="23" y2="10"></line>
                    <circle cx="12" cy="14" r="2" fill="#10b981"></circle>
                </svg>
                <p style="color: #10b981; font-weight: bold; margin-bottom: 10px;">Тестовый режим оплаты Юкасса</p>
                <p style="color: var(--color-text-light); margin-bottom: 20px;">
                    Это демо-версия платежной системы. Для тестовой оплаты используйте:
                </p>
                <div style="text-align: left; background: rgba(0,0,0,0.3); padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    <p><strong>📱 Номер карты:</strong> 5555 5555 5555 4444</p>
                    <p><strong>📅 Срок:</strong> 12/25</p>
                    <p><strong>🔐 CVV:</strong> 123</p>
                </div>
                <button onclick="simulatePayment()" class="btn btn-primary" style="width: 100%; padding: 15px; background: linear-gradient(135deg, #10b981, #059669);">
                    💳 Оплатить {{ number_format($amount, 0, ',', ' ') }} ₽
                </button>
            </div>
            
            <form id="paymentForm" method="POST" action="{{ route('payment.yookassa.success') }}" style="display: none;">
                @csrf
                <input type="hidden" name="payment_id" value="{{ $paymentId }}">
            </form>
            
            <a href="{{ route('prices') }}" class="btn btn-outline-light" style="margin-top: 20px; display: inline-block;">
                ← Вернуться к выбору тарифа
            </a>
        </div>
    </div>
</section>

<script>
    function simulatePayment() {
        
        const alertDiv = document.createElement('div');
        alertDiv.style.cssText = `
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 30px;
            border-radius: 12px;
            z-index: 10000;
            animation: fadeIn 0.3s ease-out;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            text-align: center;
            min-width: 300px;
        `;
        alertDiv.innerHTML = `
            <div style="text-align: center;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" style="margin: 0 auto 15px;">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <p>Обработка платежа...</p>
                <p style="font-size: 12px; opacity: 0.8;">Пожалуйста, подождите</p>
            </div>
        `;
        document.body.appendChild(alertDiv);
        
        
        setTimeout(() => {
            alertDiv.remove();
            
            document.getElementById('paymentForm').submit();
        }, 2000);
    }
</script>
@endsection