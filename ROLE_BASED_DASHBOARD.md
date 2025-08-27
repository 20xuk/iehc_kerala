# Role-Based Dashboard System

## Overview
The IEHCKerala application now has a dynamic role-based dashboard system that automatically shows the correct dashboard and menu items based on the user's role.

## User Roles and Dashboards

### 1. System Administrator (`system_admin`)
- **Dashboard Route**: `/admin/dashboard`
- **Access**: Full system access
- **Menu Items**: All menu items visible
- **Description**: Full system administration and management

### 2. Office Staff (`office_staff`)
- **Dashboard Route**: `/staff/dashboard`
- **Access**: Donor management, collections, magazines, reports, communications
- **Menu Items**: Donors, Collections, Magazines, Reports, Communications, Bible Verses
- **Description**: Manage donors, collections, and day-to-day operations

### 3. Accountant (`accountant`)
- **Dashboard Route**: `/accountant/dashboard`
- **Access**: Donor management, collections, magazines, reports, communications
- **Menu Items**: Donors, Collections, Magazines, Reports, Communications, Bible Verses
- **Description**: Financial management and accounting reports

### 4. Promotional Secretary (`secretary`)
- **Dashboard Route**: `/secretary/dashboard`
- **Access**: Collections and reports only
- **Menu Items**: Collections, Reports
- **Description**: Manage collections and generate reports

### 5. Donor (`donor`)
- **Dashboard Route**: `/donor/dashboard`
- **Access**: Donor-specific features only
- **Menu Items**: Dashboard only
- **Description**: View donation history and manage profile

## How It Works

### 1. Login Redirection
When a user logs in, they are automatically redirected to their role-specific dashboard:
```php
// In AuthController::login()
return $this->redirectBasedOnUserRole($user);
```

### 2. Dynamic Dashboard Link
The sidebar dashboard link automatically points to the correct dashboard:
```php
// In layouts/app.blade.php
<a href="{{ route(Auth::user()->getDashboardRoute()) }}">
```

### 3. Menu Visibility
Menu items are shown/hidden based on user permissions:
```php
@if(Auth::user()->canAccessMenu('donors'))
    <!-- Donor management menu items -->
@endif
```

### 4. Route Protection
Each dashboard is protected by middleware:
```php
// In AdminDashboardController
$this->middleware('role:system_admin');
```

## Key Methods in User Model

### `getDashboardRoute()`
Returns the correct dashboard route name based on user role.

### `canAccessMenu(string $menuItem)`
Checks if user can access a specific menu item.

### `getDashboardTitle()`
Returns the appropriate dashboard title for the user's role.

### `getDashboardDescription()`
Returns a description of what the user can do on their dashboard.

## Menu Access Matrix

| Role | Donors | Collections | Magazines | Reports | Communications | Bible Verses |
|------|--------|-------------|-----------|---------|----------------|--------------|
| System Admin | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| Office Staff | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| Accountant | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| Secretary | ❌ | ✅ | ❌ | ✅ | ❌ | ❌ |
| Donor | ❌ | ❌ | ❌ | ❌ | ❌ | ❌ |

## Testing the System

1. **Login as different users** with different roles
2. **Check dashboard redirection** - should go to role-specific dashboard
3. **Verify menu visibility** - only relevant menu items should be visible
4. **Test navigation** - clicking dashboard should stay on role-specific dashboard

## Benefits

- **Security**: Users only see what they're authorized to access
- **User Experience**: Clean, relevant interface for each role
- **Maintainability**: Centralized role management
- **Scalability**: Easy to add new roles and permissions
