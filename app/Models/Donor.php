<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Donor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'pincode',
        'city',
        'state',
        'country',
        'mobile_main',
        'mobile_alt1',
        'mobile_alt2',
        'email',
        'birth_date',
        'wedding_date',
        'donor_type',
        'status',
        'notes',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'wedding_date' => 'date',
    ];

    public function collections(): HasMany
    {
        return $this->hasMany(Collection::class);
    }

    public function magazineSubscriptions(): HasMany
    {
        return $this->hasMany(MagazineSubscription::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeNamed($query)
    {
        return $query->where('donor_type', 'named');
    }

    public function scopeAnonymous($query)
    {
        return $query->where('donor_type', 'anonymous');
    }

    public function getFullAddressAttribute(): string
    {
        return "{$this->address}, {$this->city}, {$this->state} - {$this->pincode}";
    }

    public function getTotalDonationsAttribute(): float
    {
        return $this->collections()->where('status', 'active')->sum('total_amount');
    }

    public function getLastDonationAttribute()
    {
        return $this->collections()
            ->where('status', 'active')
            ->orderBy('collection_date', 'desc')
            ->first();
    }

    public function checkDuplicate(): bool
    {
        return static::where('name', $this->name)
            ->where('address', $this->address)
            ->where('id', '!=', $this->id)
            ->exists();
    }
}
