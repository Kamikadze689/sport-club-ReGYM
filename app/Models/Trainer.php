<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specializations', 
        'description',
        'photo',
        'sports',
        'experience_years',
        'quote',
        'order',
        'is_active'
    ];

    protected $casts = [
        'specializations' => 'array', 
        'sports' => 'array',
        'is_active' => 'boolean'
    ];

    
    public function getSpecializationsArrayAttribute()
    {
        if (is_array($this->specializations)) {
            return array_filter($this->specializations, function($item) {
                return !empty(trim($item));
            });
        }
        
        if (is_string($this->specializations) && !empty($this->specializations)) {
            $decoded = json_decode($this->specializations, true);
            if (is_array($decoded)) {
                return array_filter($decoded, function($item) {
                    return !empty(trim($item));
                });
            }
        }
        
        return [];
    }

    
    public function getSpecializationAttribute()
    {
        $specializations = $this->getSpecializationsArrayAttribute();
        return !empty($specializations) ? $specializations[0] : null;
    }

    
    public function getSportsArrayAttribute()
    {
        if (is_array($this->sports)) {
            return array_filter($this->sports, function($item) {
                return !empty(trim($item));
            });
        }
        
        if (is_string($this->sports) && !empty($this->sports)) {
            $decoded = json_decode($this->sports, true);
            if (is_array($decoded)) {
                return array_filter($decoded, function($item) {
                    return !empty(trim($item));
                });
            }
        }
        
        return [];
    }

    
    public function hasSpecializations()
    {
        return !empty($this->getSpecializationsArrayAttribute());
    }

    
    public function hasSports()
    {
        return !empty($this->getSportsArrayAttribute());
    }

    
    public function getSpecializationsStringAttribute()
    {
        $specializations = $this->getSpecializationsArrayAttribute();
        return !empty($specializations) ? implode(', ', $specializations) : '';
    }

    
    public function getSportsStringAttribute()
    {
        $sports = $this->getSportsArrayAttribute();
        return !empty($sports) ? implode(', ', $sports) : '';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }
}