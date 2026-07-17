<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceCategoryProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'values',
        'order'
    ];

    protected $casts = [
        'values' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(PriceCategory::class, 'category_id');
    }

    
    public function getValuesArrayAttribute()
    {
        if (empty($this->values)) {
            return [];
        }
        
        if (is_array($this->values)) {
            return $this->values;
        }
        
        return array_map('trim', explode(',', $this->values));
    }

    
    public function setValuesAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['values'] = implode(',', $value);
        } else {
            $this->attributes['values'] = $value;
        }
    }
}