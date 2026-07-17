@extends('admin.layout')

@section('title', ' - Добавить категорию цен')

@section('content')
<style>
    .category-form-container {
        max-width: 600px;
        margin: 0 auto;
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }
    
    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.3s;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #4a5568;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }
    
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
    }
    
    .checkbox-label {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        font-size: 14px;
        color: #333;
    }
    
    .checkbox-label input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }
    
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e2e8f0;
    }
    
    .btn {
        padding: 10px 25px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
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
        background: #f8f9fa;
    }
    
    .help-text {
        font-size: 12px;
        color: #718096;
        margin-top: 5px;
    }
    
    .required::after {
        content: ' *';
        color: #e53e3e;
    }
</style>

<div class="header">
    <h1>Добавить категорию цен</h1>
    <a href="{{ route('admin.prices.categories') }}" class="btn btn-outline">
        ← Назад к списку
    </a>
</div>

<div class="card category-form-container">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <form action="{{ route('admin.prices.categories.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label required" for="name">Название категории *</label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   class="form-control" 
                   value="{{ old('name') }}" 
                   required
                   placeholder="Например: Групповые тренировки, Тренажерный зал">
            <div class="help-text">Название категории для группировки тарифов</div>
        </div>
        
        <div class="form-group">
            <label class="form-label" for="description">Описание</label>
            <textarea id="description" 
                      name="description" 
                      class="form-control" 
                      rows="4"
                      placeholder="Краткое описание категории (необязательно)">{{ old('description') }}</textarea>
            <div class="help-text">Будет отображаться в таблице цен</div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label" for="order">Порядок отображения</label>
                <input type="number" 
                       id="order" 
                       name="order" 
                       class="form-control" 
                       value="{{ old('order', 0) }}"
                       min="0"
                       step="1">
                <div class="help-text">Чем меньше число, тем выше в списке</div>
            </div>
        </div>
        
        <div class="checkbox-group">
            <label class="checkbox-label">
                <input type="checkbox" 
                       name="is_active" 
                       value="1" 
                       {{ old('is_active', true) ? 'checked' : '' }}>
                Категория активна
            </label>
        </div>
        
        <div class="form-actions">
            <a href="{{ route('admin.prices.categories') }}" class="btn btn-outline">
                Отмена
            </a>
            <button type="submit" class="btn btn-primary">
                Создать категорию
            </button>
        </div>
    </form>
</div>
@endsection