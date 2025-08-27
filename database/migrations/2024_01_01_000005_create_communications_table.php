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
        Schema::create('communications', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['letter', 'receipt', 'newsletter']);
            $table->string('subject');
            $table->text('content');
            $table->enum('status', ['draft', 'sent', 'failed'])->default('draft');
            $table->enum('delivery_method', ['email', 'whatsapp', 'print', 'post'])->default('email');
            $table->json('recipients')->nullable(); // Array of donor IDs or 'all'
            $table->foreignId('created_by')->constrained('users');
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
            
            $table->index(['type', 'status']);
            $table->index('delivery_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communications');
    }
};
