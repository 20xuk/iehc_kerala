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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained()->onDelete('cascade');
            $table->string('receipt_number')->unique();
            $table->decimal('total_amount', 10, 2);
            $table->enum('donation_type', ['prayer_hall', 'magazine', 'general', 'subscription'])->default('prayer_hall');
            $table->enum('status', ['active', 'cancelled'])->default('active');
            $table->date('collection_date');
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('cancelled_by')->nullable()->constrained('users');
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();
            
            $table->index('receipt_number');
            $table->index(['donor_id', 'collection_date']);
            $table->index('donation_type');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
