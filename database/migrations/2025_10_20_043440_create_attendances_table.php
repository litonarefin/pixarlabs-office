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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->time('check_in_time')->nullable();
            $table->time('check_out_time')->nullable();
            $table->decimal('working_hours', 5, 2)->nullable();
            $table->enum('status', ['present', 'absent', 'half_day', 'late', 'leave'])->default('present');
            $table->enum('source', ['manual', 'slack', 'biometric'])->default('manual');
            $table->string('slack_message_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // Unique constraint: one attendance per employee per day
            $table->unique(['employee_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
