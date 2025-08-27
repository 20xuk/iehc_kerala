<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>IEHC System Login</title>
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
        
        /* Floating Elements */
        .floating-homes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
            pointer-events: none;
        }
        
        .home-icon {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }
        
        .home-icon:nth-child(1) {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .home-icon:nth-child(2) {
            top: 20%;
            right: 15%;
            animation-delay: 1s;
        }
        
        .home-icon:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 2s;
        }
        
        .home-icon:nth-child(4) {
            bottom: 15%;
            right: 10%;
            animation-delay: 3s;
        }
        
        .home-icon:nth-child(5) {
            top: 50%;
            left: 5%;
            animation-delay: 4s;
        }
        
        .home-icon:nth-child(6) {
            top: 60%;
            right: 5%;
            animation-delay: 5s;
        }
        
        .cross-icon {
            position: absolute;
            opacity: 0.08;
            animation: float 8s ease-in-out infinite;
        }
        
        .cross-icon:nth-child(7) {
            top: 30%;
            left: 30%;
            animation-delay: 0.5s;
        }
        
        .cross-icon:nth-child(8) {
            bottom: 30%;
            right: 30%;
            animation-delay: 1.5s;
        }
        
        .cross-icon:nth-child(9) {
            top: 70%;
            left: 40%;
            animation-delay: 2.5s;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(5deg);
            }
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
        
        .language-selector {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #666;
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
        
        .signin-btn {
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
        
        .signin-btn:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .forgot-password {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .forgot-password a {
            color: #3b82f6;
            text-decoration: none;
            font-size: 14px;
        }
        
        .forgot-password a:hover {
            text-decoration: underline;
        }
        
        .powered-by {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #666;
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
        
        /* Mission Statement */
        .mission-text {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            color: rgba(255, 255, 255, 0.8);
            font-size: 12px;
            z-index: 5;
            max-width: 600px;
            padding: 0 20px;
        }
    </style>
</head>
<body>
    <!-- Background Floating Elements -->
    <div class="floating-homes">
        <!-- Home Icons representing "Every Home" -->
        <svg class="home-icon" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline points="9,22 9,12 15,12 15,22"/>
        </svg>
        
        <svg class="home-icon" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline points="9,22 9,12 15,12 15,22"/>
        </svg>
        
        <svg class="home-icon" width="45" height="45" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline points="9,22 9,12 15,12 15,22"/>
        </svg>
        
        <svg class="home-icon" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline points="9,22 9,12 15,12 15,22"/>
        </svg>
        
        <svg class="home-icon" width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline points="9,22 9,12 15,12 15,22"/>
        </svg>
        
        <svg class="home-icon" width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline points="9,22 9,12 15,12 15,22"/>
        </svg>
        
        <!-- Cross Icons representing the Crusade mission -->
        <svg class="cross-icon" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
            <line x1="12" y1="5" x2="12" y2="19"/>
            <line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        
        <svg class="cross-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
            <line x1="12" y1="5" x2="12" y2="19"/>
            <line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        
        <svg class="cross-icon" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
            <line x1="12" y1="5" x2="12" y2="19"/>
            <line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
    </div>

    <div class="login-container">
        <div class="login-card">
            <!-- System Logo -->
            <div class="system-logo">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </div>

            <!-- Language Selector -->
            <div class="language-selector">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                </svg>
                <span>English</span>
            </div>

            <!-- Title Section -->
            <div class="title-section">
                <h1 class="main-title">Sign In</h1>
                <p class="subtitle">IEHC System Login</p>
                <p class="instruction">Enter your credentials to access the system</p>
            </div>

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="input-group">
                    <label for="email">Your registered email id</label>
                    <input type="email" id="email" name="email" class="input-field" 
                           placeholder="Enter your registered email id" required value="{{ old('email') }}">
                    @error('email')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="password-field">
                        <input type="password" id="password" name="password" class="input-field" 
                               placeholder="Enter your password" required>
                        <svg class="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </div>
                    @error('password')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="signin-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                    Sign In
                </button>
            </form>

            <div class="forgot-password">
                <a href="#">Forgot Password?</a>
            </div>

            <div class="powered-by">
                Powered by <a href="https://benagon.com" target="_blank" rel="noopener noreferrer" style="color: #3b82f6; text-decoration: none;">Benagon Technologies Pvt. Ltd</a>
            </div>
        </div>
    </div>

    <!-- Mission Statement -->
    <div class="mission-text">
        "Reaching Every Home in India with the Gospel of Jesus Christ"
    </div>

    <script>
        // Password visibility toggle
        document.querySelector('.eye-icon').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
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
    </script>
</body>
</html>
