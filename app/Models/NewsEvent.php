<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsEvent extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'excerpt', 'type', 'featured_image', 'published_at', 'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($item) {
            if (empty($item->slug)) {
                $item->slug = Str::slug($item->title);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where('published_at', '<=', now())
                     ->orderByDesc('published_at');
    }

    public function scopeNews($query)
    {
        return $query->where('type', 'news');
    }

    public function scopeEvents($query)
    {
        return $query->where('type', 'event');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
