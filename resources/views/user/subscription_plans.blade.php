@extends('layouts.app')

@section('title', 'Абонементы - ReGYM')

@section('content')
<section class="section">
    <div class="container">
        <h2 class="section-title fade-in">Наши <span>абонементы</span></h2>
        <p class="section-subtitle fade-in">Выберите подходящий тариф</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-top: 40px;">
            @foreach($plans as $plan)
            <div class="feature-card fade-in" style="background: var(--color-gray); text-align: center;">
                <h3 style="font-size: 24px; color: var(--color-yellow);">{{ $plan['name'] }}</h3>
                <p style="font-size: 36px; font-weight: bold; color: var(--color-white); margin: 20px 0;">
                    {{ number_format($plan['price'], 0, ',', ' ') }} ₽
                </p>
                <p style="color: var(--color-text-light); margin-bottom: 30px;">
                    Срок: {{ $plan['months'] }} {{ trans_choice('месяц|месяца|месяцев', $plan['months']) }}
                </p>
                <form method="POST" action="{{ route('payment.create') }}">
                    @csrf
                    <input type="hidden" name="plan_id" value="{{ $plan['id'] }}">
                    <input type="hidden" name="plan_name" value="{{ $plan['name'] }}">
                    <input type="hidden" name="price" value="{{ $plan['price'] }}">
                    <input type="hidden" name="months" value="{{ $plan['months'] }}">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Купить</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection