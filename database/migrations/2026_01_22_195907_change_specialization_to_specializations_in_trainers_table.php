<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Trainer;

return new class extends Migration
{
    public function up(): void
    {
        
        if (Schema::hasColumn('trainers', 'specialization')) {
            
            if (!Schema::hasColumn('trainers', 'specializations')) {
                
                Schema::table('trainers', function (Blueprint $table) {
                    $table->json('specializations')->nullable()->after('specialization');
                });
            }
            
            
            $trainers = Trainer::all();
            foreach ($trainers as $trainer) {
                $oldValue = $trainer->getRawOriginal('specialization');
                if (!empty($oldValue) && empty($trainer->specializations)) {
                    $trainer->specializations = json_encode([$oldValue]);
                    $trainer->save();
                }
            }
            
            
            Schema::table('trainers', function (Blueprint $table) {
                $table->dropColumn('specialization');
            });
        } else {
            
            if (!Schema::hasColumn('trainers', 'specializations')) {
                Schema::table('trainers', function (Blueprint $table) {
                    $table->json('specializations')->nullable()->after('name');
                });
            }
        }
    }

    public function down(): void
    {
        
        if (!Schema::hasColumn('trainers', 'specialization')) {
            Schema::table('trainers', function (Blueprint $table) {
                $table->string('specialization')->nullable()->after('name');
            });
        }
        
        
        $trainers = Trainer::all();
        foreach ($trainers as $trainer) {
            $specializations = json_decode($trainer->specializations, true);
            if (!empty($specializations) && is_array($specializations)) {
                $trainer->specialization = $specializations[0];
                $trainer->save();
            }
        }
        
        
        if (Schema::hasColumn('trainers', 'specializations')) {
            Schema::table('trainers', function (Blueprint $table) {
                $table->dropColumn('specializations');
            });
        }
    }
};