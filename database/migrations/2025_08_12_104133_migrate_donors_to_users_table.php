<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if donors table exists
        if (Schema::hasTable('donors')) {
            // Get all donors from the donors table
            $donors = DB::table('donors')->get();
            
            foreach ($donors as $donor) {
                // Split name into first and last name
                $nameParts = explode(' ', trim($donor->name), 2);
                $firstName = $nameParts[0] ?? '';
                $lastName = $nameParts[1] ?? '';
                
                // Check if user already exists with this email
                $existingUser = null;
                if ($donor->email) {
                    $existingUser = DB::table('users')->where('email', $donor->email)->first();
                }
                
                if (!$existingUser) {
                    // Create new user from donor data
                    DB::table('users')->insert([
                        'name' => $donor->name,
                        'first_name' => $firstName,
                        'last_name' => $lastName,
                        'email' => $donor->email,
                        'phone' => $donor->mobile_main,
                        'phone_alt1' => $donor->mobile_alt1,
                        'phone_alt2' => $donor->mobile_alt2,
                        'date_of_birth' => $donor->birth_date,
                        'wedding_date' => $donor->wedding_date,
                        'address_line_1' => $donor->address,
                        'city' => $donor->city,
                        'state' => $donor->state,
                        'country' => $donor->country,
                        'postal_code' => $donor->pincode,
                        'donor_type' => $donor->donor_type === 'anonymous' ? 'anonymous' : 'individual',
                        'notes' => $donor->notes,
                        'status' => $donor->status,
                        'is_anonymous' => $donor->donor_type === 'anonymous',
                        'role' => 'donor',
                        'password' => bcrypt('password123'), // Default password, should be changed
                        'created_at' => $donor->created_at,
                        'updated_at' => $donor->updated_at,
                    ]);
                }
            }
            
            // Create a backup of the donors table before dropping
            Schema::rename('donors', 'donors_backup_' . date('Y_m_d_His'));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore the donors table from backup
        $backupTables = DB::select("SHOW TABLES LIKE 'donors_backup_%'");
        
        if (!empty($backupTables)) {
            $latestBackup = collect($backupTables)->sortByDesc('Tables_in_' . env('DB_DATABASE') . ' (donors_backup_%)')->first();
            $backupTableName = $latestBackup->{'Tables_in_' . env('DB_DATABASE') . ' (donors_backup_%)'};
            
            Schema::rename($backupTableName, 'donors');
        }
        
        // Remove users that were created from donors
        DB::table('users')->where('role', 'donor')->delete();
    }
};
