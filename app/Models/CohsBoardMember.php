<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CohsBoardMember extends Model
{
    protected $fillable = [
        'school_id', 'name', 'role_title', 'bio', 'image_path',
        'highlight', 'sort_order', 'is_published',
    ];

    protected function casts(): array
    {
        return [
            'highlight' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
