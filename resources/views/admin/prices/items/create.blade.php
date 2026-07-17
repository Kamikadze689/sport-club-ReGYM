@extends('admin.layout')

@section('title', ' - Добавить объект')
@section('content')
<style>
    .item-form-container {
        max-width: 800px;
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
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }
    
    .properties-section {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 8px;
        margin-bottom: 25px;
    }
    
    .properties-section h3 {
        margin: 0 0 20px 0;
        color: #2d3748;
        font-size: 16px;
        border-bottom: 2px solid #4a5568;
        padding-bottom: 10px;
    }
    
    .property-field {
        margin-bottom: 20px;
    }
    
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
        flex-wrap: wrap;
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
    <h1>Добавить объект (тариф)</h1>
    <a href="{{ route('admin.prices.items.category', ['category' => $selectedCategory?->id]) }}" class="btn btn-outline">
        ← Назад к списку
    </a>
</div>

<div class="card item-form-container">
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    
    <form action="{{ route('admin.prices.items.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label required" for="category_id">Категория *</label>
            <select id="category_id" name="category_id" class="form-control" required>
                <option value="">Выберите категорию</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" 
                    {{ ($selectedCategory && $selectedCategory->id == $category->id) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
            <div class="help-text">Сначала создайте категорию и свойства</div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label required" for="name">Название объекта *</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       class="form-control" 
                       value="{{ old('name') }}" 
                       required
                       placeholder="Например: Разовая тренировка, 8 занятий, 1 месяц">
                <div class="help-text">Название тарифа или услуги</div>
            </div>
            
            <div class="form-group">
                <label class="form-label required" for="price">Цена (₽) *</label>
                <input type="number" 
                       id="price" 
                       name="price" 
                       class="form-control" 
                       value="{{ old('price') }}" 
                       required
                       min="0"
                       step="1"
                       placeholder="0">
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label" for="description">Описание</label>
            <textarea id="description" 
                      name="description" 
                      class="form-control" 
                      rows="3"
                      placeholder="Краткое описание объекта (необязательно)">{{ old('description') }}</textarea>
        </div>
        
        @if($selectedCategory && $selectedCategory->properties->count() > 0)
        <div class="properties-section">
            <h3>Значения свойств</h3>
            <div class="help-text" style="margin-bottom: 15px;">
                Выберите значения для каждого свойства категории
            </div>
            
            @foreach($selectedCategory->properties as $property)
            <div class="property-field">
                <label class="form-label" for="property_{{ $property->id }}">
                    {{ $property->name }}
                </label>
                
                @if(!empty($property->values))
                    @php
                        $values = is_array($property->values) ? $property->values : explode(',', $property->values);
                    @endphp
                    
                    <select id="property_{{ $property->id }}"
                            name="property_{{ $property->id }}"
                            class="form-control">
                        <option value="">Выберите значение</option>
                        @foreach($values as $value)
                        <option value="{{ trim($value) }}" 
                            {{ old('property_' . $property->id) == trim($value) ? 'selected' : '' }}>
                            {{ trim($value) }}
                        </option>
                        @endforeach
                    </select>
                @else
                    <input type="text" 
                           id="property_{{ $property->id }}"
                           name="property_{{ $property->id }}"
                           class="form-control"
                           placeholder="Введите значение"
                           value="{{ old('property_' . $property->id) }}">
                @endif
                
                @if(!empty($property->values))
                <div class="help-text">Доступные значения: {{ $property->values }}</div>
                @endif
            </div>
            @endforeach
        </div>
        @elseif($selectedCategory)
        <div class="properties-section" style="background: #fff3cd; border-color: #ffeaa7;">
            <h3 style="color: #856404;">⚠️ Свойства не настроены</h3>
            <p style="color: #856404; margin-bottom: 15px;">
                У этой категории нет свойств. Чтобы добавить свойства, перейдите в раздел "Свойства".
            </p>
            <a href="{{ route('admin.prices.properties', $selectedCategory->id) }}" class="btn" style="background: #856404; color: white;">
                Добавить свойства
            </a>
        </div>
        @endif
        
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
            
            <div class="form-group">
                <div class="checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" 
                               name="has_discount" 
                               value="1" 
                               {{ old('has_discount') ? 'checked' : '' }}>
                        Есть скидка
                    </label>
                    
                    <label class="checkbox-label">
                        <input type="checkbox" 
                               name="is_popular" 
                               value="1" 
                               {{ old('is_popular') ? 'checked' : '' }}>
                        Популярный
                    </label>
                    
                    <label class="checkbox-label">
                        <input type="checkbox" 
                               name="is_active" 
                               value="1" 
                               {{ old('is_active', true) ? 'checked' : '' }}>
                        Активный
                    </label>
                </div>
            </div>
        </div>
        
        <div class="form-actions">
            <a href="{{ route('admin.prices.items.category', ['category' => $selectedCategory?->id]) }}" class="btn btn-outline">
                Отмена
            </a>
            <button type="submit" class="btn btn-primary">
                Добавить объект
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category_id');
        
        categorySelect.addEventListener('change', function() {
            const categoryId = this.value;
            if (categoryId) {
                window.location.href = "{{ route('admin.prices.items.create') }}/" + categoryId;
            }
        });
    });
</script>
@endsection