<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'phone_code',
        'currency_code',
        'currency_symbol',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active countries
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get countries for select dropdown
     */
    public static function getForSelect()
    {
        return static::active()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->pluck('name', 'id');
    }

    /**
     * Get regions for this country
     */
    public function regions()
    {
        return $this->hasMany(Region::class);
    }
}
