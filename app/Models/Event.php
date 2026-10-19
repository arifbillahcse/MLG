<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'description',
        'starts_at',
        'venue',
        'seats',
        'is_free',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'seats' => 'integer',
            'is_free' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function scopeUpcoming($q)
    {
        return $q->where('is_active', true)
                 ->where(fn ($w) => $w->whereNull('starts_at')->orWhere('starts_at', '>=', now()))
                 ->orderBy('starts_at');
    }

    public function scopeOfType($q, string $type)
    {
        return $q->where('type', $type);
    }
}
