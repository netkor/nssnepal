<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name', 'designation', 'role_type', 'bio', 'photo', 'country', 'email', 'phone', 'research_gate_url', 'google_scholar_url', 'order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function scopeByRole($query, string $role)
    {
        return $query->where('role_type', $role);
    }
}
