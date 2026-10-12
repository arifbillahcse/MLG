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
        'vocabulary',
        'characters',
        'outcomes',
        'fee_in_class',
        'fee_online',
        'sort',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'outcomes' => 'array',
            'months' => 'integer',
            'classes' => 'integer',
            'fee_in_class' => 'integer',
            'fee_online' => 'integer',
            'is_active' => 'boolean',
        ];
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
