@extends('admin.layout')

@section('title', ' - Настройки')
@section('content')
    <div class="header">
        <h1>Настройки сайта</h1>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    @if(session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
    @endif
    
    <div class="card">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            
            <h2 style="margin-bottom: 20px;">Основные настройки</h2>
            
            @php
                
                $settingsArray = [];
                if ($settings && $settings->isNotEmpty()) {
                    foreach ($settings as $setting) {
                        $settingsArray[$setting->key] = $setting->value;
                    }
                }
            @endphp
            
            <div class="form-group">
                <label class="form-label">Телефон *</label>
                <input type="text" name="settings[phone]" class="form-control" 
                       value="{{ $settingsArray['phone'] ?? '+7 (908) 839-08-08' }}" required>
                <small style="color: #888; font-size: 12px;">Формат: +7 (XXX) XXX-XX-XX</small>
            </div>
            
            <div class="form-group">
                <label class="form-label">Адрес *</label>
                <input type="text" name="settings[address]" class="form-control" 
                       value="{{ $settingsArray['address'] ?? '3-й микрорайон, д. 6Б, Курган' }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Время работы (будни) *</label>
                <input type="text" name="settings[work_hours_weekdays]" class="form-control" 
                       value="{{ $settingsArray['work_hours_weekdays'] ?? '7:00-23:00' }}" required>
                <small style="color: #888; font-size: 12px;">Формат: HH:MM-HH:MM</small>
            </div>
            
            <div class="form-group">
                <label class="form-label">Время работы (выходные) *</label>
                <input type="text" name="settings[work_hours_weekends]" class="form-control" 
                       value="{{ $settingsArray['work_hours_weekends'] ?? '9:00-21:00' }}" required>
                <small style="color: #888; font-size: 12px;">Формат: HH:MM-HH:MM</small>
            </div>
            
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="settings[email]" class="form-control" 
                       value="{{ $settingsArray['email'] ?? 'info@regum.ru' }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Информация о скидке</label>
                <textarea name="settings[discount_info]" class="form-control" rows="3">{{ $settingsArray['discount_info'] ?? 'Скидка 10%: Школьникам, студентам, пенсионерам, мастерам спорта' }}</textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Ссылка на карту (Яндекс/Google Maps)</label>
                <input type="url" name="settings[map_url]" class="form-control" 
                       value="{{ $settingsArray['map_url'] ?? 'https://yandex.ru/maps/org/regum/' }}">
            </div>
            
            <button type="submit" class="btn">Сохранить настройки</button>
        </form>
    </div>
    
    @if($settings && $settings->isNotEmpty())
    <div class="card" style="margin-top: 20px;">
        <h2 style="margin-bottom: 20px;">Текущие значения в базе данных:</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: rgba(255, 215, 0, 0.1);">
                    <th style="padding: 10px; border: 1px solid var(--color-border); text-align: left;">Ключ</th>
                    <th style="padding: 10px; border: 1px solid var(--color-border); text-align: left;">Значение</th>
                    <th style="padding: 10px; border: 1px solid var(--color-border); text-align: left;">Тип</th>
                    <th style="padding: 10px; border: 1px solid var(--color-border); text-align: left;">Описание</th>
                </tr>
            </thead>
            <tbody>
                @foreach($settings as $setting)
                <tr>
                    <td style="padding: 10px; border: 1px solid var(--color-border);">{{ $setting->key }}</td>
                    <td style="padding: 10px; border: 1px solid var(--color-border);">{{ $setting->value }}</td>
                    <td style="padding: 10px; border: 1px solid var(--color-border);">{{ $setting->type }}</td>
                    <td style="padding: 10px; border: 1px solid var(--color-border);">{{ $setting->description }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
@endsection