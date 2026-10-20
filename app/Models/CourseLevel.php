<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class CourseLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'code',
        'label',
        'subtitle',
        'months',
        'classes',
        'days_per_week',
        'hours_per_day',
        'vocabulary',
        'characters',
        'outcomes',
        'fee_before',
        'fee_in_class',
        'fee_online',
        'sort',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'outcomes' => 'array',
            'months' => 'float',
            'classes' => 'integer',
            'days_per_week' => 'integer',
            'hours_per_day' => 'float',
            'fee_before' => 'integer',
            'fee_in_class' => 'integer',
            'fee_online' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /** "3.5" stays 3.5, but "3.0" reads as 3. */
    public function getMonthsLabelAttribute(): ?string
    {
        if (blank($this->months)) {
            return null;
        }

        return rtrim(rtrim(number_format((float) $this->months, 1), '0'), '.');
    }

    /** "4 days a week · 2 hours a day", skipping whatever is not set. */
    public function getScheduleLabelAttribute(): ?string
    {
        $parts = [];

        if ($this->days_per_week) {
            $parts[] = $this->days_per_week.' days a week';
        }

        if ($this->hours_per_day) {
            $hours = rtrim(rtrim(number_format((float) $this->hours_per_day, 1), '0'), '.');
            $parts[] = $hours.' hours a day';
        }

        return $parts ? implode(' · ', $parts) : null;
    }

    /**
     * The headline price — the pre-discount figure when an offer is running,
     * otherwise simply the fee. Never null when a fee exists, so the "Price"
     * column always has something to show.
     */
    public function getRegularFeeAttribute(): ?int
    {
        return $this->fee_before ?: $this->fee_in_class;
    }

    /** Only a real saving counts — a "discount" that is not one is not shown. */
    public function hasDiscount(): bool
    {
        return filled($this->fee_before)
            && filled($this->fee_in_class)
            && $this->fee_before > $this->fee_in_class;
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function batches(): HasMany
    {
        return $this->hasMany(Batch::class);
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
