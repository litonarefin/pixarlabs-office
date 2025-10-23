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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_method_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 12, 2);
            $table->enum('currency', ['USD', 'BDT'])->default('BDT');
            $table->decimal('amount_in_bdt', 12, 2)->nullable(); // Auto-converted amount
            $table->enum('loan_type', ['personal', 'office', 'employee'])->default('office');
            $table->enum('status', ['pending', 'approved', 'disbursed', 'repaid', 'defaulted'])->default('pending');
            $table->decimal('interest_rate', 5, 2)->default(0); // Percentage
            $table->text('description')->nullable();
            $table->date('loan_date');
            $table->date('due_date')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('document_path')->nullable(); // Path to Google Drive document
            $table->foreignId('employee_id')->nullable()->constrained()->nullOnDelete(); // For employee loans
            $table->foreignId('lender_id')->nullable()->constrained('users')->nullOnDelete(); // Who gave the loan
            $table->foreignId('borrower_id')->nullable()->constrained('users')->nullOnDelete(); // Who received the loan
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
        Schema::dropIfExists('loans');
    }
};
