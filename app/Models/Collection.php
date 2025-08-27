<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id',
        'receipt_number',
        'total_amount',
        'donation_type',
        'status',
        'collection_date',
        'notes',
        'created_by',
        'cancelled_by',
        'cancelled_at',
    ];

    protected $casts = [
        'collection_date' => 'date',
        'cancelled_at' => 'datetime',
        'total_amount' => 'decimal:2',
    ];

    public function donor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'donor_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(CollectionPayment::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function cancelledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('collection_date', [$startDate, $endDate]);
    }

    public function scopeByDonationType($query, $type)
    {
        return $query->where('donation_type', $type);
    }

    public function cancel($userId): bool
    {
        $this->update([
            'status' => 'cancelled',
            'cancelled_by' => $userId,
            'cancelled_at' => now(),
        ]);

        return true;
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function getPaymentBreakdownAttribute(): array
    {
        return $this->payments()
            ->selectRaw('payment_mode, SUM(amount) as total_amount')
            ->groupBy('payment_mode')
            ->pluck('total_amount', 'payment_mode')
            ->toArray();
    }

    public static function generateReceiptNumber(): string
    {
        $prefix = 'RCP';
        $year = date('Y');
        $lastReceipt = static::where('receipt_number', 'like', "{$prefix}{$year}%")
            ->orderBy('receipt_number', 'desc')
            ->first();

        if ($lastReceipt) {
            $lastNumber = (int) substr($lastReceipt->receipt_number, -6);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . $year . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
    }
}
