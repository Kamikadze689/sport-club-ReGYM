<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gym_infos', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->index();
            $table->text('value')->nullable();
            $table->string('type')->default('text');
            $table->text('description')->nullable();
            $table->timestamps();
        });
        
        
        $this->seedInitialData();
    }
    
    private function seedInitialData(): void
    {
        $initialData = [
            [
                'key' => 'phone',
                'value' => '+7 (908) 839-08-08',
                'type' => 'text',
                'description' => 'Основной телефон для связи'
            ],
            [
                'key' => 'address',
                'value' => '3-й микрорайон, д. 6Б, Курган',
                'type' => 'text',
                'description' => 'Адрес фитнес-клуба'
            ],
            [
                'key' => 'work_hours_weekdays',
                'value' => '7:00-23:00',
                'type' => 'text',
                'description' => 'Время работы в будние дни'
            ],
            [
                'key' => 'work_hours_weekends',
                'value' => '9:00-21:00',
                'type' => 'text',
                'description' => 'Время работы в выходные дни'
            ],
            [
                'key' => 'discount_info',
                'value' => 'Скидка 10%: Школьникам, студентам, пенсионерам, мастерам спорта',
                'type' => 'text',
                'description' => 'Информация о скидках'
            ],
            [
                'key' => 'email',
                'value' => 'info@regum.ru',
                'type' => 'text',
                'description' => 'Email для связи'
            ],
            [
                'key' => 'map_url',
                'value' => 'https://yandex.ru/maps/org/regum/',
                'type' => 'url',
                'description' => 'Ссылка на карту'
            ]
        ];
        
        foreach ($initialData as $data) {
            \App\Models\GymInfo::create($data);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('gym_infos');
    }
};