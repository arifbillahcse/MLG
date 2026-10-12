<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ProcessStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'step_label',
        'title',
        'title_bn',
        'body',
        'body_bn',
        'sort',
    ];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    /** Steps with no destination apply to every country. */
    public function scopeGeneric($q)
    {
        return $q->whereNull('destination_id');
    }

    public function scopeOrdered($q)
    {
        return $q->orderBy('sort')->orderBy('id');
    }
}
