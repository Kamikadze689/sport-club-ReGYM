@extends('admin.layout')

@section('title', ' - Управление тарифами')

@section('content')

<div class="prices-header">
    <h1>Управление тарифами</h1>
    <div style="display: flex; gap: 15px;">
        <a href="{{ route('admin.prices.categories') }}" class="btn btn-outline">
            Категории
        </a>
        <a href="{{ route('admin.prices.items.create', $selectedCategory?->id) }}" class="btn btn-primary">
            + Добавить тариф
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="category-filter">
    <a href="{{ route('admin.prices.items') }}" class="category-badge all">
        Все тарифы
    </a>
    @foreach($categories as $category)
    <a href="{{ route('admin.prices.items.category', $category->id) }}" 
       class="category-badge {{ $selectedCategory && $selectedCategory->id == $category->id ? 'active' : '' }}">
        {{ $category->name }}
    </a>
    @endforeach
</div>

@if($items->count() > 0)
<div class="card" style="overflow-x: auto;">
    <table class="price-table">
        <thead>
            <tr>
                <th>Категория</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Свойства</th>
                <th>Статус</th>
                <th>Опции</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td class="category-cell">
                    @if($item->category)
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span>{{ $item->category->name }}</span>
                    </div>
                    @else
                    <span style="color: #718096;">Без категории</span>
                    @endif
                </td>
                <td>
                    <strong>{{ $item->name }}</strong>
                    @if($item->description)
                    <div style="font-size: 12px; color: #718096; margin-top: 5px;">
                        {{ Str::limit($item->description, 50) }}
                    </div>
                    @endif
                </td>
                <td class="price-cell">
                    <span class="amount">{{ number_format($item->price, 0, ',', ' ') }} ₽</span>
                    @if($item->has_discount)
                    <span class="status-badge discount-badge" style="margin-left: 8px;">Скидка</span>
                    @endif
                    @if($item->is_popular)
                    <span class="status-badge popular-badge" style="margin-left: 8px;">Популярный</span>
                    @endif
                </td>
                <td class="properties-preview">
                    @if($item->property_values && is_array($item->property_values))
                        @foreach($item->property_values as $key => $value)
                        <div class="property-item">
                            <strong>{{ $key }}:</strong> 
                            {{ $value }}
                        </div>
                        @endforeach
                    @else
                    <span style="color: #cbd5e0;">Нет свойств</span>
                    @endif
                </td>
                <td>
                    <span class="status-badge {{ $item->is_active ? 'status-active' : 'status-inactive' }}">
                        {{ $item->is_active ? 'Активен' : 'Неактивен' }}
                    </span>
                </td>
                <td>
                    <span style="color: #718096; font-size: 12px;">
                        Порядок: {{ $item->order }}
                    </span>
                </td>
                <td class="actions-cell">
                    <div class="action-buttons">
                        <a href="{{ route('admin.prices.items.edit', $item->id) }}" class="btn btn-outline btn-sm">
                            Редактировать
                        </a>
                        <form action="{{ route('admin.prices.items.delete', $item->id) }}" method="POST" 
                              onsubmit="return confirm('Удалить тариф?')">
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
    <div class="empty-state-icon">💰</div>
    <h3>Тарифы не найдены</h3>
    <p>
        @if($selectedCategory)
        В категории "{{ $selectedCategory->name }}" пока нет тарифов
        @else
        Тарифы еще не добавлены
        @endif
    </p>
    <a href="{{ route('admin.prices.items.create', $selectedCategory?->id) }}" class="btn btn-primary">
        Добавить первый тариф
    </a>
</div>
@endif
@endsection