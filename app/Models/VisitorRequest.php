<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'request_type',
        'message',
        'is_processed'
    ];

    protected $casts = [
        'is_processed' => 'boolean'
    ];

    public function scopePending($query)
    {
        return $query->where('is_processed', false);
    }

    public function markAsProcessed()
    {
        $this->update(['is_processed' => true]);
    }
}