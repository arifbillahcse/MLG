<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Course extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'slug',
        'name',
        'name_bn',
        'native_name',
        'glyph',
        'exam_name',
        'description',
        'description_bn',
        'is_test_prep',
        'offers_online',
        'offers_in_class',
        'price_from',
        'meta_title',
        'meta_description',
        'sort',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_test_prep' => 'boolean',
            'offers_online' => 'boolean',
            'offers_in_class' => 'boolean',
            'price_from' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function levels(): HasMany
    {
        return $this->hasMany(CourseLevel::class)->orderBy('sort');
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class)->orderBy('sort');
    }

    public function faculty(): HasMany
    {
        return $this->hasMany(Faculty::class)->orderBy('sort');
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
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
