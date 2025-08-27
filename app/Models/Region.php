<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active regions
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get regions for select dropdown
     */
    public static function getForSelect()
    {
        return static::active()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->pluck('name', 'id');
    }
}
