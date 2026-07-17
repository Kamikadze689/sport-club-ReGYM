@extends('layouts.app')

@section('title', 'Личный кабинет - ReGYM')

@section('content')
<style>
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        margin-bottom: 50px;
    }
    
    .stat-card {
        background: linear-gradient(135deg, rgba(255,215,0,0.1), rgba(255,215,0,0.05));
        border-radius: 20px;
        padding: 25px;
        text-align: center;
        border: 1px solid rgba(255,215,0,0.2);
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        border-color: var(--color-yellow);
        box-shadow: 0 10px 30px rgba(255,215,0,0.1);
    }
    
    .stat-icon {
        font-size: 48px;
        color: var(--color-yellow);
        margin-bottom: 15px;
    }
    
    .stat-value {
        font-size: 32px;
        font-weight: 800;
        color: var(--color-white);
        margin-bottom: 5px;
    }
    
    .stat-label {
        font-size: 14px;
        color: var(--color-text-light);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .subscription-card {
        background: var(--color-gray);
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 20px;
        border: 1px solid rgba(255,215,0,0.15);
        transition: all 0.3s ease;
    }
    
    .subscription-card.active {
        background: linear-gradient(135deg, rgba(16,185,129,0.1), rgba(16,185,129,0.05));
        border-color: #10b981;
    }
    
    .subscription-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .subscription-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--color-yellow);
    }
    
    .subscription-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .badge-active {
        background: rgba(16,185,129,0.2);
        color: #10b981;
        border: 1px solid #10b981;
    }
    
    .badge-expired {
        background: rgba(239,68,68,0.2);
        color: #ef4444;
        border: 1px solid #ef4444;
    }
    
    .badge-pending {
        background: rgba(245,158,11,0.2);
        color: #f59e0b;
        border: 1px solid #f59e0b;
    }
    
    .subscription-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }
    
    .detail-item {
        padding: 10px;
        background: rgba(0,0,0,0.2);
        border-radius: 10px;
    }
    
    .detail-label {
        font-size: 11px;
        color: var(--color-text-light);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }
    
    .detail-value {
        font-size: 16px;
        font-weight: 600;
        color: var(--color-white);
    }
    
    .subscription-actions {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .btn-sm {
        padding: 8px 16px;
        font-size: 13px;
    }
    
    .btn-qr {
        background: linear-gradient(135deg, var(--color-yellow), #fbbf24);
        color: #000;
    }
    
    .history-table {
        width: 100%;
        border-collapse: collapse;
        background: var(--color-gray);
        border-radius: 16px;
        overflow: hidden;
    }
    
    .history-table th {
        background: rgba(255,215,0,0.1);
        padding: 15px;
        text-align: left;
        color: var(--color-yellow);
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .history-table td {
        padding: 15px;
        color: var(--color-white);
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }
    
    .history-table tr:last-child td {
        border-bottom: none;
    }
    
    .history-table tr:hover {
        background: rgba(255,215,0,0.03);
    }
    
    @media (max-width: 768px) {
        .history-table th,
        .history-table td {
            padding: 10px;
            font-size: 12px;
        }
        
        .subscription-details {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="section">
    <div class="container">
        
        <div class="fade-in" style="text-align: center; margin-bottom: 40px;">
            <h2 class="section-title fade-in">Личный <span>кабинет</span></h2>
            <p class="section-subtitle fade-in">Добро пожаловать, <strong style="color: var(--color-yellow);">{{ $user->name }}</strong>!</p>
        </div>
        
        
        <div class="dashboard-stats fade-in">
            <div class="stat-card">
                <div class="stat-value">{{ $subscriptions->count() }}</div>
                <div class="stat-label">Всего абонементов</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $subscriptions->where('status', 'active')->where('expires_at', '>', now())->count() }}</div>
                <div class="stat-label">Активных</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $subscriptions->where('status', 'pending')->count() }}</div>
                <div class="stat-label">Ожидают оплаты</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $subscriptions->where('expires_at', '<', now())->count() }}</div>
                <div class="stat-label">Истекло</div>
            </div>
        </div>
        
        
        @if($activeSubscription)
            <div class="fade-in" style="margin-bottom: 40px;">
                <h3 style="color: var(--color-white); margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-star" style="color: var(--color-yellow);"></i>
                    Активный абонемент
                </h3>
                <div class="subscription-card active">
                    <div class="subscription-header">
                        <h4 class="subscription-title">{{ $activeSubscription->type }}</h4>
                        <span class="subscription-badge badge-active">✅ Активен</span>
                    </div>
                    <div class="subscription-details">
                        <div class="detail-item">
                            <div class="detail-label">Действует до</div>
                            <div class="detail-value">{{ $activeSubscription->expires_at->format('d.m.Y') }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Осталось дней</div>
                            <div class="detail-value">{{ max(0, floor(now()->diffInDays($activeSubscription->expires_at, false))) }} дн.</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Стоимость</div>
                            <div class="detail-value">{{ number_format($activeSubscription->price, 0, ',', ' ') }} ₽</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Дата покупки</div>
                            <div class="detail-value">{{ $activeSubscription->purchased_at->format('d.m.Y') }}</div>
                        </div>
                    </div>
                    <div class="subscription-actions">
                        <a href="{{ route('user.subscription.qr', $activeSubscription->id) }}" class="btn btn-sm btn-qr">
                            <i class="fas fa-qrcode"></i> Показать QR-код для входа
                        </a>
                    </div>
                </div>
            </div>
        @endif
        
        
        <div class="fade-in">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
                <h3 style="color: var(--color-white); display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-history" style="color: var(--color-yellow);"></i>
                    История абонементов
                </h3>
                <a href="{{ route('prices') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Купить абонемент
                </a>
            </div>
            
            @if($subscriptions->count() > 0)
                <div style="overflow-x: auto;">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Тип</th>
                                <th>Цена</th>
                                <th>Дата покупки</th>
                                <th>Действует до</th>
                                <th>Статус</th>
                                <th>QR-код</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subscriptions as $subscription)
                            <tr>
                                <td>
                                    <strong>{{ $subscription->type }}</strong>
                                    @if($subscription->category_name)
                                        <br><small style="color: var(--color-text-light); font-size: 11px;">{{ $subscription->category_name }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if($subscription->price > 0)
                                        {{ number_format($subscription->price, 0, ',', ' ') }} ₽
                                    @else
                                        <span style="color: #6b7280;">Бесплатно</span>
                                    @endif
                                </td>
                                <td>{{ $subscription->purchased_at->format('d.m.Y H:i') }}</td>
                                <td>{{ $subscription->expires_at ? $subscription->expires_at->format('d.m.Y') : 'бессрочно' }}</td>
                                <td>
                                    @if($subscription->status === 'active' && $subscription->expires_at > now())
                                        <span class="subscription-badge badge-active">✅ Активен</span>
                                    @elseif($subscription->status === 'pending')
                                        <span class="subscription-badge badge-pending">⏳ Ожидает оплаты</span>
                                    @elseif($subscription->expires_at <= now())
                                        <span class="subscription-badge badge-expired">❌ Истек</span>
                                    @else
                                        <span class="subscription-badge" style="background: rgba(107,114,128,0.2); color: #6b7280;">{{ $subscription->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($subscription->status === 'active' && $subscription->expires_at > now())
                                        <a href="{{ route('user.subscription.qr', $subscription->id) }}" style="color: var(--color-yellow); text-decoration: none;">
                                            <i class="fas fa-qrcode"></i> Показать
                                        </a>
                                    @elseif($subscription->status === 'pending')
                                        <a href="{{ route('payment.process', $subscription->id) }}" class="btn btn-sm" style="background: #f59e0b; color: #fff; padding: 4px 10px; font-size: 12px; border-radius: 6px; text-decoration: none;">Оплатить</a>
                                    @else
                                        <span style="color: #6b7280;">—</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="text-align: center; padding: 60px 20px; background: var(--color-gray); border-radius: 16px;">
                    <i class="fas fa-ticket-alt" style="font-size: 48px; color: var(--color-text-light); margin-bottom: 20px; display: inline-block;"></i>
                    <p style="color: var(--color-text-light); margin-bottom: 20px;">У вас пока нет абонементов</p>
                    <a href="{{ route('prices') }}" class="btn btn-primary">
                        <i class="fas fa-shopping-cart"></i> Купить абонемент
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>

<form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
    @csrf
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });
        
        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });
    });
</script>
@endsection