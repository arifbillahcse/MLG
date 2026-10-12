<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'meta',
        'quote',
        'type',
        'video_url',
        'thumbnail',
        'thumb_variant',
        'rating',
        'consent_given',
        'is_featured',
        'sort',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'consent_given' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    /** Never publish a testimonial we do not hold permission for. */
    public function scopePublishable($q)
    {
        return $q->where('consent_given', true);
    }

    public function scopeOfType($q, string $type)
    {
        return $q->where('type', $type);
    }

    public function scopeOrdered($q)
    {
        return $q->orderBy('sort')->orderBy('id');
    }
}
