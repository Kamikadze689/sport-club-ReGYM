<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceItem extends Model
{
    use HasFactory;

    protected $table = 'price_items';

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'price_day',
        'price_full',
        'price_personal',
        'price_group',
        'price_student',
        'price_youth',
        'price_adult',
        'property_values',
        'description',
        'has_discount',
        'is_popular',
        'order',
        'is_active'
    ];

    protected $casts = [
        'property_values' => 'array',
        'has_discount' => 'boolean',
        'is_popular' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'price_day' => 'decimal:2',
        'price_full' => 'decimal:2',
        'price_personal' => 'decimal:2',
        'price_group' => 'decimal:2',
        'price_student' => 'decimal:2',
        'price_youth' => 'decimal:2',
        'price_adult' => 'decimal:2',
    ];

    
    public function getMainPrice()
    {
        if ($this->price_full > 0) return $this->price_full;
        if ($this->price_day > 0) return $this->price_day;
        if ($this->price > 0) return $this->price;
        return 0;
    }

    
    public function getAvailablePrices()
    {
        $prices = [];
        
        if ($this->price_day > 0) {
            $prices['day'] = ['name' => 'Дневной (7:00-16:00)', 'price' => $this->price_day];
        }
        if ($this->price_full > 0) {
            $prices['full'] = ['name' => 'Полный день (7:00-23:00)', 'price' => $this->price_full];
        }
        if ($this->price_personal > 0) {
            $prices['personal'] = ['name' => 'Персональная тренировка', 'price' => $this->price_personal];
        }
        if ($this->price_group > 0) {
            $prices['group'] = ['name' => 'Групповая тренировка', 'price' => $this->price_group];
        }
        if ($this->price_student > 0) {
            $prices['student'] = ['name' => 'Студенческий', 'price' => $this->price_student];
        }
        if ($this->price_youth > 0) {
            $prices['youth'] = ['name' => 'До 18 лет', 'price' => $this->price_youth];
        }
        if ($this->price_adult > 0) {
            $prices['adult'] = ['name' => 'От 24 лет', 'price' => $this->price_adult];
        }
        
        return $prices;
    }

    public function category()
    {
        return $this->belongsTo(PriceCategory::class, 'category_id');
    }

    public function getPropertyValue($propertyName)
    {
        if (!$this->property_values) return null;
        
        $values = is_array($this->property_values) ? $this->property_values : json_decode($this->property_values, true);
        
        return $values[$propertyName] ?? null;
    }

    public function scopePopular($query)
    {
        return $query->where('is_popular', true);
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