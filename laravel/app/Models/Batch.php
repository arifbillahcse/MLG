<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_level_id',
        'title',
        'tag',
        'mode',
        'days',
        'time_label',
        'duration_label',
        'starts_at',
        'seats_total',
        'seats_left',
        'is_featured',
        'is_active',
        'sort',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'seats_total' => 'integer',
            'seats_left' => 'integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function courseLevel(): BelongsTo
    {
        return $this->belongsTo(CourseLevel::class);
    }

    /** Hide batches whose start date has gone by — no stale dates on the homepage. */
    public function scopeUpcoming($q)
    {
        return $q->where('is_active', true)
                 ->where(fn ($w) => $w->whereNull('starts_at')->orWhere('starts_at', '>=', now()));
    }

    public function getSeatsFilledPercentAttribute(): int
    {
        if (! $this->seats_total) {
            return 0;
        }

        return (int) round((($this->seats_total - $this->seats_left) / $this->seats_total) * 100);
    }

    public function scopeActive($q)
    {
        return $q->where('is_active', true);
    }

    public function scopeOrdered($q)
    {
        return $q->orderBy('sort')->orderBy('id');
    }
}
