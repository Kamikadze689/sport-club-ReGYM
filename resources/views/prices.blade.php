@extends('layouts.app')

@section('title', 'Цены - ReGYM Фитнес клуб')
@section('content')
<style>



.prices-hero-v2 {
    position: relative;
    min-height: 60vh;
    display: flex;
    align-items: center;
    color: white;
    overflow: hidden;
    padding: 70px 0 25px;
    z-index: 1;
}

.prices-background-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center 40%;
    animation: zoomIn 20s infinite alternate ease-in-out;
    background-attachment: fixed;
}

@keyframes zoomIn {
    0% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1.1);
    }
}

.prices-hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, 
        rgba(0, 0, 0, 0.95) 0%, 
        rgba(29, 31, 43, 0.9) 40%, 
        rgba(29, 31, 43, 0.6) 100%);
    z-index: 2;
}

.prices-hero-content-v2 {
    position: relative;
    z-index: 3;
    width: 100%;
    animation: fadeIn 1.5s ease-out 0.2s both;
    display: flex;
    align-items: center;
    min-height: calc(70vh - 25px);
    padding-bottom: 100px;
}

.prices-text-wrapper {
    max-width: 780px;
    width: 100%;
    padding: 5px 20px;
    position: relative;
    z-index: 4;
    box-sizing: border-box;
    text-align: left;
}

.prices-logo-title {
    display: flex;
    align-items: center; 
    gap: 12px;
    margin-bottom: 10px;
    animation: slideInLeft 1s ease-out 0.3s both;
    justify-content: flex-start;
}

.prices-logo-img-hero {
    width: 65px;
    height: 65px;
    object-fit: contain;
    filter: drop-shadow(0 4px 8px rgba(255, 215, 0, 0.3));
    animation: pulse 2s infinite alternate;
}

.prices-logo-text-hero {
    font-size: clamp(32px, 4.5vw, 48px);
    font-weight: 800;
    color: var(--color-white);
    text-transform: uppercase;
    letter-spacing: 1.5px;
    line-height: 1;
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}

.prices-logo-yellow {
    color: var(--color-yellow);
    text-shadow: 0 2px 4px rgba(255, 215, 0, 0.3);
}

.prices-logo-white {
    color: var(--color-white);
}

.prices-hero-title-v2 {
    font-size: clamp(1.8rem, 3.5vw, 2.4rem);
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 0.6rem;
    position: relative;
    text-align: left;
}

.prices-hero-subtitle-main {
    display: block;
    font-size: clamp(1.5rem, 3vw, 2.1rem);
    line-height: 1.1;
    margin-top: 5px;
    background: linear-gradient(90deg, var(--color-white), var(--color-yellow));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: slideInUp 1s ease-out 0.6s both;
    text-align: left;
}

.prices-hero-subtitle-v2 {
    font-size: clamp(0.95rem, 1.6vw, 1.1rem);
    line-height: 1.5;
    margin-bottom: 1rem;
    opacity: 0.95;
    animation: fadeIn 1s ease-out 0.9s both;
    position: relative;
    padding-left: 15px;
    border-left: 3px solid var(--color-yellow);
    padding-right: 15px;
    text-align: left;
}

.prices-hero-actions {
    display: flex;
    flex-direction: row;
    gap: 15px;
    width: 500px;
    align-items: flex-start;
    animation: fadeIn 1s ease-out 1.2s both;
    margin-bottom: 10px;
    flex-wrap: nowrap;
}

.btn-primary {
    background: linear-gradient(135deg, var(--color-yellow), var(--color-yellow-dark));
    color: var(--color-black);
    padding: 12px 24px;
    font-size: 1rem;
    font-weight: 600;
    border: none;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.2);
    flex: 1;
    min-width: 0;
    white-space: nowrap;
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.3);
}

.btn-outline-light {
    background: transparent;
    color: white;
    border: 2px solid white;
    padding: 10px 22px;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 4px;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    flex: 1;
    min-width: 0;
    white-space: nowrap;
}

.btn-outline-light:hover {
    background: white;
    color: var(--color-black);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2);
}


.prices-hero-disc-left {
    position: absolute;
    width: 325px;
    height: 325px;
    left: -100px;
    bottom: -40px;
    z-index: 3;
    filter: 
        drop-shadow(0 4px 8px rgba(0, 0, 0, 0.4))
        opacity(0.9);
    animation: floatDiscLeft 3s infinite ease-in-out;
}

.prices-hero-disc-right {
    position: absolute;
    width: 250px;
    height: 250px;
    right: 20px;
    top: 20%;
    z-index: 3;
    filter: 
        drop-shadow(0 4px 8px rgba(0, 0, 0, 0.4))
        opacity(0.9);
    animation: floatDiscRight 3s infinite ease-in-out 0.5s;
}


.prices-grid-section {
    padding: 12px 10px 20px;
    background: #1d1f2b;
}

.section-title {
    font-family: 'Oswald', sans-serif;
    font-size: clamp(1.8rem, 3.5vw, 2.5rem);
    font-weight: 800;
    color: #fff;
    text-align: center;
    margin-top: 30px;
    margin-bottom: 30px;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    padding-bottom: 15px;
}

.section-title span {
    color: #fcc900;
    position: relative;
}

.prices-category-container {
    margin-bottom: 20px;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 8px;
    padding: 12px;
    border: 1px solid rgba(255, 215, 0, 0.1);
}

.category-title-row {
    margin-bottom: 8px;
    padding-bottom: 8px;
    border-bottom: 1px solid rgba(255, 215, 0, 0.3);
}

.category-title-main {
    font-family: 'Oswald', sans-serif;
    font-size: 17px;
    color: #fcc900;
    font-weight: 700;
    margin: 0 0 4px;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    display: inline-block;
    padding-bottom: 6px;
}

.category-title-main:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 2px;
    background: #fcc900;
    border-radius: 2px;
}

.category-description {
    font-family: 'Inter', sans-serif;
    color: rgba(255, 255, 255, 0.85);
    font-size: 13px;
    line-height: 1.4;
    margin-top: 6px;
    padding-left: 5px;
}

.objects-table-section {
    width: 100%;
    border-radius: 6px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.02);
    margin-top: 10px;
}

.objects-table-title {
    font-family: 'Oswald', sans-serif;
    font-size: 14px;
    color: #fff;
    font-weight: 700;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 12px 0;
}

.objects-table-title:before {
    content: '';
    width: 4px;
    height: 18px;
    background: #fcc900;
    display: inline-block;
}

.objects-table {
    width: 100%;
    border-collapse: collapse;
}

.objects-table thead {
    background: rgba(255, 215, 0, 0.08);
}

.objects-table th {
    font-family: 'Oswald', sans-serif;
    font-size: 11.5px;
    font-weight: 700;
    color: #fcc900;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 8px 6px;
    text-align: left;
    border-bottom: 2px solid rgba(255, 215, 0, 0.3);
}

.objects-table tbody tr {
    background: rgba(255, 255, 255, 0.02);
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.objects-table tbody tr.popular-row {
    background: rgba(255, 215, 0, 0.06);
    position: relative;
}

.popular-badge {
    position: absolute;
    left: -6px;
    top: 50%;
    transform: translateY(-50%) rotate(-90deg);
    background: #fcc900;
    color: #000;
    padding: 3px 8px;
    font-family: 'Oswald', sans-serif;
    font-size: 9px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-radius: 3px;
    white-space: nowrap;
}

.objects-table td {
    font-family: 'Inter', sans-serif;
    font-size: 12.5px;
    color: rgba(255, 255, 255, 0.9);
    padding: 8px 6px;
    border-right: 1px solid rgba(255, 255, 255, 0.05);
}

.objects-table td:last-child {
    border-right: none;
}

.object-name-cell {
    font-family: 'Oswald', sans-serif;
    font-size: 13px;
    font-weight: 600;
    color: #fff;
    position: relative;
}

.object-name-cell .object-name {
    margin-bottom: 3px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.property-value-cell {
    color: rgba(255, 255, 255, 0.8);
}

.action-cell {
    text-align: center;
    width: 120px;
}

.action-btn {
    display: inline-block;
    background: rgba(255, 215, 0, 0.1);
    color: #fcc900;
    padding: 6px 12px;
    border-radius: 4px;
    font-family: 'Oswald', sans-serif;
    font-weight: 600;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: 1px solid rgba(255, 215, 0, 0.3);
    transition: all 0.2s ease;
    font-size: 11px;
    white-space: nowrap;
    cursor: pointer;
}

.action-btn:hover {
    background: rgba(255, 215, 0, 0.2);
}

.buy-btn {
    background: linear-gradient(135deg, var(--color-yellow), #fbbf24);
    color: #000;
    border: none;
    font-weight: 700;
}

.buy-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 215, 0, 0.3);
}


.prices-form-section {
    padding: 80px 0;
    background: #2a2c3a;
}

.prices-form-title {
    font-family: 'Oswald', sans-serif;
    font-size: clamp(1.8rem, 3vw, 2.5rem);
    font-weight: 800;
    color: var(--color-white);
    text-align: center;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.prices-form-subtitle {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.9rem, 1.5vw, 1.1rem);
    color: rgba(255, 255, 255, 0.7);
    text-align: center;
    margin-bottom: 50px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.prices-form-container {
    max-width: 600px;
    margin: 0 auto;
    background: #404153;
    padding: 40px;
    border-radius: 12px;
    backdrop-filter: blur(10px);
}

.form-group select.form-control,
.form-group input.form-control,
.form-group textarea.form-control {
    background-color: #51556d !important;
    color: white !important;
    border: none !important;
    border-radius: 6px;
    padding: 12px 15px;
    font-family: 'Inter', sans-serif;
    font-size: 0.95rem;
    width: 100%;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.form-group select.form-control {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23FFD700' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 16px;
    padding-right: 45px;
}

.form-group input.form-control:focus,
.form-group textarea.form-control:focus,
.form-group select.form-control:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(255, 215, 0, 0.3);
}

.form-group input.form-control::placeholder,
.form-group textarea.form-control::placeholder {
    color: rgba(255, 255, 255, 0.5) !important;
}

.form-submit-btn {
    background: linear-gradient(135deg, var(--color-yellow), #fbbf24);
    color: var(--color-black);
    padding: 15px 30px;
    font-family: 'Oswald', sans-serif;
    font-weight: 600;
    font-size: 1rem;
    border: none;
    border-radius: 6px;
    width: 100%;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.form-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 215, 0, 0.3);
}


@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-up {
    animation: fadeInUp 0.8s ease-out both;
}

.delay-1 { animation-delay: 0.2s; }
.delay-2 { animation-delay: 0.4s; }
.delay-3 { animation-delay: 0.6s; }


@media (max-width: 768px) {
    .action-cell {
        width: auto;
    }
    .action-btn {
        padding: 4px 8px;
        font-size: 10px;
    }
}
</style>


<section class="prices-hero-v2">
    <div class="prices-background-image" style="background-image: url('{{ asset('storage/2025-10-22_18-57-39.png') }}');"></div>
    <div class="prices-hero-overlay"></div>

    <div class="container prices-hero-content-v2">
        <div class="prices-text-wrapper">
            <div class="prices-logo-title">
                <img src="/storage/ReGymSymbol.png" alt="ReGYM Logo" class="prices-logo-img-hero">
                <span class="prices-logo-text-hero">
                    <span class="prices-logo-yellow">Re</span><span class="prices-logo-white">GYM</span>
                </span>
            </div>
            
            <h1 class="prices-hero-title-v2 fade-in">
                <span class="prices-hero-subtitle-main">Тарифы и цены</span>
            </h1>
                
            <p class="prices-hero-subtitle-v2 fade-in">
                <strong>Гибкая система тарифов для любых целей.</strong><br>
                Выбирайте подходящий вариант: от разовых тренировок до годовых абонементов со скидками.
            </p>
            
            <div class="prices-hero-actions fade-in delay-2">
                <a href="#prices-grid" class="btn btn-primary">Выбрать тариф</a>
                <a href="#request" class="btn btn-outline-light">Консультация</a>
            </div>
        </div>
    </div>
</section>


<section class="prices-grid-section" id="prices-grid">
    <div class="container">
        <h2 class="section-title fade-in-up">Наши <span style="color: #fcc900;">тарифы</span></h2>
        <p class="section-subtitle fade-in-up delay-1">Выберите подходящий вариант для достижения ваших целей</p>
        
        @forelse($categories as $category)
            @if($category->items->count() > 0)
            <div class="prices-category-container fade-in-up delay-2">
                <div class="category-title-row">
                    <h3 class="category-title-main">{{ $category->name }}</h3>
                    @if($category->description)
                    <div class="category-description">{{ $category->description }}</div>
                    @endif
                </div>

                <div class="objects-table-section">
                    <h4 class="objects-table-title">Доступные тарифы</h4>
                    <div class="table-responsive">
                        <table class="objects-table">
                            <thead>
                                <tr>
                                    <th>Тариф</th>
                                    @if($category->properties->count() > 0)
                                        @foreach($category->properties as $property)
                                        <th>{{ $property->name }}</th>
                                        @endforeach
                                    @endif
                                    <th>Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category->items as $item)
                                <tr class="{{ $item->is_popular ? 'popular-row' : '' }}">
                                    @if($item->is_popular)
                                    <td colspan="100%" style="position: relative;">
                                        <div class="popular-badge" style="position: absolute; left: -6px; top: 50%; transform: translateY(-50%) rotate(-90deg);">ПОПУЛЯРНЫЙ</div>
                                    </td>
                                    @endif
                                    
                                    <td class="object-name-cell">
                                        <div class="object-name">{{ $item->name }}</div>
                                    </td>
                                    
                                    @if($category->properties->count() > 0)
                                        @foreach($category->properties as $property)
                                        <td class="property-value-cell">
                                            @php
                                                $value = $item->getPropertyValue($property->name) ?? '-';
                                            @endphp
                                            {{ $value }}
                                        </td>
                                        @endforeach
                                    @endif

                                    <td class="action-cell">
                                        @auth
                                            @php
                                                $availablePrices = $item->getAvailablePrices();
                                            @endphp
                                            
                                            @if(count($availablePrices) > 1)
                                                
                                                <select class="price-select-{{ $item->id }}" data-item-id="{{ $item->id }}" style="background: #51556d; color: white; padding: 5px 10px; border-radius: 6px; border: 1px solid #FFD700; margin-bottom: 8px; width: 100%;">
                                                    <option value="">Выберите тип</option>
                                                    @foreach($availablePrices as $type => $priceInfo)
                                                        <option value="{{ $type }}" data-price="{{ $priceInfo['price'] }}">
                                                            {{ $priceInfo['name'] }} - {{ number_format($priceInfo['price'], 0, ',', ' ') }} ₽
                                                        </option>
                                                    @endforeach
                                                </select>
                                                
                                                <form method="POST" action="{{ route('payment.create') }}" class="buy-form-{{ $item->id }}" style="display: none;">
                                                    @csrf
                                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                    <input type="hidden" name="price_type" class="price-type-input-{{ $item->id }}" value="">
                                                    <button type="submit" class="action-btn buy-btn" style="background: linear-gradient(135deg, var(--color-yellow), #fbbf24); color: #000; border: none; cursor: pointer; width: 100%;">
                                                        Купить
                                                    </button>
                                                </form>
                                            @elseif(count($availablePrices) == 1)
                                                @php 
                                                    $singleType = array_key_first($availablePrices);
                                                    $singlePrice = reset($availablePrices);
                                                @endphp
                                                <form method="POST" action="{{ route('payment.create') }}" style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                    <input type="hidden" name="price_type" value="{{ $singleType }}">
                                                    <button type="submit" class="action-btn buy-btn" style="background: linear-gradient(135deg, var(--color-yellow), #fbbf24); color: #000; border: none; cursor: pointer;">
                                                        Купить за {{ number_format($singlePrice['price'], 0, ',', ' ') }} ₽
                                                    </button>
                                                </form>
                                            @else
                                                <span style="color: #999;">Цена не указана</span>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" class="action-btn" style="background: rgba(255, 215, 0, 0.1);">
                                                Войти для покупки
                                            </a>
                                        @endauth
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        @empty
            <div style="text-align:center; padding:30px; color:rgba(255,255,255,0.6);">
                <h3>Цены временно недоступны</h3>
                <p>Свяжитесь с администратором</p>
            </div>
        @endforelse
    </div>
</section>


<section class="prices-form-section" id="request">
    <div class="container">
        <h2 class="prices-form-title fade-in-up">Оставить <span style="color: var(--color-yellow);">заявку</span></h2>
        <p class="prices-form-subtitle fade-in-up delay-1">
            Заполните форму и мы поможем выбрать оптимальный тариф под ваши цели
        </p>
        
        <div class="prices-form-container fade-in-up delay-2">
            <form id="pricesRequestForm">
                @csrf
                <input type="hidden" name="request_type" value="price_consultation">
                
                <div class="form-group">
                    <select name="price_category" class="form-control" id="price_category">
                        <option value="">Выберите направление</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <input type="text" name="full_name" class="form-control" id="full_name" placeholder="ФИО" required value="{{ Auth::check() ? Auth::user()->name : '' }}">
                </div>
                
                <div class="form-group">
                    <input type="tel" name="phone" class="form-control" id="phone" placeholder="Телефон" required value="{{ Auth::check() ? Auth::user()->phone : '' }}">
                </div>
                
                <div class="form-group">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email (необязательно)" value="{{ Auth::check() ? Auth::user()->email : '' }}">
                </div>
                
                <div class="form-group">
                    <textarea name="message" class="form-control" id="message" rows="4" placeholder="Ваши цели и пожелания (необязательно)"></textarea>
                </div>
                
                <button type="submit" class="form-submit-btn">
                    Отправить заявку
                </button>
            </form>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    const pricesRequestForm = document.getElementById('pricesRequestForm');
    if (pricesRequestForm) {
        pricesRequestForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            
            submitBtn.innerHTML = '<span>Отправка...</span>';
            submitBtn.disabled = true;
            
            try {
                const response = await fetch("{{ route('request.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    
                    const alertDiv = document.createElement('div');
                    alertDiv.style.cssText = `
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        background: linear-gradient(135deg, var(--color-yellow), #fbbf24);
                        color: var(--color-black);
                        padding: 20px;
                        border-radius: 8px;
                        z-index: 10000;
                        animation: fadeIn 0.3s ease-out;
                        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
                        font-family: 'Inter', sans-serif;
                        font-weight: 600;
                        max-width: 300px;
                    `;
                    alertDiv.innerHTML = `
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            <span>${data.message}</span>
                        </div>
                    `;
                    document.body.appendChild(alertDiv);
                    
                    setTimeout(() => {
                        alertDiv.style.animation = 'fadeOut 0.3s ease-out';
                        setTimeout(() => alertDiv.remove(), 300);
                    }, 5000);
                    
                    
                    document.getElementById('message').value = '';
                } else {
                    showError(data.message || 'Ошибка при отправке заявки');
                }
            } catch (error) {
                showError('Ошибка сети');
            } finally {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }
        });
    }
    
    function showError(message) {
        const alertDiv = document.createElement('div');
        alertDiv.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            padding: 20px;
            border-radius: 8px;
            z-index: 10000;
            animation: fadeIn 0.3s ease-out;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            max-width: 300px;
        `;
        alertDiv.innerHTML = `
            <div style="display: flex; align-items: center; gap: 10px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
                <span>${message}</span>
            </div>
        `;
        document.body.appendChild(alertDiv);
        
        setTimeout(() => {
            alertDiv.style.animation = 'fadeOut 0.3s ease-out';
            setTimeout(() => alertDiv.remove(), 300);
        }, 5000);
    }
    
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in-up');
            }
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.prices-category-container, .objects-table-section, .prices-form-container').forEach((el) => {
        observer.observe(el);
    });
});


document.querySelectorAll('[class^="price-select-"]').forEach(select => {
    const itemId = select.dataset.itemId;
    const buyForm = document.querySelector(`.buy-form-${itemId}`);
    const priceTypeInput = document.querySelector(`.price-type-input-${itemId}`);
    
    select.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const priceType = selectedOption.value;
        
        if (priceType && buyForm && priceTypeInput) {
            priceTypeInput.value = priceType;
            buyForm.style.display = 'inline-block';
            buyForm.style.width = '100%';
            this.style.borderColor = '#FFD700';
        } else if (buyForm) {
            buyForm.style.display = 'none';
            this.style.borderColor = '#51556d';
        }
    });
});
</script>
@endsection