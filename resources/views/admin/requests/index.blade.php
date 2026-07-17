@extends('admin.layout')

@section('title', ' - Заявки')
@section('content')
    <div class="header">
        <h1>Заявки от посетителей</h1>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="card">
        @if($requests->count() > 0)
        <table class="table">
            <thead>
                <tr style="background: #000;">
                    <th style="color: #ffd700; font-weight: 600; padding: 12px;">Дата</th>
                    <th style="color: #ffd700; font-weight: 600; padding: 12px;">Имя</th>
                    <th style="color: #ffd700; font-weight: 600; padding: 12px;">Телефон</th>
                    <th style="color: #ffd700; font-weight: 600; padding: 12px;">Email</th>
                    <th style="color: #ffd700; font-weight: 600; padding: 12px;">Тип заявки</th>
                    <th style="color: #ffd700; font-weight: 600; padding: 12px;">Тренер</th>
                    <th style="color: #ffd700; font-weight: 600; padding: 12px;">Сообщение</th>
                    <th style="color: #ffd700; font-weight: 600; padding: 12px;">Статус</th>
                    <th style="color: #ffd700; font-weight: 600; padding: 12px;">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">{{ $request->created_at->format('d.m.Y H:i') }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">{{ $request->full_name }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">{{ $request->phone }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">{{ $request->email ?: '-' }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">
                        @if($request->request_type == 'trial_training')
                            Пробная тренировка
                        @elseif($request->request_type == 'personal_training')
                            Персональная тренировка
                        @elseif($request->request_type == 'subscription')
                            Абонемент
                        @elseif($request->request_type == 'trainer_consultation')
                            Консультация с тренером
                        @elseif($request->request_type == 'consultation')
                            Консультация
                        @else
                            {{ $request->request_type }}
                        @endif
                    </td>
                    <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">
                        @php
                            
                            $trainerName = null;
                            if (!empty($request->message)) {
                                $lines = explode("\n", $request->message);
                                foreach ($lines as $line) {
                                    if (strpos($line, 'Тренер:') === 0) {
                                        $trainerName = trim(str_replace('Тренер:', '', $line));
                                        break;
                                    }
                                }
                            }
                        @endphp
                        
                        @if($trainerName)
                            {{ $trainerName }}
                        @else
                            -
                        @endif
                    </td>
                    <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">
                        @if(empty(trim($request->message)))
                            <span style="color: #999;">Сообщения нет</span>
                        @else
                            <button type="button" class="btn-yellow" 
                                    onclick="showMessageModal('{{ $request->full_name }}', `{{ str_replace('"', '&quot;', $request->message) }}`)">
                                Просмотреть
                            </button>
                        @endif
                    </td>
                    <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">
                        @if($request->is_processed)
                        <span style="color: green; font-weight: 500;">Обработана</span>
                        @else
                        <span style="color: orange; font-weight: 500;">Новая</span>
                        @endif
                    </td>
                    <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">
                        @if(!$request->is_processed)
                        <form action="{{ route('admin.requests.process', $request->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-yellow" style="margin-top: 5px;">
                                Отметить как обработанную
                            </button>
                        </form>
                        @else
                        <span style="color: #666; font-size: 14px;">Обработана</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div style="margin-top: 20px;">
            {{ $requests->links() }}
        </div>
        @else
        <p>Нет заявок</p>
        @endif
    </div>

    
    <div id="messageModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div style="background: white; padding: 30px; border-radius: 8px; max-width: 600px; width: 90%; max-height: 80vh; overflow-y: auto; box-shadow: 0 4px 20px rgba(0,0,0,0.2);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 id="modalTitle" style="margin: 0; color: #333;">Сообщение</h3>
                <button type="button" onclick="closeMessageModal()" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #666;">&times;</button>
            </div>
            
            <div style="margin-bottom: 20px; padding: 10px; background: #f9f9f9; border-radius: 4px;">
                <strong style="color: #333;">От:</strong> <span id="modalFrom" style="color: #555;">{{ $request->full_name ?? '' }}</span>
            </div>
            
            <div style="white-space: pre-wrap; background: #f5f5f5; padding: 20px; border-radius: 4px; border-left: 4px solid #ffd700; min-height: 100px; max-height: 300px; overflow-y: auto;">
                <span id="modalMessage" style="color: #333;"></span>
            </div>
            
            <div style="margin-top: 20px; text-align: right;">
                <button type="button" onclick="closeMessageModal()" class="btn-yellow" style="padding: 10px 20px;">Закрыть</button>
            </div>
        </div>
    </div>

    <script>
        
        function showMessageModal(from, message) {
            document.getElementById('modalFrom').textContent = from;
            document.getElementById('modalMessage').textContent = message;
            document.getElementById('messageModal').style.display = 'flex';
        }
        
        
        function closeMessageModal() {
            document.getElementById('messageModal').style.display = 'none';
        }
        
        
        document.getElementById('messageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeMessageModal();
            }
        });
        
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeMessageModal();
            }
        });
    </script>

    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .table th {
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
        }
        
        .table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
            vertical-align: top;
        }
        
        .table tr:hover {
            background: #f8f9fa;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        
        .btn-yellow {
            background: #ffd700;
            color: #000;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-weight: 500;
            transition: background 0.2s, transform 0.1s;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .btn-yellow:hover {
            background: #ffc800;
            transform: translateY(-1px);
            box-shadow: 0 3px 6px rgba(0,0,0,0.15);
        }
        
        .btn-yellow:active {
            transform: translateY(0);
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }
        
        
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 20px 0 0 0;
        }
        
        .pagination li {
            margin: 0 4px;
        }
        
        .pagination a,
        .pagination span {
            display: inline-block;
            padding: 8px 12px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            color: #007bff;
            text-decoration: none;
        }
        
        .pagination a:hover {
            background: #e9ecef;
        }
        
        .pagination .active span {
            background: #007bff;
            color: white;
            border-color: #007bff;
        }
        
        .pagination .disabled span {
            color: #6c757d;
            cursor: not-allowed;
        }
    </style>
@endsection