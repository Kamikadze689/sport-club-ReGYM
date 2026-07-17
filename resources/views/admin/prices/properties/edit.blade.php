@extends('admin.layout')

@section('title', ' - Редактировать свойство: ' . $property->name)

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
    
    .warning-box {
        background: #fff3cd;
        border: 1px solid #ffeaa7;
        color: #856404;
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
    }
    
    .warning-box h4 {
        margin: 0 0 10px 0;
        font-size: 16px;
    }
    
    .warning-box p {
        margin: 0;
        font-size: 14px;
    }
</style>

<div class="header">
    <h1>Редактировать свойство</h1>
    <a href="{{ route('admin.prices.properties', $property->category_id) }}" class="btn btn-outline">
        ← Назад к списку свойств
    </a>
</div>

<div class="property-form-container">
    <div class="category-info">
        <div class="category-name">{{ $property->category->name }}</div>
        @if($property->category->description)
        <div class="category-description">{{ $property->category->description }}</div>
        @endif
    </div>

    @if($property->category->items->count() > 0)
    <div class="warning-box">
        <h4>⚠️ Внимание</h4>
        <p>Это свойство используется в {{ $property->category->items->count() }} тарифах. Изменение названия или значений свойства может повлиять на отображение существующих тарифов.</p>
    </div>
    @endif

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
        
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        <form action="{{ route('admin.prices.properties.update', $property->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label required" for="name">Название свойства *</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       class="form-control" 
                       value="{{ old('name', $property->name) }}" 
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
                          placeholder="Введите значения через запятую">{{ old('values', $property->values) }}</textarea>
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
                       value="{{ old('order', $property->order) }}"
                       min="0"
                       step="1">
                <div class="help-text">Порядок отображения свойства в формах создания/редактирования тарифов</div>
            </div>
            
            <div class="form-actions">
                <div>
                    <form action="{{ route('admin.prices.properties.delete', $property->id) }}" method="POST" 
                          onsubmit="return confirm('Удалить это свойство? Все связанные значения в тарифах будут удалены.')" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Удалить свойство
                        </button>
                    </form>
                </div>
                
                <div>
                    <a href="{{ route('admin.prices.properties', $property->category_id) }}" class="btn btn-outline">
                        Отмена
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Сохранить изменения
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('name');
        const valuesTextarea = document.getElementById('values');
        
        
        nameInput.addEventListener('input', function() {
            const propertyName = this.value.trim();
            const currentValues = valuesTextarea.value;
            
            if (!propertyName || currentValues) return;
            
            const suggestions = {
                'Время': 'Утро, День, Вечер, Полный день',
                'Тип': 'Силовая, Кардио, Функциональная, Стретчинг',
                'Длительность': '30 минут, 45 минут, 60 минут, 90 минут',
                'Уровень': 'Начинающий, Средний, Продвинутый',
                'Дни': 'Пн-Пт, Пн-Сб, Пн-Вс',
                'Возраст': 'Дети, Подростки, Взрослые, Сениоры'
            };
            
            for (const [key, value] of Object.entries(suggestions)) {
                if (propertyName.toLowerCase().includes(key.toLowerCase())) {
                    valuesTextarea.placeholder = `Например: ${value}`;
                    break;
                }
            }
        });
    });
</script>
@endsection