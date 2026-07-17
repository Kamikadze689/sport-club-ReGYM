@extends('admin.layout')

@section('title', 'Редактировать тренера')

@section('content')
    <div class="header">
        <h1>Редактировать тренера</h1>
        <div style="display: flex; gap: 10px; margin-top: 10px;">
            <a href="{{ route('admin.trainers') }}" class="btn">
                ← Назад к списку
            </a>
        </div>
    </div>

    <div class="card">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.trainers.update', $trainer->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div class="form-group">
                    <label class="form-label" for="name">Имя тренера *</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="{{ old('name', $trainer->name) }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="experience_years">Опыт (лет) *</label>
                    <input type="number" class="form-control" id="experience_years" name="experience_years" 
                           value="{{ old('experience_years', $trainer->experience_years) }}" min="0" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Специализации *</label>
                <div id="specializations-container">
                    @php
                        
                        $specializationsArray = $trainer->getSpecializationsArrayAttribute();
                        $oldSpecializations = old('specializations', $specializationsArray);
                        
                        
                        if (is_string($oldSpecializations) && !empty($oldSpecializations)) {
                            $oldSpecializations = json_decode($oldSpecializations, true) ?: [];
                        }
                        
                        
                        if (empty($oldSpecializations) && empty($specializationsArray)) {
                            $oldSpecializations = [''];
                        }
                    @endphp
                    
                    @foreach($oldSpecializations as $index => $specialization)
                    <div class="specialization-input" style="margin-bottom: 10px; display: flex; gap: 10px;">
                        <input type="text" class="form-control" name="specializations[]" 
                               value="{{ $specialization }}" placeholder="Специализация" style="flex: 1;" required>
                        <button type="button" class="btn btn-danger remove-specialization" style="padding: 8px 12px;">
                            Удалить
                        </button>
                    </div>
                    @endforeach
                </div>
                
                <button type="button" class="btn" id="add-specialization" style="margin-top: 10px; background: #333; color: white;">
                    + Добавить специализацию
                </button>
                <small style="color: #666; display: block; margin-top: 5px;">
                    Нажмите "+ Добавить специализацию" для ввода нескольких специализаций
                </small>
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Описание</label>
                <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $trainer->description) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Виды спорта (опционально)</label>
                <div id="sports-container">
                    @php
                        $sportsArray = $trainer->getSportsArrayAttribute();
                        $oldSports = old('sports', $sportsArray);
                        
                        
                        if (is_string($oldSports) && !empty($oldSports)) {
                            $oldSports = json_decode($oldSports, true) ?: [];
                        }
                        
                        
                        if (empty($oldSports) && empty($sportsArray)) {
                            $oldSports = [''];
                        }
                    @endphp
                    
                    @foreach($oldSports as $index => $sport)
                    <div class="sport-input" style="margin-bottom: 10px; display: flex; gap: 10px;">
                        <input type="text" class="form-control" name="sports[]" 
                               value="{{ $sport }}" placeholder="Вид спорта" style="flex: 1;">
                        <button type="button" class="btn btn-danger remove-sport" style="padding: 8px 12px;">
                            Удалить
                        </button>
                    </div>
                    @endforeach
                </div>
                
                <button type="button" class="btn" id="add-sport" style="margin-top: 10px; background: #333; color: white;">
                    + Добавить вид спорта
                </button>
                <small style="color: #666; display: block; margin-top: 5px;">
                    Оставьте пустым, чтобы не добавлять виды спорта
                </small>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div class="form-group">
                    <label class="form-label" for="photo">Фото тренера</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    
                    @if($trainer->photo)
                        <div style="margin-top: 10px;">
                            <p style="font-size: 14px; color: #666; margin-bottom: 5px;">Текущее фото:</p>
                            <img src="{{ asset('storage/' . $trainer->photo) }}" alt="{{ $trainer->name }}" 
                                 style="max-width: 200px; max-height: 200px; border-radius: 5px; border: 2px solid #ddd;">
                            <p style="font-size: 12px; color: #666; margin-top: 5px;">
                                Файл: {{ basename($trainer->photo) }}
                            </p>
                        </div>
                    @endif
                    
                    <div style="font-size: 12px; color: #666; margin-top: 5px;">
                        Максимальный размер: 2MB. Оставьте пустым, чтобы сохранить текущее фото.
                    </div>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label class="form-label" for="quote">Цитата</label>
                        <input type="text" class="form-control" id="quote" name="quote" 
                               value="{{ old('quote', $trainer->quote) }}" placeholder="Короткая мотивирующая цитата">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="order">Порядок отображения</label>
                        <input type="number" class="form-control" id="order" name="order" 
                               value="{{ old('order', $trainer->order) }}" min="0">
                        <small style="color: #666; display: block; margin-top: 5px;">
                            Чем меньше число, тем выше тренер в списке.
                        </small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Статус</label>
                        <div style="margin-top: 5px;">
                            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                <input type="checkbox" id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', $trainer->is_active) ? 'checked' : '' }}
                                       style="width: auto;">
                                <span>Активен (отображается на сайте)</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn" style="background: #ffd700; color: #000;">
                    💾 Сохранить изменения
                </button>
                
                <a href="{{ route('admin.trainers') }}" class="btn" style="background: #666; color: white;">
                    Отмена
                </a>
                
                <button type="button" onclick="if(confirm('Вы уверены, что хотите удалить тренера {{ $trainer->name }}? Это действие нельзя отменить.')) document.getElementById('delete-form').submit();" 
                        class="btn btn-danger" style="background: #dc3545; color: white;">
                    🗑️ Удалить тренера
                </button>
            </div>
        </form>
        
        <form id="delete-form" action="{{ route('admin.trainers.delete', $trainer->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            const addSpecializationBtn = document.getElementById('add-specialization');
            const specializationsContainer = document.getElementById('specializations-container');
            
            addSpecializationBtn.addEventListener('click', function() {
                const specializationInput = document.createElement('div');
                specializationInput.className = 'specialization-input';
                specializationInput.style.marginBottom = '10px';
                specializationInput.style.display = 'flex';
                specializationInput.style.gap = '10px';
                
                specializationInput.innerHTML = `
                    <input type="text" class="form-control" name="specializations[]" placeholder="Специализация" style="flex: 1;" required>
                    <button type="button" class="btn btn-danger remove-specialization" style="padding: 8px 12px;">
                        Удалить
                    </button>
                `;
                
                specializationsContainer.appendChild(specializationInput);
                
                
                specializationInput.querySelector('.remove-specialization').addEventListener('click', function() {
                    const inputs = specializationsContainer.querySelectorAll('.specialization-input');
                    if (inputs.length > 1) {
                        specializationInput.remove();
                    } else {
                        alert('Должна остаться хотя бы одна специализация');
                    }
                });
            });
            
            
            document.querySelectorAll('.remove-specialization').forEach(btn => {
                btn.addEventListener('click', function() {
                    const inputs = specializationsContainer.querySelectorAll('.specialization-input');
                    if (inputs.length > 1) {
                        this.closest('.specialization-input').remove();
                    } else {
                        alert('Должна остаться хотя бы одна специализация');
                    }
                });
            });
            
            
            const addSportBtn = document.getElementById('add-sport');
            const sportsContainer = document.getElementById('sports-container');
            
            addSportBtn.addEventListener('click', function() {
                const sportInput = document.createElement('div');
                sportInput.className = 'sport-input';
                sportInput.style.marginBottom = '10px';
                sportInput.style.display = 'flex';
                sportInput.style.gap = '10px';
                
                sportInput.innerHTML = `
                    <input type="text" class="form-control" name="sports[]" placeholder="Вид спорта" style="flex: 1;">
                    <button type="button" class="btn btn-danger remove-sport" style="padding: 8px 12px;">
                        Удалить
                    </button>
                `;
                
                sportsContainer.appendChild(sportInput);
                
                
                sportInput.querySelector('.remove-sport').addEventListener('click', function() {
                    sportInput.remove();
                });
            });
            
            
            document.querySelectorAll('.remove-sport').forEach(btn => {
                btn.addEventListener('click', function() {
                    this.closest('.sport-input').remove();
                });
            });
            
            
            const photoInput = document.getElementById('photo');
            photoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    
                    if (file.size > 2 * 1024 * 1024) { 
                        alert('Файл слишком большой. Максимальный размер: 2MB');
                        this.value = '';
                        return;
                    }
                    
                    
                    if (!file.type.match('image.*')) {
                        alert('Пожалуйста, выберите изображение');
                        this.value = '';
                        return;
                    }
                }
            });
            
            
            document.querySelector('input[name="name"]')?.focus();
        });
    </script>
@endsection