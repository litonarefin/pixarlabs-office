<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('income_category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('payment_method_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 12, 2);
            $table->enum('currency', ['USD', 'BDT'])->default('BDT');
            $table->decimal('amount_in_bdt', 12, 2)->nullable(); // Auto-converted amount
            $table->enum('source', ['freemius', 'paddle', 'affiliate', 'manual', 'slack', 'whatsapp'])->default('manual');
            $table->text('description');
            $table->date('transaction_date');
            $table->string('invoice_number')->nullable();
            $table->string('receipt_path')->nullable(); // Path to Google Drive receipt
            $table->string('external_id')->nullable(); // For API integrations (Freemius/Paddle ID)
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
