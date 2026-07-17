<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class GymZone extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image', 
        'color',
        'grid_x',
        'grid_y',
        'width',
        'height',
        'order',
        'is_active',
    ];

    protected $casts = [
        'grid_x'    => 'integer',
        'grid_y'    => 'integer',
        'width'     => 'integer',
        'height'    => 'integer',
        'order'     => 'integer',
        'is_active' => 'boolean',
    ];

    
    public function getPhotoAttribute()
    {
        return $this->image;
    }

    
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order')->orderBy('id');
    }

    
    public static function getZoneTypes()
    {
        
        return [
            'training' => 'Тренировочная зона',
            'cardio' => 'Кардио зона',
            'free_weights' => 'Свободные веса',
            'stretching' => 'Зона растяжки',
            'functional' => 'Функциональная зона',
        ];
    }
}