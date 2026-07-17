@extends('admin.layout')

@section('title', ' - Свойства категории: ' . $category->name)

@section('content')
<style>
    .properties-container {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e2e8f0;
    }
    
    .category-info {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
        border-left: 4px solid #4a5568;
    }
    
    .category-info-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .category-name {
        font-size: 24px;
        font-weight: 600;
        color: #2d3748;
    }
    
    .category-description {
        color: #718096;
        font-size: 16px;
        margin-bottom: 10px;
    }
    
    .category-stats {
        display: flex;
        gap: 20px;
        margin-top: 15px;
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .stat-value {
        font-weight: 700;
        color: #4a5568;
    }
    
    .stat-label {
        font-size: 14px;
        color: #718096;
    }
    
    .properties-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .properties-table th {
        background: #4a5568;
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .properties-table td {
        padding: 15px;
        border-bottom: 1px solid #e2e8f0;
        font-size: 14px;
        color: #4a5568;
    }
    
    .properties-table tr:hover {
        background: #f7fafc;
    }
    
    .properties-table tr:last-child td {
        border-bottom: none;
    }
    
    .values-cell {
        max-width: 300px;
    }
    
    .values-list {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }
    
    .value-badge {
        background: #e2e8f0;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        color: #4a5568;
    }
    
    .actions-cell {
        white-space: nowrap;
    }
    
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .btn {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    .btn-primary {
        background: #4a5568;
        color: white;
    }
    
    .btn-primary:hover {
        background: #2d3748;
    }
    
    .btn-outline {
        background: transparent;
        color: #4a5568;
        border: 1px solid #4a5568;
    }
    
    .btn-outline:hover {
        background: #f7fafc;
    }
    
    .btn-danger {
        background: #e53e3e;
        color: white;
    }
    
    .btn-danger:hover {
        background: #c53030;
    }
    
    .btn-success {
        background: #38a169;
        color: white;
    }
    
    .btn-success:hover {
        background: #2f855a;
    }
    
    .btn-sm {
        padding: 4px 8px;
        font-size: 11px;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #718096;
        border: 2px dashed #e2e8f0;
        border-radius: 10px;
        margin-top: 20px;
    }
    
    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 20px;
        opacity: 0.3;
    }
    
    .empty-state h3 {
        margin-bottom: 10px;
        color: #4a5568;
    }
    
    .empty-state p {
        margin-bottom: 20px;
        color: #718096;
    }
    
    .alert {
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
    }
    
    .alert-success {
        background: #c6f6d5;
        color: #22543d;
        border: 1px solid #9ae6b4;
    }
</style>

<div class="properties-container">
    <div class="header-actions">
        <h1>Свойства категории</h1>
        <div style="display: flex; gap: 15px;">
            <a href="{{ route('admin.prices.categories') }}" class="btn btn-outline">
                ← Все категории
            </a>
            <a href="{{ route('admin.prices.properties.create', $category->id) }}" class="btn btn-primary">
                + Добавить свойство
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="category-info">
        <div class="category-info-header">
            <div>
                <h2 class="category-name">{{ $category->name }}</h2>
                @if($category->description)
                <p class="category-description">{{ $category->description }}</p>
                @endif
            </div>
            <span class="status-badge {{ $category->is_active ? 'status-active' : 'status-inactive' }}" style="padding: 8px 16px;">
                {{ $category->is_active ? 'Активна' : 'Неактивна' }}
            </span>
        </div>
        
        <div class="category-stats">
            <div class="stat-item">
                <span class="stat-value">{{ $properties->count() }}</span>
                <span class="stat-label">свойств</span>
            </div>
            <div class="stat-item">
                <span class="stat-value">{{ $category->items_count ?? $category->items->count() }}</span>
                <span class="stat-label">тарифов</span>
            </div>
            <div class="stat-item">
                <span class="stat-value">{{ $category->order }}</span>
                <span class="stat-label">порядок</span>
            </div>
        </div>
        
        <div style="margin-top: 20px; display: flex; gap: 10px;">
            <a href="{{ route('admin.prices.categories.edit', $category->id) }}" class="btn btn-outline btn-sm">
                Редактировать категорию
            </a>
            <a href="{{ route('admin.prices.items.category', $category->id) }}" class="btn btn-outline btn-sm">
                Управление тарифами
            </a>
        </div>
    </div>

    @if($properties->count() > 0)
    <div class="card" style="overflow-x: auto;">
        <table class="properties-table">
            <thead>
                <tr>
                    <th>Название свойства</th>
                    <th>Значения</th>
                    <th>Порядок</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($properties as $property)
                <tr>
                    <td>
                        <strong>{{ $property->name }}</strong>
                    </td>
                    <td class="values-cell">
                        @if(!empty($property->values))
                            @php
                                $values = is_array($property->values) ? $property->values : explode(',', $property->values);
                            @endphp
                            <div class="values-list">
                                @foreach($values as $value)
                                <span class="value-badge">{{ trim($value) }}</span>
                                @endforeach
                            </div>
                        @else
                            <span style="color: #cbd5e0; font-style: italic;">Нет значений</span>
                        @endif
                    </td>
                    <td>
                        {{ $property->order }}
                    </td>
                    <td class="actions-cell">
                        <div class="action-buttons">
                            <a href="{{ route('admin.prices.properties.edit', $property->id) }}" class="btn btn-outline btn-sm">
                                Редактировать
                            </a>
                            <form action="{{ route('admin.prices.properties.delete', $property->id) }}" method="POST" 
                                  onsubmit="return confirm('Удалить свойство? Все связанные значения в тарифах будут удалены.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state">
        <div class="empty-state-icon">📋</div>
        <h3>Свойства не найдены</h3>
        <p>Для этой категории еще не добавлены свойства.</p>
        <p style="margin-bottom: 20px; font-size: 14px; max-width: 500px; margin-left: auto; margin-right: auto;">
            Свойства позволяют задавать характеристики для тарифов (например: "Время посещения", "Тип тренировки", "Длительность").
        </p>
        <a href="{{ route('admin.prices.properties.create', $category->id) }}" class="btn btn-primary">
            + Добавить первое свойство
        </a>
    </div>
    @endif
</div>
@endsection