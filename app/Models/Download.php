<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = [
        'title', 'file_path', 'type', 'description', 'authors', 'journal', 'year', 'published_at', 'download_count', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderByDesc('year');
    }

    public function scopePublications($query)
    {
        return $query->where('type', 'publication');
    }

    public function scopeReports($query)
    {
        return $query->where('type', 'report');
    }
}
