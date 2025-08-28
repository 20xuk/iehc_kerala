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
        Schema::table('users', function (Blueprint $table) {
            // Add marital status
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable()->after('gender');
            
            // Add country and region IDs
            $table->unsignedBigInteger('country_id')->nullable()->after('country');
            $table->unsignedBigInteger('region_id')->nullable()->after('country_id');
            
            // Add amount promised
            $table->decimal('amount_promised', 15, 2)->nullable()->after('notes');
            
            // Add foreign key constraints
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropForeign(['region_id']);
            $table->dropColumn(['marital_status', 'country_id', 'region_id', 'amount_promised']);
        });
    }
};
