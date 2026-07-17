@extends('admin.layout')

@section('title', ' - Категории цен')
@section('content')
<style>
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    
    .category-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-left: 4px solid #4a5568;
        transition: transform 0.3s;
    }
    
    .category-card:hover {
        transform: translateY(-5px);
    }
    
    .category-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }
    
    .category-icon {
        width: 40px;
        height: 40px;
        background: #4a5568;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    
    .category-title {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
        flex: 1;
    }
    
    .category-description {
        color: #718096;
        font-size: 14px;
        margin-bottom: 15px;
        line-height: 1.4;
    }
    
    .category-stats {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        padding-top: 15px;
        border-top: 1px solid #e2e8f0;
    }
    
    .stat-item {
        text-align: center;
        flex: 1;
    }
    
    .stat-value {
        display: block;
        font-size: 20px;
        font-weight: 700;
        color: #4a5568;
    }
    
    .stat-label {
        font-size: 12px;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .category-actions {
        display: flex;
        gap: 10px;
        justify-content: space-between;
    }
    
    .btn {
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
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
    
    .btn-sm {
        padding: 5px 10px;
        font-size: 12px;
    }
    
    .status-badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-active {
        background: #c6f6d5;
        color: #22543d;
    }
    
    .status-inactive {
        background: #fed7d7;
        color: #742a2a;
    }
    
    .header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }
</style>

<div class="header-actions">
    <h1>Категории цен</h1>
    <a href="{{ route('admin.prices.categories.create') }}" class="btn btn-primary">
        + Добавить категорию
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="categories-grid">
    @foreach($categories as $category)
    <div class="category-card" style="border-left-color: {{ $category->color }}">
        <div class="category-header">
            @if($category->icon)
            <div class="category-icon">
                {{ $category->icon }}
            </div>
            @endif
            <div class="category-title">{{ $category->name }}</div>
            <span class="status-badge {{ $category->is_active ? 'status-active' : 'status-inactive' }}">
                {{ $category->is_active ? 'Активна' : 'Неактивна' }}
            </span>
        </div>
        
        @if($category->description)
        <p class="category-description">{{ Str::limit($category->description, 100) }}</p>
        @endif
        
        <div class="category-stats">
            <div class="stat-item">
                <span class="stat-value">{{ $category->prices_count }}</span>
                <span class="stat-label">Тарифов</span>
            </div>
            <div class="stat-item">
                <span class="stat-value">{{ $category->order }}</span>
                <span class="stat-label">Порядок</span>
            </div>
        </div>
        
        <div class="category-actions">
            <a href="{{ route('admin.prices.properties', $category->id) }}" class="btn btn-outline btn-sm">
                Свойства
            </a>
            <a href="{{ route('admin.prices.category', $category->id) }}" class="btn btn-outline btn-sm">
                Тарифы
            </a>
            <a href="{{ route('admin.prices.categories.edit', $category->id) }}" class="btn btn-sm">
                Редактировать
            </a>
            <form action="{{ route('admin.prices.categories.delete', $category->id) }}" method="POST" 
                  onsubmit="return confirm('Удалить категорию и все связанные тарифы?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
            </form>
        </div>
    </div>
    @endforeach
    
    @if($categories->isEmpty())
    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #718096;">
        <p>Нет добавленных категорий</p>
        <a href="{{ route('admin.prices.categories.create') }}" class="btn btn-primary">Создать первую категорию</a>
    </div>
    @endif
</div>
@endsection