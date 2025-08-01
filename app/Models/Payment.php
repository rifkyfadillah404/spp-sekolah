<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'amount',
        'payment_type',
        'transaction_status',
        'transaction_id',
        'fraud_status',
        'transaction_time',
        'midtrans_response',
        'description'
    ];

    protected $casts = [
        'midtrans_response' => 'array',
        'transaction_time' => 'datetime',
        'amount' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sppBills()
    {
        return $this->hasMany(SppBill::class);
    }

    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'warning',
            'settlement' => 'success',
            'cancel' => 'danger',
            'deny' => 'danger',
            'expire' => 'secondary'
        ];

        return $badges[$this->transaction_status] ?? 'secondary';
    }
}
