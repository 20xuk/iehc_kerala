<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CollectionPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_id',
        'payment_mode',
        'amount',
        'transaction_id',
        'cheque_number',
        'bank_name',
        'cheque_date',
        'payment_notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'cheque_date' => 'date',
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    public function scopeByPaymentMode($query, $mode)
    {
        return $query->where('payment_mode', $mode);
    }

    public function getFormattedAmountAttribute(): string
    {
        return '₹' . number_format($this->amount, 2);
    }

    public function getPaymentDetailsAttribute(): string
    {
        $details = [];
        
        if ($this->payment_mode === 'cheque') {
            $details[] = "Cheque: {$this->cheque_number}";
            if ($this->bank_name) {
                $details[] = "Bank: {$this->bank_name}";
            }
            if ($this->cheque_date) {
                $details[] = "Date: " . $this->cheque_date->format('d/m/Y');
            }
        } elseif ($this->payment_mode === 'online' || $this->payment_mode === 'upi') {
            if ($this->transaction_id) {
                $details[] = "TXN ID: {$this->transaction_id}";
            }
        }

        return implode(', ', $details);
    }
}
