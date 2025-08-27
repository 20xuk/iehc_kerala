<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Change Password - IEHC System</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Figtree', sans-serif;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Background Pattern */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            z-index: 1;
        }
        
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            z-index: 10;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            position: relative;
        }
        
        .system-logo {
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        }
        
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }
        
        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
            font-size: 14px;
        }
        
        .input-field {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            box-sizing: border-box;
            background: rgba(255, 255, 255, 0.9);
        }
        
        .input-field:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background: white;
        }
        
        .password-field {
            position: relative;
        }
        
        .eye-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }
        
        .change-btn {
            width: 100%;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 16px;
        }
        
        .change-btn:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .title-section {
            text-align: center;
            margin-bottom: 30px;
            margin-top: 20px;
        }
        
        .main-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 4px;
        }
        
        .subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
        }
        
        .instruction {
            font-size: 13px;
            color: #888;
        }
        
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.3);
            color: #92400e;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- System Logo -->
            <div class="system-logo">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                    <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>

            <!-- Title Section -->
            <div class="title-section">
                <h1 class="main-title">Change Password</h1>
                <p class="subtitle">IEHC System Security</p>
                <p class="instruction">Please change your password to continue</p>
            </div>

            <!-- Alert -->
            <div class="alert alert-warning">
                <strong>Security Notice:</strong> You must change your password before accessing the system.
            </div>

            <!-- Password Change Form -->
            <form action="{{ route('password.change') }}" method="POST">
                @csrf
                
                <div class="input-group">
                    <label for="current_password">Current Password</label>
                    <div class="password-field">
                        <input type="password" id="current_password" name="current_password" class="input-field" 
                               placeholder="Enter your current password" required>
                        <svg class="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </div>
                    @error('current_password')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="password">New Password</label>
                    <div class="password-field">
                        <input type="password" id="password" name="password" class="input-field" 
                               placeholder="Enter your new password" required>
                        <svg class="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </div>
                    @error('password')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="password_confirmation">Confirm New Password</label>
                    <div class="password-field">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="input-field" 
                               placeholder="Confirm your new password" required>
                        <svg class="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </div>
                </div>

                <button type="submit" class="change-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Change Password
                </button>
            </form>
        </div>
    </div>

    <script>
        // Password visibility toggle for all password fields
        document.querySelectorAll('.eye-icon').forEach(function(eyeIcon) {
            eyeIcon.addEventListener('click', function() {
                const passwordField = this.previousElementSibling;
                const eyeIcon = this;
                
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    eyeIcon.innerHTML = `
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    `;
                } else {
                    passwordField.type = 'password';
                    eyeIcon.innerHTML = `
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    `;
                }
            });
        });
    </script>
</body>
</html>
