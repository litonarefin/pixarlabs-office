<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'income_category_id',
        'payment_method_id',
        'amount',
        'currency',
        'amount_in_bdt',
        'source',
        'description',
        'transaction_date',
        'invoice_number',
        'receipt_path',
        'external_id',
        'created_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'amount_in_bdt' => 'decimal:2',
        'transaction_date' => 'date',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(IncomeCategory::class, 'income_category_id');
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Auto-convert amount to BDT
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($income) {
            if ($income->currency === 'USD') {
                // You can fetch current rate from an API or use a fixed rate
                $usdToBdtRate = 110; // Update this as needed
                $income->amount_in_bdt = $income->amount * $usdToBdtRate;
            } else {
                $income->amount_in_bdt = $income->amount;
            }
        });
    }
}
