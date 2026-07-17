<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'description',
        'properties',
        'has_discount',
        'is_popular',
        'order',
        'is_active'
    ];

    protected $casts = [
        'properties' => 'array',
        'has_discount' => 'boolean',
        'is_popular' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2'
    ];

    public function category()
    {
        return $this->belongsTo(PriceCategory::class, 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePopular($query)
    {
        return $query->where('is_popular', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('price');
    }

    public function getPropertyValue($propertyName)
    {
        return $this->properties[$propertyName] ?? null;
    }
}