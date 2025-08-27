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
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('pincode');
            $table->string('city');
            $table->string('state');
            $table->string('country')->default('India');
            $table->string('mobile_main')->nullable();
            $table->string('mobile_alt1')->nullable();
            $table->string('mobile_alt2')->nullable();
            $table->string('email')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('wedding_date')->nullable();
            $table->enum('donor_type', ['anonymous', 'named'])->default('named');
            $table->enum('status', ['active', 'blocked', 'deceased'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['name', 'address']); // For duplication check
            $table->index('pincode'); // For sorting
            $table->index('donor_type');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};
