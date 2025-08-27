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
        // First, update the existing users table to include all necessary fields
        Schema::table('users', function (Blueprint $table) {
            // Personal Information
            $table->string('first_name')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('phone')->nullable()->after('email');
            $table->string('phone_alt1')->nullable()->after('phone');
            $table->string('phone_alt2')->nullable()->after('phone_alt1');
            $table->date('date_of_birth')->nullable()->after('phone_alt2');
            $table->date('wedding_date')->nullable()->after('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('wedding_date');
            
            // Address Information
            $table->string('address_line_1')->nullable()->after('gender');
            $table->string('address_line_2')->nullable()->after('address_line_1');
            $table->string('city')->nullable()->after('address_line_2');
            $table->string('state')->nullable()->after('city');
            $table->string('postal_code')->nullable()->after('state');
            $table->string('country')->default('India')->after('postal_code');
            
            // Additional Information
            $table->string('occupation')->nullable()->after('country');
            $table->string('company')->nullable()->after('occupation');
            $table->enum('donor_type', ['individual', 'corporate', 'foundation', 'church', 'anonymous'])->nullable()->after('company');
            $table->enum('source', ['website', 'referral', 'event', 'social_media', 'direct_contact', 'other'])->nullable()->after('donor_type');
            $table->text('notes')->nullable()->after('source');
            
            // Status and Settings
            $table->enum('status', ['active', 'inactive', 'blocked', 'deceased'])->default('active')->after('notes');
            $table->boolean('email_verified')->default(false)->after('status');
            $table->boolean('phone_verified')->default(false)->after('email_verified');
            $table->boolean('is_anonymous')->default(false)->after('phone_verified');
            
            // Beneficiary specific fields
            $table->string('beneficiary_id')->nullable()->after('is_anonymous');
            $table->enum('beneficiary_type', ['individual', 'family', 'community'])->nullable()->after('beneficiary_id');
            $table->text('beneficiary_notes')->nullable()->after('beneficiary_type');
            
            // Admin specific fields
            $table->string('employee_id')->nullable()->after('beneficiary_notes');
            $table->string('department')->nullable()->after('employee_id');
            $table->json('permissions')->nullable()->after('department');
            $table->timestamp('last_login_at')->nullable()->after('permissions');
            
            // Indexes for better performance
            $table->index(['first_name', 'last_name']);
            $table->index('phone');
            $table->index('city');
            $table->index('state');
            $table->index('country');
            $table->index('role');
            $table->index('status');
            $table->index('donor_type');
            $table->index('beneficiary_type');
        });

        // Update the role enum to include beneficiary
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', [
                'donor',
                'beneficiary',
                'secretary', 
                'admin',
                'system_admin',
                'office_staff',
                'accountant'
            ])->default('donor')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop indexes
            $table->dropIndex(['first_name', 'last_name']);
            $table->dropIndex(['phone']);
            $table->dropIndex(['city']);
            $table->dropIndex(['state']);
            $table->dropIndex(['country']);
            $table->dropIndex(['role']);
            $table->dropIndex(['status']);
            $table->dropIndex(['donor_type']);
            $table->dropIndex(['beneficiary_type']);
            
            // Drop columns
            $table->dropColumn([
                'first_name',
                'last_name',
                'phone',
                'phone_alt1',
                'phone_alt2',
                'date_of_birth',
                'wedding_date',
                'gender',
                'address_line_1',
                'address_line_2',
                'city',
                'state',
                'postal_code',
                'country',
                'occupation',
                'company',
                'donor_type',
                'source',
                'notes',
                'status',
                'email_verified',
                'phone_verified',
                'is_anonymous',
                'beneficiary_id',
                'beneficiary_type',
                'beneficiary_notes',
                'employee_id',
                'department',
                'permissions',
                'last_login_at'
            ]);
        });

        // Revert role enum
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', [
                'donor',
                'secretary', 
                'admin',
                'system_admin',
                'office_staff',
                'accountant'
            ])->default('donor')->change();
        });
    }
};
