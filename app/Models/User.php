<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'profile_picture',
        'first_name',
        'last_name',
        'email',
        'pan_number',
        'promotional_secretary',
        'password',
        'phone',
        'phone_alt1',
        'phone_alt2',
        'date_of_birth',
        'wedding_date',
        'gender',
        'marital_status',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'region',
        'postal_code',
        'country',
        'country_id',
        'region_id',
        'occupation',
        'company',
        'donor_type',
        'donation_frequency',
        'source',
        'notes',
        'amount_promised',
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
        'last_login_at',
        'role',
        'password_change_required',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'password_change_required' => 'boolean',
            'date_of_birth' => 'date',
            'wedding_date' => 'date',
            'last_login_at' => 'datetime',
            'email_verified' => 'boolean',
            'phone_verified' => 'boolean',
            'is_anonymous' => 'boolean',
            'permissions' => 'array',
        ];
    }

    // Role constants
    const ROLE_DONOR = 'donor';
    const ROLE_BENEFICIARY = 'beneficiary';
    const ROLE_SECRETARY = 'secretary';
    const ROLE_ADMIN = 'admin';
    const ROLE_SYSTEM_ADMIN = 'system_admin';
    const ROLE_OFFICE_STAFF = 'office_staff';
    const ROLE_ACCOUNTANT = 'accountant';

    // Role methods
    public function isDonor(): bool
    {
        return $this->role === self::ROLE_DONOR;
    }

    public function isBeneficiary(): bool
    {
        return $this->role === self::ROLE_BENEFICIARY;
    }

    public function isSecretary(): bool
    {
        return $this->role === self::ROLE_SECRETARY;
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_SYSTEM_ADMIN, self::ROLE_OFFICE_STAFF, self::ROLE_ACCOUNTANT]);
    }

    public function isSystemAdmin(): bool
    {
        return $this->role === self::ROLE_SYSTEM_ADMIN;
    }

    public function isOfficeStaff(): bool
    {
        return $this->role === self::ROLE_OFFICE_STAFF;
    }

    public function isAccountant(): bool
    {
        return $this->role === self::ROLE_ACCOUNTANT;
    }

    public function getRoleDisplayName(): string
    {
        return match($this->role) {
            self::ROLE_DONOR => 'Donor',
            self::ROLE_BENEFICIARY => 'Beneficiary',
            self::ROLE_SECRETARY => 'Promotional Secretary',
            self::ROLE_ADMIN => 'Administrator',
            self::ROLE_SYSTEM_ADMIN => 'System Administrator',
            self::ROLE_OFFICE_STAFF => 'Office Staff',
            self::ROLE_ACCOUNTANT => 'Accountant',
            default => 'User'
        };
    }

    public function needsPasswordChange(): bool
    {
        return $this->password_change_required;
    }

    public function markPasswordChanged(): void
    {
        $this->update(['password_change_required' => false]);
    }

    /**
     * Get the dashboard route for the user based on their role
     */
    public function getDashboardRoute(): string
    {
        return match($this->role) {
            self::ROLE_DONOR => 'donor.dashboard',
            self::ROLE_BENEFICIARY => 'beneficiary.dashboard',
            self::ROLE_SECRETARY => 'secretary.dashboard',
            self::ROLE_SYSTEM_ADMIN => 'admin.dashboard',
            self::ROLE_OFFICE_STAFF => 'staff.dashboard',
            self::ROLE_ACCOUNTANT => 'accountant.dashboard',
            default => 'dashboard'
        };
    }

    /**
     * Check if user can access a specific menu item
     */
    public function canAccessMenu(string $menuItem): bool
    {
        return match($menuItem) {
            'donors' => in_array($this->role, [self::ROLE_SYSTEM_ADMIN, self::ROLE_OFFICE_STAFF, self::ROLE_ACCOUNTANT]),
            'collections' => in_array($this->role, [self::ROLE_SYSTEM_ADMIN, self::ROLE_OFFICE_STAFF, self::ROLE_ACCOUNTANT, self::ROLE_SECRETARY]),
            'magazines' => in_array($this->role, [self::ROLE_SYSTEM_ADMIN, self::ROLE_OFFICE_STAFF, self::ROLE_ACCOUNTANT]),
            'reports' => in_array($this->role, [self::ROLE_SYSTEM_ADMIN, self::ROLE_OFFICE_STAFF, self::ROLE_ACCOUNTANT, self::ROLE_SECRETARY]),
            'communications' => in_array($this->role, [self::ROLE_SYSTEM_ADMIN, self::ROLE_OFFICE_STAFF, self::ROLE_ACCOUNTANT]),
            'bible_verses' => in_array($this->role, [self::ROLE_SYSTEM_ADMIN, self::ROLE_OFFICE_STAFF, self::ROLE_ACCOUNTANT]),
            default => false
        };
    }

    /**
     * Get the dashboard title for the user based on their role
     */
    public function getDashboardTitle(): string
    {
        return match($this->role) {
            self::ROLE_DONOR => 'Donor Dashboard',
            self::ROLE_BENEFICIARY => 'Beneficiary Dashboard',
            self::ROLE_SECRETARY => 'Secretary Dashboard',
            self::ROLE_SYSTEM_ADMIN => 'Admin Dashboard',
            self::ROLE_OFFICE_STAFF => 'Staff Dashboard',
            self::ROLE_ACCOUNTANT => 'Accountant Dashboard',
            default => 'Dashboard'
        };
    }

    /**
     * Get the dashboard description for the user based on their role
     */
    public function getDashboardDescription(): string
    {
        return match($this->role) {
            self::ROLE_DONOR => 'View your donation history and manage your profile',
            self::ROLE_BENEFICIARY => 'View your beneficiary information and assistance history',
            self::ROLE_SECRETARY => 'Manage collections and generate reports',
            self::ROLE_SYSTEM_ADMIN => 'Full system administration and management',
            self::ROLE_OFFICE_STAFF => 'Manage donors, collections, and day-to-day operations',
            self::ROLE_ACCOUNTANT => 'Financial management and accounting reports',
            default => 'Welcome to IEHCKerala'
        };
    }

    /**
     * Get the full name of the user
     */
    public function getFullNameAttribute(): string
    {
        if ($this->first_name && $this->last_name) {
            return $this->first_name . ' ' . $this->last_name;
        }
        return $this->name;
    }

    /**
     * Get the display name (full name or anonymous)
     */
    public function getDisplayNameAttribute(): string
    {
        if ($this->is_anonymous) {
            return 'Anonymous Donor';
        }
        return $this->full_name;
    }

    /**
     * Get the complete address
     */
    public function getFullAddressAttribute(): string
    {
        $address = [];
        
        if ($this->address_line_1) {
            $address[] = $this->address_line_1;
        }
        if ($this->address_line_2) {
            $address[] = $this->address_line_2;
        }
        if ($this->city) {
            $address[] = $this->city;
        }
        if ($this->state) {
            $address[] = $this->state;
        }
        if ($this->postal_code) {
            $address[] = $this->postal_code;
        }
        if ($this->country) {
            $address[] = $this->country;
        }
        
        return implode(', ', $address);
    }

    /**
     * Scope to get only donors
     */
    public function scopeDonors($query)
    {
        return $query->where('role', self::ROLE_DONOR);
    }

    /**
     * Scope to get only beneficiaries
     */
    public function scopeBeneficiaries($query)
    {
        return $query->where('role', self::ROLE_BENEFICIARY);
    }

    /**
     * Scope to get only admin users
     */
    public function scopeAdmins($query)
    {
        return $query->whereIn('role', [
            self::ROLE_ADMIN,
            self::ROLE_SYSTEM_ADMIN,
            self::ROLE_OFFICE_STAFF,
            self::ROLE_ACCOUNTANT,
            self::ROLE_SECRETARY
        ]);
    }

    /**
     * Scope to get active users
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Check if user has a specific permission
     */
    public function hasPermission(string $permission): bool
    {
        if (!$this->permissions) {
            return false;
        }
        
        return in_array($permission, $this->permissions);
    }

    /**
     * Update last login timestamp
     */
    public function updateLastLogin(): void
    {
        $this->update(['last_login_at' => now()]);
    }

    // Relationships
    /**
     * Get the collections for this user (donor)
     */
    public function collections()
    {
        return $this->hasMany(\App\Models\Collection::class, 'donor_id');
    }

    /**
     * Get the magazine subscriptions for this user (donor)
     */
    public function magazineSubscriptions()
    {
        return $this->hasMany(\App\Models\MagazineSubscription::class, 'donor_id');
    }

    /**
     * Get the theme preference for this user
     */
    public function themePreference()
    {
        return $this->hasOne(\App\Models\UserThemePreference::class);
    }

    /**
     * Get the last donation for this user (donor)
     */
    public function getLastDonationAttribute()
    {
        return $this->collections()
            ->where('status', 'active')
            ->orderBy('collection_date', 'desc')
            ->first();
    }

    /**
     * Get the total donations for this user (donor)
     */
    public function getTotalDonationsAttribute()
    {
        return $this->collections()
            ->where('status', 'active')
            ->sum('total_amount');
    }

    /**
     * Get the total number of donations for this user (donor)
     */
    public function getDonationCountAttribute()
    {
        return $this->collections()
            ->where('status', 'active')
            ->count();
    }

    /**
     * Get the average donation amount for this user (donor)
     */
    public function getAverageDonationAttribute()
    {
        $count = $this->donation_count;
        if ($count === 0) {
            return 0;
        }
        return $this->total_donations / $count;
    }

    /**
     * Get the first donation date for this user (donor)
     */
    public function getFirstDonationDateAttribute()
    {
        return $this->collections()
            ->where('status', 'active')
            ->orderBy('collection_date', 'asc')
            ->value('collection_date');
    }

    /**
     * Get the last donation date for this user (donor)
     */
    public function getLastDonationDateAttribute()
    {
        return $this->collections()
            ->where('status', 'active')
            ->orderBy('collection_date', 'desc')
            ->value('collection_date');
    }

    /**
     * Check if user has any active collections
     */
    public function hasActiveCollections(): bool
    {
        return $this->collections()->where('status', 'active')->exists();
    }

    /**
     * Get active collections count
     */
    public function getActiveCollectionsCountAttribute(): int
    {
        return $this->collections()->where('status', 'active')->count();
    }

    /**
     * Get pending collections count
     */
    public function getPendingCollectionsCountAttribute(): int
    {
        return $this->collections()->where('status', 'pending')->count();
    }

    /**
     * Get completed collections count
     */
    public function getCompletedCollectionsCountAttribute(): int
    {
        return $this->collections()->where('status', 'completed')->count();
    }

    /**
     * Get the country that owns this user
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the region that owns this user
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get encrypted donor ID (8 digits)
     */
    public function getEncryptedDonorIdAttribute()
    {
        // Create a simple hash based on user ID and some salt
        $hash = hash('crc32', $this->id . 'IEHC_DONOR_SALT_2024');
        // Take first 8 characters and ensure it's numeric
        $numericHash = preg_replace('/[^0-9]/', '', $hash);
        // Pad with zeros if less than 8 digits
        return str_pad(substr($numericHash, 0, 8), 8, '0', STR_PAD_LEFT);
    }
}
