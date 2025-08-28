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
        Schema::table('collections', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['donor_id']);
            
            // Add the correct foreign key constraint to users table
            $table->foreign('donor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('collections', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['donor_id']);
            
            // Restore the original constraint (if needed)
            $table->foreign('donor_id')->references('id')->on('donors')->onDelete('cascade');
        });
    }
};
