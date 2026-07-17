<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\GymInfo;

class SettingsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Регистрируем singleton для настроек
        $this->app->singleton('gymSettings', function () {
            return GymInfo::getAllAsArray();
        });
    }
    
    public function boot(): void
    {
        // Делаем настройки доступными во всех вьюхах
        view()->composer('*', function ($view) {
            $gymSettings = GymInfo::getAllAsArray();
            $view->with('gymSettings', $gymSettings);
        });
    }
}