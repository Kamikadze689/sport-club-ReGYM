<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('price_items', function (Blueprint $table) {
            
            if (!Schema::hasColumn('price_items', 'price_day')) {
                $table->decimal('price_day', 10, 2)->default(0)->after('price')->comment('Дневной (7:00-16:00)');
            }
            if (!Schema::hasColumn('price_items', 'price_full')) {
                $table->decimal('price_full', 10, 2)->default(0)->after('price_day')->comment('Полный день (7:00-23:00)');
            }
            if (!Schema::hasColumn('price_items', 'price_personal')) {
                $table->decimal('price_personal', 10, 2)->default(0)->after('price_full')->comment('Персональная тренировка');
            }
            if (!Schema::hasColumn('price_items', 'price_group')) {
                $table->decimal('price_group', 10, 2)->default(0)->after('price_personal')->comment('Групповая тренировка');
            }
            if (!Schema::hasColumn('price_items', 'price_student')) {
                $table->decimal('price_student', 10, 2)->default(0)->after('price_group')->comment('Студенческий');
            }
            if (!Schema::hasColumn('price_items', 'price_youth')) {
                $table->decimal('price_youth', 10, 2)->default(0)->after('price_student')->comment('До 18 лет');
            }
            if (!Schema::hasColumn('price_items', 'price_adult')) {
                $table->decimal('price_adult', 10, 2)->default(0)->after('price_youth')->comment('От 24 лет');
            }
        });
    }

    public function down()
    {
        Schema::table('price_items', function (Blueprint $table) {
            $table->dropColumn([
                'price_day', 'price_full', 'price_personal', 'price_group',
                'price_student', 'price_youth', 'price_adult'
            ]);
        });
    }
};