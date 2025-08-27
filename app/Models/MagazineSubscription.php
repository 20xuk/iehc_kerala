<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MagazineSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id',
        'magazine_name',
        'subscription_type',
        'start_date',
        'end_date',
        'status',
        'delivery_address',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function donor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'donor_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByMagazine($query, $magazineName)
    {
        return $query->where('magazine_name', $magazineName);
    }

    public function scopeBySubscriptionType($query, $type)
    {
        return $query->where('subscription_type', $type);
    }

    public function isExpired(): bool
    {
        return $this->end_date && $this->end_date->isPast();
    }

    public function getEffectiveAddressAttribute(): string
    {
        return $this->delivery_address ?: $this->donor->full_address;
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'active' => 'success',
            'inactive' => 'secondary',
            'expired' => 'warning',
            default => 'secondary'
        };
    }
}
