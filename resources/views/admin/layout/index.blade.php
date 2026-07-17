@extends('admin.layout')

@section('title', 'Планировка зала')

@section('content')
<div class="card">
    <div class="header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h1>Планировка зала</h1>
        <a href="{{ route('admin.layout.create') }}" class="btn">+ Добавить зону</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 24px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="margin-top: 20px;">
        <h3 style="margin-bottom: 16px; text-align: center;">Карта зала 48 × 19.2 м (60 × 24 клетки)</h3>

        <div id="hall-map" style="
            width: 100%;
            aspect-ratio: 60 / 24;
            max-height: 720px;
            background: #f8fafc;
            border: 4px solid #1e293b;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            margin: 0 auto;
        ">
            
            <div style="
                position: absolute;
                inset: 0;
                background-image:
                    linear-gradient(to right, #cbd5e1 1px, transparent 1px),
                    linear-gradient(to bottom, #cbd5e1 1px, transparent 1px);
                background-size: calc(100% / 60) calc(100% / 24);
                pointer-events: none;
            "></div>

            
            @forelse($zones as $zone)
                <div style="
                    position: absolute;
                    left: {{ $zone->grid_x * (100/60) }}%;
                    top: {{ $zone->grid_y * (100/24) }}%;
                    width: {{ $zone->width * (100/60) }}%;
                    height: {{ $zone->height * (100/24) }}%;
                    background: {{ $zone->color ?? '#9ca3af' }}30;
                    border: 2px solid {{ $zone->color ?? '#64748b' }};
                    border-radius: 8px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #111;
                    font-weight: bold;
                    font-size: clamp(10px, 1.4vw, 14px);
                    text-align: center;
                    text-shadow: 1px 1px 3px white;
                    overflow: hidden;
                    pointer-events: none;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.15);
                ">
                    {{ $zone->name }}
                </div>
            @empty
                <div style="
                    position: absolute;
                    inset: 0;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #64748b;
                    font-size: 1.3rem;
                    font-weight: 500;
                ">
                    Зоны пока не добавлены<br>Нажмите «+ Добавить зону»
                </div>
            @endforelse
        </div>

        <div style="margin-top: 16px; color: #64748b; font-size: 0.95em; text-align: center;">
            Масштаб карты адаптивный • 1 клетка ≈ 0.8 × 0.8 м
        </div>
    </div>

    
    <div class="zones-list mt-5">
        <h3>Список всех зон</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Цвет</th>
                    <th>Позиция</th>
                    <th>Размер (клетки)</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($zones as $zone)
                <tr>
                    <td>{{ $zone->name }}</td>
                    <td>
                        <div style="width:28px; height:28px; background:{{ $zone->color ?? '#6b7280' }}; border-radius:6px; border:1px solid #444;"></div>
                    </td>
                    <td>{{ $zone->grid_x }}, {{ $zone->grid_y }}</td>
                    <td>{{ $zone->width }} × {{ $zone->height }}</td>
                    <td>
                        <a href="{{ route('admin.layout.edit', $zone->id) }}" class="btn">Редактировать</a>
                        <form action="{{ route('admin.layout.delete', $zone->id) }}" method="POST" style="display:inline;" data-confirm>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding:40px 0; color:#888;">
                        Зоны пока не добавлены. Добавьте первую зону!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .header h1 {
        margin: 0;
        font-size: 1.8rem;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 16px;
    }

    .table th, .table td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }

    .table th {
        background: #f1f5f9;
        font-weight: 600;
        color: #334155;
    }

    .btn {
        padding: 8px 16px;
        background: #f59e0b;
        color: black;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        transition: background 0.2s;
    }

    .btn:hover {
        background: #d97706;
    }

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .btn-danger:hover {
        background: #dc2626;
    }
</style>
@endsection