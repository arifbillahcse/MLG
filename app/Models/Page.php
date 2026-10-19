<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Page extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'slug',
        'title',
        'title_bn',
        'body',
        'body_bn',
        'meta_title',
        'meta_description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeActive($q)
    {
        return $q->where('is_active', true);
    }
}
