<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class AcceptanceLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'university',
        'destination_id',
        'intake',
        'image',
        'consent_given',
        'sort',
    ];

    protected function casts(): array
    {
        return [
            'consent_given' => 'boolean',
        ];
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    public function scopePublishable($q)
    {
        return $q->where('consent_given', true);
    }

    public function scopeOrdered($q)
    {
        return $q->orderBy('sort')->orderBy('id');
    }
}
