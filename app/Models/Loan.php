<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'payment_method_id',
        'amount',
        'currency',
        'amount_in_bdt',
        'loan_type',
        'status',
        'interest_rate',
        'description',
        'loan_date',
        'due_date',
        'reference_number',
        'document_path',
        'employee_id',
        'lender_id',
        'borrower_id',
        'created_by',
    ];

    protected $casts = [
        'loan_date' => 'date',
        'due_date' => 'date',
        'amount' => 'decimal:2',
        'amount_in_bdt' => 'decimal:2',
        'interest_rate' => 'decimal:2',
    ];

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function lender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lender_id');
    }

    public function borrower(): BelongsTo
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($loan) {
            // Auto-convert to BDT if currency is USD
            if ($loan->currency === 'USD') {
                $exchangeRate = 110; // You can make this dynamic later
                $loan->amount_in_bdt = $loan->amount * $exchangeRate;
            } else {
                $loan->amount_in_bdt = $loan->amount;
            }
        });
    }
}
