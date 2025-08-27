<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\MagazineController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BibleVerseController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\AccountantDashboardController;
use App\Http\Controllers\SecretaryDashboardController;
use App\Http\Controllers\DonorDashboardController;
use App\Http\Controllers\SystemSettingController;
use App\Http\Controllers\ThemeController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Password Change Routes
Route::middleware('auth')->group(function () {
    Route::get('/password/change', [AuthController::class, 'showPasswordChange'])->name('password.change');
    Route::post('/password/change', [AuthController::class, 'changePassword']);
    Route::get('/password/change/success', [AuthController::class, 'passwordChangeSuccess'])->name('password.change.success');
});

// Welcome page
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route(Auth::user()->getDashboardRoute());
    }
    return redirect()->route('login');
});

// Protected Routes
Route::middleware('auth')->group(function () {
    // Admin Dashboard (System Administrator)
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Staff Dashboard (Office Staff)
    Route::get('/staff/dashboard', [StaffDashboardController::class, 'index'])->name('staff.dashboard');
    
    // Accountant Dashboard
    Route::get('/accountant/dashboard', [AccountantDashboardController::class, 'index'])->name('accountant.dashboard');
    
    // Secretary Dashboard
    Route::get('/secretary/dashboard', [SecretaryDashboardController::class, 'index'])->name('secretary.dashboard');
    
    // Donor Dashboard
    Route::get('/donor/dashboard', [DonorDashboardController::class, 'index'])->name('donor.dashboard');
    
    // General Dashboard (fallback) - redirect to role-specific dashboard
    Route::get('/dashboard', function () {
        $user = Auth::user();
        return redirect()->route($user->getDashboardRoute());
    })->name('dashboard');
    
    // Livewire Dashboard (alternative)
    Route::get('/dashboard/livewire', function () {
        return view('dashboard-livewire');
    })->name('dashboard.livewire');
    
    // Livewire Counter Example
    Route::get('/livewire/counter', function () {
        return view('livewire-example');
    })->name('livewire.counter');

    // System Administration (System Admin only)
    Route::middleware('role:system_admin')->group(function () {
        // Admin User Management
        Route::resource('admin/users', AdminUserController::class)->names('admin.users');
        Route::post('admin/users/{user}/reset-password', [AdminUserController::class, 'resetPassword'])->name('admin.users.reset-password');
        Route::post('admin/users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('admin.users.toggle-status');

        // System Settings
        Route::get('system-settings', [SystemSettingController::class, 'index'])->name('system-settings.index');
        Route::post('system-settings', [SystemSettingController::class, 'update'])->name('system-settings.update');
        Route::get('system-settings/countries', [SystemSettingController::class, 'countries'])->name('system-settings.countries');
        Route::post('system-settings/countries', [SystemSettingController::class, 'storeCountry'])->name('system-settings.countries.store');
        Route::put('system-settings/countries/{country}', [SystemSettingController::class, 'updateCountry'])->name('system-settings.countries.update');
        Route::delete('system-settings/countries/{country}', [SystemSettingController::class, 'deleteCountry'])->name('system-settings.countries.destroy');
        Route::get('system-settings/regions', [SystemSettingController::class, 'regions'])->name('system-settings.regions');
        Route::post('system-settings/regions', [SystemSettingController::class, 'storeRegion'])->name('system-settings.regions.store');
        Route::put('system-settings/regions/{region}', [SystemSettingController::class, 'updateRegion'])->name('system-settings.regions.update');
        Route::delete('system-settings/regions/{region}', [SystemSettingController::class, 'deleteRegion'])->name('system-settings.regions.destroy');
        Route::get('system-settings/backup', [SystemSettingController::class, 'backup'])->name('system-settings.backup');
        Route::post('system-settings/backup', [SystemSettingController::class, 'createBackup'])->name('system-settings.backup.create');
        Route::post('system-settings/restore', [SystemSettingController::class, 'restore'])->name('system-settings.restore');

        // Theme Management
        Route::prefix('admin/themes')->group(function () {
            Route::get('/', [ThemeController::class, 'index'])->name('admin.themes.index');
            Route::get('/modal', [ThemeController::class, 'showModal'])->name('admin.themes.modal');
            Route::post('/apply', [ThemeController::class, 'apply'])->name('admin.themes.apply');
            Route::post('/preview', [ThemeController::class, 'preview'])->name('admin.themes.preview');
            Route::post('/reset', [ThemeController::class, 'resetToDefault'])->name('admin.themes.reset');
            Route::post('/custom-colors', [ThemeController::class, 'updateCustomColors'])->name('admin.themes.custom-colors');
            Route::get('/css', [ThemeController::class, 'getCss'])->name('admin.themes.css');
            Route::get('/api', [ThemeController::class, 'getThemes'])->name('admin.themes.api');
        });
    });

    // Role-based access for other routes
    Route::middleware('role:system_admin,office_staff,accountant')->group(function () {
        // Donor Management
        Route::resource('donors', DonorController::class);
        Route::get('donors/blocked/list', [DonorController::class, 'blocked'])->name('donors.blocked');
        Route::patch('donors/{donor}/status', [DonorController::class, 'updateStatus'])->name('donors.update-status');

        // Collection Management
        Route::resource('collections', CollectionController::class);
        Route::post('collections/{collection}/cancel', [CollectionController::class, 'cancel'])->name('collections.cancel');
        Route::get('collections/{collection}/receipt', [CollectionController::class, 'receipt'])->name('collections.receipt');
        Route::get('collections/grouped/payment-mode', [CollectionController::class, 'groupedByPaymentMode'])->name('collections.grouped');
        Route::get('collections/donor-info', [CollectionController::class, 'getDonorInfo'])->name('collections.donor-info');

        // Magazine Management
        Route::resource('magazines', MagazineController::class);
        Route::get('magazines/address-register', [MagazineController::class, 'addressRegister'])->name('magazines.address-register');
        Route::get('magazines/subscription-register', [MagazineController::class, 'subscriptionRegister'])->name('magazines.subscription-register');

        // Reports
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('donor-collections', [ReportController::class, 'donorCollections'])->name('donor-collections');
            Route::get('collection-register', [ReportController::class, 'collectionRegister'])->name('collection-register');
            Route::get('grouped-collections', [ReportController::class, 'groupedCollections'])->name('grouped-collections');
            Route::get('promotional-secretary', [ReportController::class, 'promotionalSecretary'])->name('promotional-secretary');
            Route::get('date-wise', [ReportController::class, 'dateWise'])->name('date-wise');
        });

        // Communications
        Route::resource('communications', CommunicationController::class);
        Route::post('communications/{communication}/send', [CommunicationController::class, 'send'])->name('communications.send');

        // Bible Verses
        Route::resource('bible-verses', BibleVerseController::class);
        Route::get('bible-verses/today', [BibleVerseController::class, 'today'])->name('bible-verses.today');

        // Dashboard utilities
        Route::get('dashboard/stats', [DashboardController::class, 'stats'])->name('dashboard.stats');
    });

    // Secretary-specific routes
    Route::middleware('role:secretary')->group(function () {
        Route::resource('collections', CollectionController::class)->only(['index', 'show', 'create', 'store']);
        Route::get('reports/collection-register', [ReportController::class, 'collectionRegister'])->name('reports.collection-register');
    });
});

// Test route for debugging
Route::get('/test-view', function () {
    return view('donors.index', ['donors' => \App\Models\Donor::paginate(5)]);
})->name('test.view');
