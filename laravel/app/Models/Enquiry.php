<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'interest',
        'message',
        'source_form',
        'source_page',
        'status',
        'admin_note',
        'assigned_to',
        'ip',
        'user_agent',
        'contacted_at',
    ];

    protected function casts(): array
    {
        return [
            'contacted_at' => 'datetime',
        ];
    }

    public const STATUSES = ['new', 'contacted', 'enrolled', 'closed'];

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function scopeNew($q)
    {
        return $q->where('status', 'new');
    }

    public function scopeLatestFirst($q)
    {
        return $q->orderByDesc('created_at');
    }
}
