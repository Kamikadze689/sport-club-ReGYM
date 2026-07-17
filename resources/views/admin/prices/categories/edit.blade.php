@extends('admin.layout')

@section('title', ' - Редактировать категорию цен')

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
        justify-content: space-between;
        align-items: center;
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
    
    .btn-danger {
        background: #e53e3e;
        color: white;
    }
    
    .btn-danger:hover {
        background: #c53030;
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
    
    .delete-form {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #e2e8f0;
    }
</style>

<div class="header">
    <h1>Редактировать категорию цен</h1>
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
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    <form action="{{ route('admin.prices.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label class="form-label required" for="name">Название категории *</label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   class="form-control" 
                   value="{{ old('name', $category->name) }}" 
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
                      placeholder="Краткое описание категории (необязательно)">{{ old('description', $category->description) }}</textarea>
            <div class="help-text">Будет отображаться в таблице цен</div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label" for="order">Порядок отображения</label>
                <input type="number" 
                       id="order" 
                       name="order" 
                       class="form-control" 
                       value="{{ old('order', $category->order) }}"
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
                       {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                Категория активна
            </label>
        </div>
        
        <div class="form-actions">
            <div>
                <a href="{{ route('admin.prices.properties', $category->id) }}" class="btn btn-outline">
                    Управление свойствами
                </a>
                <a href="{{ route('admin.prices.items.category', $category->id) }}" class="btn btn-outline">
                    Тарифы категории
                </a>
            </div>
            
            <div>
                <a href="{{ route('admin.prices.categories') }}" class="btn btn-outline">
                    Отмена
                </a>
                <button type="submit" class="btn btn-primary">
                    Сохранить изменения
                </button>
            </div>
        </div>
    </form>
    
    <div class="delete-form">
        <form action="{{ route('admin.prices.categories.delete', $category->id) }}" method="POST" 
              onsubmit="return confirm('Вы уверены, что хотите удалить эту категорию и все связанные тарифы и свойства?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                Удалить категорию
            </button>
            <div class="help-text" style="margin-top: 8px;">
                Внимание: удаление категории также удалит все её свойства и тарифы.
            </div>
        </form>
    </div>
</div>
@endsection