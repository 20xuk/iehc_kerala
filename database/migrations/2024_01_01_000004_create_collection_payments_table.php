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
        Schema::create('collection_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->constrained()->onDelete('cascade');
            $table->enum('payment_mode', ['cash', 'cheque', 'online', 'card', 'upi'])->default('cash');
            $table->decimal('amount', 10, 2);
            $table->string('transaction_id')->nullable();
            $table->string('cheque_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->date('cheque_date')->nullable();
            $table->text('payment_notes')->nullable();
            $table->timestamps();
            
            $table->index(['collection_id', 'payment_mode']);
            $table->index('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_payments');
    }
};
