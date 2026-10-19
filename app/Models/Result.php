<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam',
        'score',
        'student_name',
        'meta',
        'course_id',
        'consent_given',
        'sort',
    ];

    protected function casts(): array
    {
        return [
            'consent_given' => 'boolean',
        ];
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
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
