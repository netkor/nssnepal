<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = ['type', 'cost_initial', 'cost_yearly', 'description', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'cost_initial' => 'decimal:2',
        'cost_yearly' => 'decimal:2',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
