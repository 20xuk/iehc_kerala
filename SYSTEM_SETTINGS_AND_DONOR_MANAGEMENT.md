# System Settings and Donor Management Features

## Overview
This document outlines the comprehensive system settings and donor management features implemented in the IEHCKerala application.

## 🏗️ System Settings

### 1. Admin User Management
**Access**: System Administrators only

#### Features:
- **User Listing**: View all admin users (System Admin, Office Staff, Accountant)
- **User Creation**: Add new admin users with role assignment
- **User Editing**: Modify user details and roles
- **Password Reset**: Force password change for users
- **Status Toggle**: Enable/disable user accounts
- **User Deletion**: Remove users (with safety checks)

#### Roles Available:
- **System Administrator**: Full system access
- **Office Staff**: Donor and collection management
- **Accountant**: Financial management and reports

### 2. General Settings
**Location**: System Settings → General Settings tab

#### Configuration Options:
- **Head Office Address**: Complete organization address
- **Organization Name**: Name of the organization
- **Time Zone**: Default application timezone

### 3. Bank Details
**Location**: System Settings → Bank Details tab

#### Configuration Options:
- **Bank Name**: Name of the bank
- **Account Number**: Bank account number
- **IFSC Code**: IFSC code of the bank branch
- **Branch Name**: Name of the bank branch

### 4. WhatsApp Business API
**Location**: System Settings → WhatsApp Business API tab

#### Configuration Options:
- **WhatsApp API Key**: Business API key
- **WhatsApp Phone Number**: Business phone number
- **Enable WhatsApp Notifications**: Toggle for notifications

### 5. SMS Integration (Twilio)
**Location**: System Settings → SMS Integration tab

#### Configuration Options:
- **Twilio Account SID**: Twilio account identifier
- **Twilio Auth Token**: Authentication token
- **Twilio Phone Number**: Sender phone number
- **Enable SMS Notifications**: Toggle for SMS features

### 6. Email Configuration
**Location**: System Settings → Email Configuration tab

#### Configuration Options:
- **SMTP Host**: Email server hostname
- **SMTP Port**: Email server port
- **SMTP Username**: Email account username
- **SMTP Password**: Email account password
- **SMTP Encryption**: TLS/SSL/None
- **From Email Address**: Default sender email
- **From Name**: Default sender name

### 7. Theme & Appearance
**Location**: System Settings → Theme & Appearance tab

#### Configuration Options:
- **Primary Color**: Application theme color
- **Organization Logo**: Upload organization logo
- **Favicon**: Upload favicon icon

### 8. Security Settings
**Location**: System Settings → Security Settings tab

#### Configuration Options:
- **Session Lifetime**: Session timeout in minutes
- **Minimum Password Length**: Required password length
- **Require Password Change**: Force first-time password change
- **Enable Audit Logging**: Track all CRUD operations

### 9. Notifications
**Location**: System Settings → Notifications tab

#### Configuration Options:
- **Enable Email Notifications**: Toggle email notifications
- **Donor Registration Notifications**: New donor alerts
- **Collection Notifications**: New collection alerts

### 10. Backup & Restore
**Location**: System Settings → Backup & Restore tab

#### Features:
- **Auto Backup**: Enable automatic database backups
- **Backup Frequency**: Daily/Weekly/Monthly
- **Backup Retention**: Days to keep backup files
- **Manual Backup**: Create backup on demand
- **Restore**: Restore from backup file

## 📊 Donor Management

### 1. Donor List Views

#### Card View
- **Donor Cards**: Visual representation of donors
- **Profile Images**: Donor photos (if uploaded)
- **Quick Actions**: Edit, View, Delete buttons
- **Status Indicators**: Active/Inactive status
- **Contact Information**: Phone and email display

#### Table View
- **Sortable Columns**: Sort by name, date, status
- **Search Functionality**: Search across all fields
- **Bulk Actions**: Select multiple donors
- **Export Options**: Export to CSV/Excel
- **Pagination**: Navigate through large datasets

### 2. Add Donor Form
**Based on the provided image design**

#### Personal Information Section:
- **First Name***: Required field
- **Last Name***: Required field
- **Date of Birth**: Date picker with calendar icon
- **Wedding Date**: Date picker with calendar icon
- **Gender**: Dropdown selection

#### Address Section:
- **Address***: Required textarea for complete address
- **City**: Text input
- **State**: Text input
- **Country**: Dropdown with countries
- **Postal Code**: Text input for pincode
- **Region***: Required dropdown with regions

#### Contact Information Section:
- **Main Mobile Number**: Primary contact
- **Alternative Mobile 1**: Secondary contact
- **Alternative Mobile 2**: Tertiary contact
- **Email Address**: Email input with validation
- **Communication Preference**: SMS/Email dropdown

#### Donor Specific Information Section:
- **Donor Status**: Active/Inactive dropdown
- **Promotional Secretary**: Secretary assignment
- **PAN Number**: Tax identification number
- **Donation Type**: Frequency dropdown
- **Magazine Subscription**: Checkbox option

#### Profile Photo:
- **Upload Photo**: Blue button with camera icon
- **Photo Preview**: Display uploaded image
- **Photo Management**: Edit/remove functionality

### 3. Donor Actions

#### View Donor
- **Complete Profile**: All donor information
- **Donation History**: List of all donations
- **Contact History**: Communication logs
- **Audit Trail**: All changes made to donor

#### Edit Donor
- **Form Pre-population**: Load existing data
- **Validation**: Real-time form validation
- **Save Changes**: Update donor information
- **Audit Logging**: Track all modifications

#### Delete Donor
- **Confirmation Modal**: Prevent accidental deletion
- **Dependency Check**: Ensure no active collections
- **Soft Delete**: Mark as deleted, not remove
- **Audit Trail**: Log deletion action

### 4. Audit Logging
**Comprehensive tracking of all CRUD operations**

#### Tracked Actions:
- **Create**: New donor registration
- **Update**: Information modifications
- **Delete**: Donor removal
- **View**: Profile access

#### Audit Information:
- **User**: Who performed the action
- **Action**: What was done
- **Timestamp**: When it happened
- **IP Address**: Where it was done
- **User Agent**: Browser information
- **Old Values**: Previous data
- **New Values**: Updated data

### 5. Communication Features

#### Email to Donor
- **Professional Modal**: Clean email interface
- **Template Support**: Pre-written templates
- **Attachment Support**: Send documents
- **Delivery Tracking**: Email status tracking

#### SMS to Donor
- **Quick SMS**: Send immediate messages
- **Template Messages**: Pre-written SMS
- **Delivery Reports**: SMS delivery status
- **Bulk SMS**: Send to multiple donors

### 6. Dashboard Integration

#### Region-wise Statistics:
- **Donor Count**: Number of donors per region
- **Collection Amount**: Total collections per region
- **Transfer Types**: Different payment methods
- **Visual Charts**: Graphs and charts

#### Quick Actions:
- **Add Donor**: Quick access to donor form
- **Recent Donors**: Latest registrations
- **Pending Actions**: Items requiring attention
- **System Alerts**: Important notifications

## 🔧 Technical Implementation

### Database Structure
- **system_settings**: Configuration storage
- **countries**: Country management
- **regions**: Region management
- **audit_logs**: Activity tracking
- **users**: Admin user management

### Security Features
- **Role-based Access**: Different permissions per role
- **Audit Logging**: Complete activity tracking
- **Password Policies**: Secure password requirements
- **Session Management**: Secure session handling

### API Integration
- **WhatsApp Business API**: For notifications
- **Twilio SMS API**: For SMS functionality
- **Email SMTP**: For email communications

## 🚀 Usage Instructions

### For System Administrators:
1. **Access System Settings**: Navigate to System Settings in sidebar
2. **Configure Settings**: Update settings in appropriate tabs
3. **Manage Users**: Create and manage admin users
4. **Monitor Activity**: Review audit logs for security

### For Staff Users:
1. **Access Donor Management**: Navigate to Donors in sidebar
2. **Add New Donors**: Use the comprehensive donor form
3. **Manage Existing Donors**: Edit, view, or delete donors
4. **Communicate**: Send emails or SMS to donors

## 📋 Future Enhancements

### Planned Features:
- **Advanced Reporting**: Detailed analytics and reports
- **Mobile App**: Mobile application for field work
- **API Integration**: Third-party system integration
- **Advanced Security**: Two-factor authentication
- **Backup Automation**: Scheduled automatic backups
- **Notification Center**: Centralized notification management

### Performance Optimizations:
- **Caching**: Implement Redis caching
- **Database Optimization**: Query optimization
- **Image Processing**: Automatic image resizing
- **Search Enhancement**: Full-text search capabilities

## 🔒 Security Considerations

### Data Protection:
- **Encryption**: Sensitive data encryption
- **Access Control**: Role-based permissions
- **Audit Trail**: Complete activity logging
- **Backup Security**: Encrypted backup storage

### Compliance:
- **GDPR Compliance**: Data protection regulations
- **Local Laws**: Compliance with Indian laws
- **Data Retention**: Proper data retention policies
- **Privacy Policy**: User privacy protection

This comprehensive system provides a robust foundation for managing donors and system configuration while maintaining security and audit trails throughout the application.
