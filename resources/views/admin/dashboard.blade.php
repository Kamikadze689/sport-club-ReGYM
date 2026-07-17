@extends('admin.layout')

@section('title', 'Дашборд')

@section('content')
    <div class="header">
        <h1>Дашборд</h1>
        <p>Общая статистика и быстрый доступ</p>
    </div>

    <div class="stats">
        <div class="stat-card">
            <div class="stat-number">{{ $trainersCount }}</div>
            <div class="stat-label">Тренеров</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number">{{ $pricesCount }}</div> 
            <div class="stat-label">Тарифов</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number">{{ $pendingRequests }}</div>
            <div class="stat-label">Новых заявок</div>
        </div>
    </div>

    <div class="card">
        <h3>Быстрые действия</h3>
        <div style="display: flex; gap: 10px; margin-top: 15px;">
            <a href="{{ route('admin.trainers.create') }}" class="btn">Добавить тренера</a>
            <a href="{{ route('admin.prices.management') }}" class="btn">Управление ценами</a>
            <a href="{{ route('admin.requests') }}" class="btn">Просмотреть заявки</a>
        </div>
    </div>

    @php
        $recentRequests = \App\Models\VisitorRequest::latest()->limit(5)->get();
    @endphp

    @if($recentRequests->count() > 0)
    <div class="card">
        <h3>Последние заявки</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Дата</th>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>Тип</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentRequests as $request)
                <tr>
                    <td>{{ $request->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $request->full_name }}</td>
                    <td>{{ $request->phone }}</td>
                    <td>
                        @switch($request->request_type)
                            @case('trial_training')
                                Пробная тренировка
                                @break
                            @case('personal_training')
                                Персональная тренировка
                                @break
                            @default
                                {{ $request->request_type }}
                        @endswitch
                    </td>
                    <td>
                        @if($request->processed)
                            <span style="background: #d4edda; color: #155724; padding: 3px 8px; border-radius: 3px; font-size: 12px;">
                                Обработана
                            </span>
                        @else
                            <span style="background: #fff3cd; color: #856404; padding: 3px 8px; border-radius: 3px; font-size: 12px;">
                                Новая
                            </span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="text-align: right; margin-top: 10px;">
            <a href="{{ route('admin.requests') }}" class="btn">Все заявки</a>
        </div>
    </div>
    @endif
@endsection