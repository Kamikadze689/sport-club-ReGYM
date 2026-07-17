@extends('admin.layout')

@section('title', 'Добавить тренера')
@section('content')
    <div class="header">
        <h1>Добавить нового тренера</h1>
        <a href="{{ route('admin.trainers') }}" class="btn">Назад к списку</a>
    </div>
    
    <div class="card">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.trainers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Имя *</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Специализации *</label>
                <div id="specializations-container">
                    @php
                        $oldSpecializations = old('specializations', []);
                        
                        if (is_string($oldSpecializations) && !empty($oldSpecializations)) {
                            $oldSpecializations = json_decode($oldSpecializations, true) ?: [];
                        }
                    @endphp
                    
                    @if(!empty($oldSpecializations))
                        @foreach($oldSpecializations as $index => $specialization)
                        <div class="specialization-input" style="margin-bottom: 10px; display: flex; gap: 10px;">
                            <input type="text" name="specializations[]" class="form-control" 
                                   value="{{ $specialization }}" placeholder="Специализация" style="flex: 1;" required>
                            <button type="button" class="btn btn-danger remove-specialization" style="padding: 8px 12px;">
                                Удалить
                            </button>
                        </div>
                        @endforeach
                    @else
                        <div class="specialization-input" style="margin-bottom: 10px; display: flex; gap: 10px;">
                            <input type="text" name="specializations[]" class="form-control" placeholder="Специализация" style="flex: 1;" required>
                            <button type="button" class="btn btn-danger remove-specialization" style="padding: 8px 12px;">
                                Удалить
                            </button>
                        </div>
                    @endif
                </div>
                
                <button type="button" class="btn" id="add-specialization" style="margin-top: 10px; background: #333; color: white;">
                    + Добавить специализацию
                </button>
                <small style="color: #666; display: block; margin-top: 5px;">
                    Нажмите "+ Добавить специализацию" для ввода нескольких специализаций
                </small>
            </div>
            
            <div class="form-group">
                <label class="form-label">Описание</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Фото</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
                <small style="color: #666; display: block; margin-top: 5px;">
                    Максимальный размер: 2MB. Рекомендуемый размер: 400x500px. 
                    Файл будет сохранен с оригинальным именем + timestamp.
                </small>
            </div>
            
            <div class="form-group">
                <label class="form-label">Виды спорта (опционально)</label>
                <div id="sports-container">
                    @php
                        $oldSports = old('sports', []);
                        
                        if (is_string($oldSports) && !empty($oldSports)) {
                            $oldSports = json_decode($oldSports, true) ?: [];
                        }
                    @endphp
                    
                    @if(!empty($oldSports))
                        @foreach($oldSports as $index => $sport)
                        <div class="sport-input" style="margin-bottom: 10px; display: flex; gap: 10px;">
                            <input type="text" name="sports[]" class="form-control" 
                                   value="{{ $sport }}" placeholder="Вид спорта" style="flex: 1;">
                            <button type="button" class="btn btn-danger remove-sport" style="padding: 8px 12px;">
                                Удалить
                            </button>
                        </div>
                        @endforeach
                    @else
                        <div class="sport-input" style="margin-bottom: 10px; display: flex; gap: 10px;">
                            <input type="text" name="sports[]" class="form-control" placeholder="Вид спорта" style="flex: 1;">
                            <button type="button" class="btn btn-danger remove-sport" style="padding: 8px 12px;">
                                Удалить
                            </button>
                        </div>
                    @endif
                </div>
                
                <button type="button" class="btn" id="add-sport" style="margin-top: 10px; background: #333; color: white;">
                    + Добавить вид спорта
                </button>
                <small style="color: #666; display: block; margin-top: 5px;">
                    Оставьте пустым, чтобы не добавлять виды спорта
                </small>
            </div>
            
            <div class="form-group">
                <label class="form-label">Опыт (лет) *</label>
                <input type="number" name="experience_years" class="form-control" required min="0" value="{{ old('experience_years', 0) }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Цитата (опционально)</label>
                <input type="text" name="quote" class="form-control" value="{{ old('quote') }}" placeholder="Короткая мотивирующая цитата">
            </div>
            
            <div class="form-group">
                <label class="form-label">Порядок отображения</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" min="0">
                <small style="color: #666; display: block; margin-top: 5px;">
                    Чем меньше число, тем выше тренер в списке. 0 - по умолчанию.
                </small>
            </div>
            
            <div class="form-group">
                <label class="form-label">Статус</label>
                <div style="margin-top: 5px;">
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <input type="checkbox" name="is_active" value="1" 
                               {{ old('is_active', true) ? 'checked' : '' }}
                               style="width: auto;">
                        <span>Активен (отображается на сайте)</span>
                    </label>
                </div>
            </div>
            
            <button type="submit" class="btn" style="margin-top: 20px;">Сохранить тренера</button>
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
            
            
            const photoInput = document.querySelector('input[name="photo"]');
            if (photoInput) {
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
            }
            
            
            document.querySelector('input[name="name"]')?.focus();
        });
    </script>
@endsection