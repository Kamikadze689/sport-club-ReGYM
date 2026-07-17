<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель @yield('title')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }
        
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 250px;
            background: #000;
            color: #fff;
            padding: 20px 0;
        }
        
        .sidebar-header {
            padding: 0 20px 20px;
            border-bottom: 1px solid #333;
        }
        
        .sidebar-title {
            color: #FFD700;
            font-size: 20px;
            font-weight: bold;
        }
        
        .nav {
            padding: 20px 0;
        }
        
        .nav-link {
            display: block;
            padding: 12px 20px;
            color: #fff;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            background: #333;
            color: #FFD700;
        }
        
        .nav-link.active {
            background: #FFD700;
            color: #000;
        }
        
        .main-content {
            flex: 1;
            padding: 20px;
        }
        
        .header {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .header h1 {
            color: #000;
        }
        
        .card {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .btn {
            display: inline-block;
            padding: 8px 16px;
            background: #FFD700;
            color: #000;
            text-decoration: none;
            border-radius: 3px;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        
        .btn:hover {
            background: #ffed4a;
        }
        
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        
        .btn-danger:hover {
            background: #c82333;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }
        
        .table th,
        .table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        
        .table th {
            background: #000;
            color: #fff;
        }
        
        .table tr:hover {
            background: #f8f9fa;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        
        .alert {
            padding: 15px;
            border-radius: 3px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #FFD700;
        }
        
        .stat-label {
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-title">ReGYM Admin</div>
                <div style="font-size: 14px; color: #999; margin-top: 5px;">Панель управления</div>
            </div>
            
            <nav class="nav">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Дашборд</a>
                <a href="{{ route('admin.trainers') }}" class="nav-link {{ request()->routeIs('admin.trainers*') ? 'active' : '' }}">Тренеры</a>
                <a href="{{ route('admin.prices.management') }}" class="nav-link {{ request()->routeIs('admin.trainers*') ? 'active' : '' }}">Управление ценами</a>
                <a href="{{ route('admin.requests') }}" class="nav-link {{ request()->routeIs('admin.requests*') ? 'active' : '' }}">Заявки</a>
                <a href="{{ route('admin.layout') }}" class="nav-link {{ request()->routeIs('admin.layout*') ? 'active' : '' }}">Планировка зала</a>
                <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">Настройки</a>
                <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px; padding: 0 20px;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #fff; cursor: pointer; padding: 12px 0; width: 100%; text-align: left;">
                        Выйти
                    </button>
                </form>
            </nav>
        </aside>
        
        
        <main class="main-content">
            @yield('content')
        </main>
    </div>
    
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            const deleteForms = document.querySelectorAll('form[data-confirm]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Вы уверены, что хотите удалить этот элемент?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>