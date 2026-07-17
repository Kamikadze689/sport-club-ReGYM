@extends('admin.layout')

@section('title', ' - Добавить свойство')

@section('content')
<style>
    .property-form-container {
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
    
    .category-info {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
        border-left: 4px solid #4a5568;
    }
    
    .category-name {
        font-size: 20px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 5px;
    }
    
    .category-description {
        color: #718096;
        font-size: 14px;
    }
</style>

<div class="header">
    <h1>Добавить свойство</h1>
    <a href="{{ route('admin.prices.properties', $category->id) }}" class="btn btn-outline">
        ← Назад к списку свойств
    </a>
</div>

<div class="property-form-container">
    <div class="category-info">
        <div class="category-name">{{ $category->name }}</div>
        @if($category->description)
        <div class="category-description">{{ $category->description }}</div>
        @endif
    </div>

    <div class="card">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <form action="{{ route('admin.prices.properties.store', $category->id) }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label required" for="name">Название свойства *</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       class="form-control" 
                       value="{{ old('name') }}" 
                       required
                       placeholder="Например: Время посещения, Тип тренировки, Длительность">
                <div class="help-text">Название характеристики, которая будет у тарифов этой категории</div>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="values">Значения свойства</label>
                <textarea id="values" 
                          name="values" 
                          class="form-control" 
                          rows="4"
                          placeholder="Введите значения через запятую">{{ old('values') }}</textarea>
                <div class="help-text">
                    Укажите возможные значения через запятую (например: "Утро, День, Вечер" или "7:00-16:00, 7:00-23:00").<br>
                    Если оставить пустым, можно будет вводить произвольные значения.
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="order">Порядок отображения</label>
                <input type="number" 
                       id="order" 
                       name="order" 
                       class="form-control" 
                       value="{{ old('order', 0) }}"
                       min="0"
                       step="1">
                <div class="help-text">Порядок отображения свойства в формах создания/редактирования тарифов</div>
            </div>
            
            <div class="form-actions">
                <a href="{{ route('admin.prices.properties', $category->id) }}" class="btn btn-outline">
                    Отмена
                </a>
                <button type="submit" class="btn btn-primary">
                    Создать свойство
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const valuesTextarea = document.getElementById('values');
        
        
        const examples = {
            'Время посещения': 'Утро (7:00-12:00), День (12:00-17:00), Вечер (17:00-23:00), Полный день (7:00-23:00)',
            'Тип тренировки': 'Силовая, Кардио, Функциональная, Стретчинг',
            'Длительность': '30 минут, 45 минут, 60 минут, 90 минут',
            'Уровень подготовки': 'Начинающий, Средний, Продвинутый, Профессиональный',
            'Дни недели': 'Пн-Пт, Пн-Сб, Пн-Вс, Любые дни',
            'Возрастная группа': 'Дети, Подростки, Взрослые, Сениоры'
        };
        
        const nameInput = document.getElementById('name');
        
        nameInput.addEventListener('blur', function() {
            const propertyName = this.value.trim();
            if (propertyName && examples[propertyName] && !valuesTextarea.value) {
                if (confirm(`Использовать пример значений для "${propertyName}"?`)) {
                    valuesTextarea.value = examples[propertyName];
                }
            }
        });
    });
</script>
@endsection