<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'expense_category_id',
        'payment_method_id',
        'amount',
        'currency',
        'amount_in_bdt',
        'expense_type',
        'source',
        'description',
        'transaction_date',
        'invoice_number',
        'receipt_path',
        'employee_id',
        'created_by',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2',
        'amount_in_bdt' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($expense) {
            // Auto-convert to BDT if currency is USD
            if ($expense->currency === 'USD') {
                $exchangeRate = 110; // You can make this dynamic later
                $expense->amount_in_bdt = $expense->amount * $exchangeRate;
            } else {
                $expense->amount_in_bdt = $expense->amount;
            }
        });
    }
}
