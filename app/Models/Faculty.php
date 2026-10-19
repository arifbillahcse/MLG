<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculty';

    protected $fillable = [
        'name',
        'initials',
        'role',
        'credential',
        'quote',
        'bio',
        'photo',
        'avatar_variant',
        'group',
        'course_id',
        'sort',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function scopeInstructors($q)
    {
        return $q->where('group', 'instructor');
    }

    public function scopeCounsellors($q)
    {
        return $q->where('group', 'counsellor');
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
