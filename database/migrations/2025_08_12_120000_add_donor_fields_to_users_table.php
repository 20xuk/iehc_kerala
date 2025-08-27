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
            $table->string('pan_number', 10)->nullable()->after('email');
            $table->string('promotional_secretary')->nullable()->after('pan_number');
            $table->enum('donation_frequency', [
                'weekly',
                'bi_monthly',
                'monthly',
                'quarterly',
                'half_yearly',
                'yearly',
                'one_time',
                'on_demand',
                'special_occasion',
                'festival',
                'anniversary',
                'birthday',
                'other'
            ])->nullable()->after('donor_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['pan_number', 'promotional_secretary', 'donation_frequency']);
        });
    }
};

