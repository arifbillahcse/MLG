<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'name_bn',
        'flag',
        'intro',
        'intro_bn',
        'highlights',
        'universities',
        'application_process',
        'visa_guidance',
        'meta_title',
        'meta_description',
        'sort',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'highlights' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function scholarships(): HasMany
    {
        return $this->hasMany(Scholarship::class)->orderBy('sort');
    }

    public function processSteps(): HasMany
    {
        return $this->hasMany(ProcessStep::class)->orderBy('sort');
    }

    public function partners(): HasMany
    {
        return $this->hasMany(Partner::class);
    }

    public function acceptanceLetters(): HasMany
    {
        return $this->hasMany(AcceptanceLetter::class);
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
