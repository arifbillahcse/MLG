<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'destination_id',
        'logo',
        'url',
        'is_verified',
        'sort',
    ];

    protected function casts(): array
    {
        return [
            'is_verified' => 'boolean',
        ];
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    /** Only show institutions the claim can be substantiated for. */
    public function scopeVerified($q)
    {
        return $q->where('is_verified', true);
    }

    public function scopeOrdered($q)
    {
        return $q->orderBy('sort')->orderBy('id');
    }
}
