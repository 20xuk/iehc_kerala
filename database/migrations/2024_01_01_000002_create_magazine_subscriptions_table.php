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
        Schema::create('magazine_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained()->onDelete('cascade');
            $table->string('magazine_name');
            $table->enum('subscription_type', ['subscription', 'non_subscription'])->default('subscription');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['active', 'inactive', 'expired'])->default('active');
            $table->text('delivery_address')->nullable(); // Override donor address if needed
            $table->timestamps();
            
            $table->index(['donor_id', 'status']);
            $table->index('magazine_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magazine_subscriptions');
    }
};
