<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Seeder;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'head_office_address',
                'value' => 'IEHC Kerala Head Office, Kerala, India',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Head Office Address',
                'description' => 'Complete address of the head office',
                'is_required' => true,
                'sort_order' => 1
            ],
            [
                'key' => 'organization_name',
                'value' => 'IEHC Kerala',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Organization Name',
                'description' => 'Name of the organization',
                'is_required' => true,
                'sort_order' => 2
            ],
            [
                'key' => 'timezone',
                'value' => 'Asia/Kolkata',
                'type' => 'select',
                'group' => 'general',
                'label' => 'Time Zone',
                'description' => 'Default timezone for the application',
                'options' => [
                    'Asia/Kolkata' => 'India (IST)',
                    'UTC' => 'UTC',
                    'America/New_York' => 'Eastern Time',
                    'Europe/London' => 'London',
                ],
                'is_required' => true,
                'sort_order' => 3
            ],

            // Bank Details
            [
                'key' => 'bank_name',
                'value' => '',
                'type' => 'text',
                'group' => 'bank',
                'label' => 'Bank Name',
                'description' => 'Name of the bank',
                'is_required' => false,
                'sort_order' => 1
            ],
            [
                'key' => 'account_number',
                'value' => '',
                'type' => 'text',
                'group' => 'bank',
                'label' => 'Account Number',
                'description' => 'Bank account number',
                'is_required' => false,
                'sort_order' => 2
            ],
            [
                'key' => 'ifsc_code',
                'value' => '',
                'type' => 'text',
                'group' => 'bank',
                'label' => 'IFSC Code',
                'description' => 'IFSC code of the bank branch',
                'is_required' => false,
                'sort_order' => 3
            ],
            [
                'key' => 'branch_name',
                'value' => '',
                'type' => 'text',
                'group' => 'bank',
                'label' => 'Branch Name',
                'description' => 'Name of the bank branch',
                'is_required' => false,
                'sort_order' => 4
            ],

            // WhatsApp Business API
            [
                'key' => 'whatsapp_api_key',
                'value' => '',
                'type' => 'text',
                'group' => 'whatsapp',
                'label' => 'WhatsApp API Key',
                'description' => 'WhatsApp Business API key',
                'is_required' => false,
                'sort_order' => 1
            ],
            [
                'key' => 'whatsapp_phone_number',
                'value' => '',
                'type' => 'text',
                'group' => 'whatsapp',
                'label' => 'WhatsApp Phone Number',
                'description' => 'WhatsApp Business phone number',
                'is_required' => false,
                'sort_order' => 2
            ],
            [
                'key' => 'whatsapp_enabled',
                'value' => '0',
                'type' => 'boolean',
                'group' => 'whatsapp',
                'label' => 'Enable WhatsApp Notifications',
                'description' => 'Enable or disable WhatsApp notifications',
                'is_required' => false,
                'sort_order' => 3
            ],

            // SMS Integration (Twilio)
            [
                'key' => 'twilio_account_sid',
                'value' => '',
                'type' => 'text',
                'group' => 'sms',
                'label' => 'Twilio Account SID',
                'description' => 'Twilio Account SID',
                'is_required' => false,
                'sort_order' => 1
            ],
            [
                'key' => 'twilio_auth_token',
                'value' => '',
                'type' => 'text',
                'group' => 'sms',
                'label' => 'Twilio Auth Token',
                'description' => 'Twilio Auth Token',
                'is_required' => false,
                'sort_order' => 2
            ],
            [
                'key' => 'twilio_phone_number',
                'value' => '',
                'type' => 'text',
                'group' => 'sms',
                'label' => 'Twilio Phone Number',
                'description' => 'Twilio phone number for sending SMS',
                'is_required' => false,
                'sort_order' => 3
            ],
            [
                'key' => 'sms_enabled',
                'value' => '0',
                'type' => 'boolean',
                'group' => 'sms',
                'label' => 'Enable SMS Notifications',
                'description' => 'Enable or disable SMS notifications',
                'is_required' => false,
                'sort_order' => 4
            ],

            // Email Configuration
            [
                'key' => 'mail_host',
                'value' => 'smtp.mailtrap.io',
                'type' => 'text',
                'group' => 'email',
                'label' => 'SMTP Host',
                'description' => 'SMTP server host',
                'is_required' => false,
                'sort_order' => 1
            ],
            [
                'key' => 'mail_port',
                'value' => '2525',
                'type' => 'text',
                'group' => 'email',
                'label' => 'SMTP Port',
                'description' => 'SMTP server port',
                'is_required' => false,
                'sort_order' => 2
            ],
            [
                'key' => 'mail_username',
                'value' => '',
                'type' => 'text',
                'group' => 'email',
                'label' => 'SMTP Username',
                'description' => 'SMTP username',
                'is_required' => false,
                'sort_order' => 3
            ],
            [
                'key' => 'mail_password',
                'value' => '',
                'type' => 'password',
                'group' => 'email',
                'label' => 'SMTP Password',
                'description' => 'SMTP password',
                'is_required' => false,
                'sort_order' => 4
            ],
            [
                'key' => 'mail_encryption',
                'value' => 'tls',
                'type' => 'select',
                'group' => 'email',
                'label' => 'SMTP Encryption',
                'description' => 'SMTP encryption type',
                'options' => [
                    'tls' => 'TLS',
                    'ssl' => 'SSL',
                    'none' => 'None'
                ],
                'is_required' => false,
                'sort_order' => 5
            ],
            [
                'key' => 'mail_from_address',
                'value' => 'noreply@iehc.com',
                'type' => 'text',
                'group' => 'email',
                'label' => 'From Email Address',
                'description' => 'Default from email address',
                'is_required' => false,
                'sort_order' => 6
            ],
            [
                'key' => 'mail_from_name',
                'value' => 'IEHC Kerala',
                'type' => 'text',
                'group' => 'email',
                'label' => 'From Name',
                'description' => 'Default from name',
                'is_required' => false,
                'sort_order' => 7
            ],

            // Theme & Appearance
            [
                'key' => 'theme_color',
                'value' => '#3b82f6',
                'type' => 'color',
                'group' => 'appearance',
                'label' => 'Primary Color',
                'description' => 'Primary color for the application',
                'is_required' => false,
                'sort_order' => 1
            ],
            [
                'key' => 'logo_url',
                'value' => '',
                'type' => 'file',
                'group' => 'appearance',
                'label' => 'Organization Logo',
                'description' => 'Upload organization logo',
                'is_required' => false,
                'sort_order' => 2
            ],
            [
                'key' => 'favicon_url',
                'value' => '',
                'type' => 'file',
                'group' => 'appearance',
                'label' => 'Favicon',
                'description' => 'Upload favicon icon',
                'is_required' => false,
                'sort_order' => 3
            ],

            // Security Settings
            [
                'key' => 'session_lifetime',
                'value' => '120',
                'type' => 'number',
                'group' => 'security',
                'label' => 'Session Lifetime (minutes)',
                'description' => 'Session timeout in minutes',
                'is_required' => false,
                'sort_order' => 1
            ],
            [
                'key' => 'password_min_length',
                'value' => '8',
                'type' => 'number',
                'group' => 'security',
                'label' => 'Minimum Password Length',
                'description' => 'Minimum required password length',
                'is_required' => false,
                'sort_order' => 2
            ],
            [
                'key' => 'require_password_change',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'security',
                'label' => 'Require Password Change on First Login',
                'description' => 'Force users to change password on first login',
                'is_required' => false,
                'sort_order' => 3
            ],
            [
                'key' => 'enable_audit_log',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'security',
                'label' => 'Enable Audit Logging',
                'description' => 'Enable audit logging for all CRUD operations',
                'is_required' => false,
                'sort_order' => 4
            ],

            // Notifications
            [
                'key' => 'email_notifications',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'notifications',
                'label' => 'Enable Email Notifications',
                'description' => 'Enable email notifications',
                'is_required' => false,
                'sort_order' => 1
            ],
            [
                'key' => 'donor_registration_notification',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'notifications',
                'label' => 'Donor Registration Notifications',
                'description' => 'Send notifications for new donor registrations',
                'is_required' => false,
                'sort_order' => 2
            ],
            [
                'key' => 'collection_notification',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'notifications',
                'label' => 'Collection Notifications',
                'description' => 'Send notifications for new collections',
                'is_required' => false,
                'sort_order' => 3
            ],

            // Backup & Restore
            [
                'key' => 'auto_backup_enabled',
                'value' => '0',
                'type' => 'boolean',
                'group' => 'backup',
                'label' => 'Enable Auto Backup',
                'description' => 'Enable automatic database backup',
                'is_required' => false,
                'sort_order' => 1
            ],
            [
                'key' => 'backup_frequency',
                'value' => 'daily',
                'type' => 'select',
                'group' => 'backup',
                'label' => 'Backup Frequency',
                'description' => 'How often to perform automatic backups',
                'options' => [
                    'daily' => 'Daily',
                    'weekly' => 'Weekly',
                    'monthly' => 'Monthly'
                ],
                'is_required' => false,
                'sort_order' => 2
            ],
            [
                'key' => 'backup_retention_days',
                'value' => '30',
                'type' => 'number',
                'group' => 'backup',
                'label' => 'Backup Retention (days)',
                'description' => 'Number of days to keep backup files',
                'is_required' => false,
                'sort_order' => 3
            ],
        ];

        foreach ($settings as $setting) {
            SystemSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
