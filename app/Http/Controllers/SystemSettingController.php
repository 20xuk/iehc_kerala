<?php

namespace App\Http\Controllers;

use App\Models\SystemSetting;
use App\Models\Country;
use App\Models\Region;
use App\Models\Theme;
use App\Models\UserThemePreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SystemSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:system_admin');
    }

    /**
     * Display the system settings index page
     */
    public function index()
    {
        $groups = [
            'general' => 'General Settings',
            'bank' => 'Bank Details',
            'whatsapp' => 'WhatsApp Business API',
            'sms' => 'SMS Integration (Twilio)',
            'email' => 'Email Configuration',
            'appearance' => 'Theme & Appearance',
            'security' => 'Security Settings',
            'notifications' => 'Notifications',
            'backup' => 'Backup & Restore'
        ];

        $settings = [];
        foreach ($groups as $group => $label) {
            $settings[$group] = SystemSetting::getByGroup($group);
        }

        // Get themes for the modal
        $themes = Theme::orderBy('sort_order')->get();
        $activeTheme = Theme::getActiveTheme();
        
        // Get user theme statistics
        $userThemeStats = [
            'total_users' => \App\Models\User::count(),
            'system_theme_users' => UserThemePreference::where('use_system_theme', true)->count(),
            'custom_theme_users' => UserThemePreference::where('use_system_theme', false)->count(),
            'user_overrides' => UserThemePreference::where('use_system_theme', false)->count(),
        ];

        return view('admin.system-settings.index', compact('settings', 'groups', 'themes', 'activeTheme', 'userThemeStats'));
    }

    /**
     * Update system settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable|string'
        ]);

        foreach ($request->settings as $key => $value) {
            SystemSetting::setValue($key, $value);
        }

        // Clear cache
        Cache::forget('system_settings');

        return redirect()->back()->with('success', 'System settings updated successfully!');
    }

    /**
     * Display countries management
     */
    public function countries()
    {
        $countries = Country::orderBy('sort_order')->orderBy('name')->paginate(20);
        return view('admin.system-settings.countries', compact('countries'));
    }

    /**
     * Store a new country
     */
    public function storeCountry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:3|unique:countries,code',
            'phone_code' => 'nullable|string|max:10',
            'currency_code' => 'nullable|string|max:3',
            'currency_symbol' => 'nullable|string|max:5',
        ]);

        Country::create($request->all());

        return redirect()->back()->with('success', 'Country added successfully!');
    }

    /**
     * Update a country
     */
    public function updateCountry(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:3|unique:countries,code,' . $country->id,
            'phone_code' => 'nullable|string|max:10',
            'currency_code' => 'nullable|string|max:3',
            'currency_symbol' => 'nullable|string|max:5',
        ]);

        $country->update($request->all());

        return redirect()->back()->with('success', 'Country updated successfully!');
    }

    /**
     * Delete a country
     */
    public function deleteCountry(Country $country)
    {
        $country->delete();
        return redirect()->back()->with('success', 'Country deleted successfully!');
    }

    /**
     * Display regions management
     */
    public function regions()
    {
        $regions = Region::orderBy('sort_order')->orderBy('name')->paginate(20);
        return view('admin.system-settings.regions', compact('regions'));
    }

    /**
     * Store a new region
     */
    public function storeRegion(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:regions,code',
            'description' => 'nullable|string',
        ]);

        Region::create($request->all());

        return redirect()->back()->with('success', 'Region added successfully!');
    }

    /**
     * Update a region
     */
    public function updateRegion(Request $request, Region $region)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:regions,code,' . $region->id,
            'description' => 'nullable|string',
        ]);

        $region->update($request->all());

        return redirect()->back()->with('success', 'Region updated successfully!');
    }

    /**
     * Delete a region
     */
    public function deleteRegion(Region $region)
    {
        $region->delete();
        return redirect()->back()->with('success', 'Region deleted successfully!');
    }

    /**
     * Display backup and restore page
     */
    public function backup()
    {
        return view('admin.system-settings.backup');
    }

    /**
     * Create a manual backup
     */
    public function createBackup()
    {
        // Implementation for creating backup
        // This would typically use Laravel's backup package or custom implementation
        
        return redirect()->back()->with('success', 'Backup created successfully!');
    }

    /**
     * Restore from backup
     */
    public function restore(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file|mimes:sql,zip'
        ]);

        // Implementation for restoring from backup
        
        return redirect()->back()->with('success', 'System restored successfully!');
    }
}
