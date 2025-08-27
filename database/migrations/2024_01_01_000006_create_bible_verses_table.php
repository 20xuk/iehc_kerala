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
        Schema::create('bible_verses', function (Blueprint $table) {
            $table->id();
            $table->string('reference'); // e.g., "John 3:16"
            $table->text('verse_text_en'); // English text
            $table->text('verse_text_ta')->nullable(); // Tamil text
            $table->enum('language', ['en', 'ta', 'both'])->default('en');
            $table->date('display_date')->nullable(); // For scheduled display
            $table->enum('display_frequency', ['daily', 'weekly', 'monthly'])->default('daily');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('display_date');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bible_verses');
    }
};
