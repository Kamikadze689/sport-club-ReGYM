@extends('admin.layout')

@section('title', 'Тренеры')

@section('content')
    <div class="header">
        <h1>Управление тренерами</h1>
        <a href="{{ route('admin.trainers.create') }}" class="btn">+ Добавить тренера</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        @if($trainers->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Фото</th>
                    <th>Имя</th>
                    <th>Специализация</th>
                    <th>Опыт</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trainers as $trainer)
                <tr>
                    <td>{{ $trainer->id }}</td>
                    <td>
                        @if($trainer->photo)
                        <?php
                        $photoPath = $trainer->photo;
                        $storagePath = storage_path('app/public/' . $photoPath);
                        $publicPath = public_path('storage/' . $photoPath);
                        $existsInStorage = file_exists($storagePath);
                        $existsInPublic = file_exists($publicPath);
                        $fileSizeStorage = $existsInStorage ? round(filesize($storagePath)/1024, 1) : 0;
                        $fileSizePublic = $existsInPublic ? round(filesize($publicPath)/1024, 1) : 0;
                        ?>
                        <img src="{{ asset('storage/' . $trainer->photo) }}" alt="{{ $trainer->name }}" 
                             style="width: 50px; height: 50px; object-fit: cover; border-radius: 3px;"
                             onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjUwIiBoZWlnaHQ9IjUwIiBmaWxsPSIjZjVmNWY1Ii8+Cjx0ZXh0IHg9IjI1IiB5PSIyNSIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEyIiBmaWxsPSIjOTk5IiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkeT0iLjNlbSI+Tm8gaW1hZ2U8L3RleHQ+Cjwvc3ZnPgo=';">
                        <br>
                        <small style="font-size: 9px; color: #666; display: block; margin-top: 2px;">
                            <span style="color: {{ $existsInStorage ? 'green' : 'red' }};">S</span>
                            <span style="color: {{ $existsInPublic ? 'green' : 'red' }};">P</span>
                        </small>
                        @else
                        <div style="width: 50px; height: 50px; background: #f5f5f5; border-radius: 3px; display: flex; align-items: center; justify-content: center;">
                            <span style="color: #999; font-size: 12px;">Нет фото</span>
                        </div>
                        @endif
                    </td>
                    <td>{{ $trainer->name }}</td>
                    <td>
                        @php
                            
                            $specializations = [];
                            
                            if (!empty($trainer->specializations)) {
                                
                                if (is_string($trainer->specializations)) {
                                    $decoded = json_decode($trainer->specializations, true);
                                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                        $specializations = $decoded;
                                    } else {
                                        $specializations = [$trainer->specializations];
                                    }
                                }
                                
                                elseif (is_array($trainer->specializations)) {
                                    $specializations = $trainer->specializations;
                                }
                            }
                        @endphp
                        
                        @if(!empty($specializations))
                            {{ implode(', ', $specializations) }}
                        @else
                            <span style="color: #999;">—</span>
                        @endif
                    </td>
                    <td>{{ $trainer->experience_years }} лет</td>
                    <td>
                        @if($trainer->is_active)
                            <span style="background: #d4edda; color: #155724; padding: 3px 8px; border-radius: 3px; font-size: 12px;">
                                Активен
                            </span>
                        @else
                            <span style="background: #f8d7da; color: #721c24; padding: 3px 8px; border-radius: 3px; font-size: 12px;">
                                Неактивен
                            </span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 5px;">
                            <a href="{{ route('admin.trainers.edit', $trainer->id) }}" class="btn" style="padding: 5px 10px; font-size: 12px;">
                                Редактировать
                            </a>
                            <form action="{{ route('admin.trainers.delete', $trainer->id) }}" method="POST" style="display: inline;" 
                                  onsubmit="return confirm('Удалить тренера {{ $trainer->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 12px;">
                                    Удалить
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div style="text-align: center; padding: 40px;">
            <p>Тренеров пока нет</p>
            <a href="{{ route('admin.trainers.create') }}" class="btn">Добавить первого тренера</a>
        </div>
        @endif
    </div>

    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }
        .table th {
            background: #f8f9fa;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
            font-size: 14px;
        }
        .table td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
            font-size: 14px;
        }
        .table tr:hover {
            background: #f8f9fa;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.2s;
        }
        .btn:hover {
            background: #0056b3;
        }
        .btn-danger {
            background: #dc3545;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            overflow: hidden;
        }
        .alert {
            padding: 12px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
        }
        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }
        .form-control:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
        }
        .specialization-input, .sport-input {
            margin-bottom: 10px;
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .specialization-input input, .sport-input input {
            flex: 1;
        }
        small {
            color: #666;
            font-size: 12px;
        }
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Вы уверены?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
@endsection