<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>ExcelLens - Academic Portal Login</title>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <!-- Lucide Icons for professional icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            :root {
            --primary: #880000; /* Darker red */
            --primary-light: #a00000;
            --primary-dark: #550000;
            --secondary: #f8f0f0;
            --light-gray: #f5f5f5;
            --dark-gray: #333;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --info: #17a2b8;
            --white: #ffffff;
            --border-color: #e3e6ea;
            --text-muted: #6c757d;
            --shadow: 0 2px 10px rgba(0,0,0,0.1);
            --shadow-lg: 0 8px 30px rgba(0,0,0,0.12);
            --font-family-main:  'Inter', sans-serif;
            --font-family-heading: 'Inter', serif;
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        [data-theme="dark"] {
            --primary: #aa0000; /* Darker red for dark mode */
            --secondary: #2d1b1b;
            --light-gray: #1a1a1a;
            --dark-gray: #f5f5f5;
            --white: #2d2d2d;
            --border-color: #404040;
            --text-muted: #adb5bd;
            --shadow: 0 2px 10px rgba(0,0,0,0.3);
            --shadow-lg: 0 8px 30px rgba(0,0,0,0.35);
        }

        /* Basic Reset & Body Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: var(--font-family-main);
        }

        body {
            background-color: var(--light-gray);
            color: var(--dark-gray);
            transition: var(--transition);
            line-height: 1.6;
            overflow: hidden;
        }

        /* Container for the entire login page */
        .container {
            display: flex;
            height: 100vh;
            flex-direction: row;
            animation: fadeIn 0.8s ease-out;
        }

        /* Left Panel - Educational Theme Visuals */
        .left-panel {
            flex: 1;
            background-color: var(--white);
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            border-right: 1px solid var(--border-color);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .welcome-content {
            text-align: center;
            margin-bottom: 0px;
            color: var(--dark-gray);
            position: relative;
            z-index: 5;
            max-width: 500px;
        }

        .welcome-content h1 {
            font-size: 2.2rem;
            margin-bottom: 15px;
            font-weight: 700;
            var :(--dark-gray);
            font-family: var(--font-family-heading);
            line-height: 1.2;
            animation: slideInLeft 0.8s ease-out;
        }

        .welcome-content p {
            font-size: 1rem;
            line-height: 1.6;
            color: var(--text-muted);
            margin-bottom: 20px;
            animation: fadeIn 1s ease-out 0.3s both;
        }

        .welcome-content a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            border-bottom: 2px solid transparent;
            padding-bottom: 2px;
        }

        .welcome-content a:hover {
            border-bottom-color: var(--primary);
            color: var(--primary-dark);
        }

        .features-list {
            text-align: left;
            margin: 20px 0;
            animation: fadeIn 1s ease-out 0.6s both;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            color: var(--dark-gray);
            font-size: 0.9rem;
        }

        .feature-icon {
            margin-right: 12px;
            color: var(--primary);
            background-color: rgba(136, 0, 0, 0.1); /* Updated to match new primary */
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .feature-icon svg {
            width: 16px;
            height: 16px;
        }

        .illustration-container {
    width: 100%;
    max-width: 400px;
    margin-top: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: transparent;
    border: none;
    box-shadow: none;
    z-index: 2;
    border-radius: 100px;
}


        .illustration-container img {
            max-width: 120%;
            height: auto;
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
             background: transparent;     /* No background */
    border: none;                /* No border */
    box-shadow: none !important; /* Remove shadow if applied globally */
    border-radius: 0px;          /* Remove curve */
        }

        /* Right Panel - Login Form */
        .right-panel {
            flex: 1;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: var(--light-gray);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .login-form {
            max-width: 500px; /* Increased */
            width: 100%;
            margin: 0 auto;
            padding: 60px 50px; /* Increased padding */
            background-color: var(--white);
            border-radius: 16px; /* Slightly more rounded */
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            animation: slideInRight 0.8s ease-out;
            position: relative;
            z-index: 2;
        }


        .logo-container {
            text-align: center;
            margin-bottom: 30px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.8s ease-out 0.2s both;
        }

        .logo-container img {
            max-height: 60px;
            transition: var(--transition);
        }

        .login-heading {
            margin-bottom: 25px;
            text-align: center;
            animation: fadeIn 0.8s ease-out 0.4s both;
        }

        .login-heading h2 {
            font-size: 2rem;
            color: var(--dark-gray);
            margin-bottom: 8px;
            font-weight: 700;
            font-family: var(--font-family-heading);
        }

        .login-heading p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            color: var(--text-muted);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            animation: fadeIn 0.8s ease-out 0.6s both;
        }

        .divider::before, .divider::after {
            content: '';
            display: inline-block;
            width: 35%;
            height: 1px;
            background-color: var(--border-color);
            vertical-align: middle;
            margin: 0 15px;
        }

        .email-input-group {
            position: relative;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            overflow: hidden;
            transition: var(--transition);
            animation: fadeIn 0.8s ease-out 0.7s both;
        }

        .email-input-group:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(136, 0, 0, 0.3); /* Updated to match new primary */
        }

        .email-input-group .email-icon {
            padding: 12px 8px 12px 15px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
        }

        .email-input-group .email-icon svg {
            width: 18px;
            height: 18px;
        }

        .email-input-group .email-input {
            flex: 1;
            padding: 12px 0;
            border: none;
            outline: none;
            font-size: 1rem; /* Slightly larger */
            color: var(--dark-gray);
            background: transparent;
        }

        .email-input-group .email-input::placeholder {
            color: var(--text-muted);
            opacity: 0.7;
        }

        .email-input-group .email-suffix {
            padding: 12px 15px 12px 8px;
            background-color: var(--light-gray);
            border-left: 1px solid var(--border-color);
            color: var(--text-muted);
            font-size: 0.95rem;
            font-weight: 500;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 1.05rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: var(--transition);
            box-shadow: var(--shadow);
            animation: fadeIn 0.8s ease-out 0.8s both;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .submit-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .submit-btn:active {
            transform: translateY(0);
            box-shadow: var(--shadow);
        }

        .submit-btn svg {
            margin-left: 8px;
            width: 18px;
            height: 18px;
        }

        .terms {
            margin-top: 20px;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.8rem;
            line-height: 1.5;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.8s ease-out 0.9s both;
        }

        .terms label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .terms input[type="checkbox"] {
            margin-right: 8px;
            vertical-align: middle;
            accent-color: var(--primary);
            transform: scale(1);
        }

        .terms a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            margin: 0 3px;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        /* Google Sign-In Button Styling */
        .g_id_signin {
            width: 100%;
            margin: 15px 0;
            animation: fadeIn 0.8s ease-out 0.5s both;
            display: flex;
            justify-content: center;
        }

        /* Animated Circles in Both Panels */
        .floating-circle {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(136, 0, 0, 0.08); /* Updated to match new primary */
            z-index: 1;
            animation: float 15s ease-in-out infinite;
            filter: blur(1px);
        }

        /* Updated Left Panel Circles - Darker and More */
.circle-1 {
    width: 150px;
    height: 150px;
    top: 5%;
    left: 5%;
    animation-delay: 0s;
    animation-duration: 20s;
    background-color: rgba(136, 0, 0, 0.15); /* Darker opacity */
}

.circle-2 {
    width: 100px;
    height: 100px;
    bottom: 10%;
    right: 8%;
    animation-delay: 2s;
    animation-duration: 18s;
    background-color: rgba(136, 0, 0, 0.15); /* Darker opacity */
}

.circle-3 {
    width: 80px;
    height: 80px;
    top: 25%;
    right: 12%;
    animation-delay: 4s;
    animation-duration: 16s;
    background-color: rgba(136, 0, 0, 0.15); /* Darker opacity */
}

.circle-4 {
    width: 120px;
    height: 120px;
    bottom: 20%;
    left: 8%;
    animation-delay: 6s;
    animation-duration: 22s;
    background-color: rgba(136, 0, 0, 0.15); /* Darker opacity */
}

.circle-5 {
    width: 70px;
    height: 70px;
    top: 65%;
    left: 15%;
    animation-delay: 3s;
    animation-duration: 14s;
    background-color: rgba(136, 0, 0, 0.15); /* Darker opacity */
}

.circle-6 {
    width: 90px;
    height: 90px;
    top: 15%;
    right: 20%;
    animation-delay: 5s;
    animation-duration: 19s;
    background-color: rgba(136, 0, 0, 0.15); /* Darker opacity */
}
.circle-7 {
    width: 90px;
    height: 90px;
    top: 20%;
    left: 70%;
    animation-delay: 1s;
    animation-duration: 18s;
    background-color: rgba(136, 0, 0, 0.15);
}

.circle-8 {
    width: 70px;
    height: 70px;
    top: 60%;
    right: 25%;
    animation-delay: 3s;
    animation-duration: 20s;
    background-color: rgba(136, 0, 0, 0.15);
}

.circle-9 {
    width: 50px;
    height: 50px;
    bottom: 25%;
    left: 65%;
    animation-delay: 2s;
    animation-duration: 19s;
    background-color: rgba(136, 0, 0, 0.15);
}

.circle-10 {
    width: 100px;
    height: 100px;
    top: 45%;
    right: 10%;
    animation-delay: 4s;
    animation-duration: 21s;
    background-color: rgba(136, 0, 0, 0.15);
}

.circle-11 {
    width: 60px;
    height: 60px;
    bottom: 10%;
    left: 60%;
    animation-delay: 5s;
    animation-duration: 17s;
    background-color: rgba(136, 0, 0, 0.15);
}

.circle-12 {
    width: 80px;
    height: 80px;
    top: 10%;
    right: 20%;
    animation-delay: 6s;
    animation-duration: 23s;
    background-color: rgba(136, 0, 0, 0.15);
}

/* New additional circles */
.circle-13 {
    width: 60px;
    height: 60px;
    top: 40%;
    left: 5%;
    animation-delay: 1s;
    animation-duration: 17s;
    background-color: rgba(136, 0, 0, 0.15);
}

.circle-14 {
    width: 110px;
    height: 110px;
    bottom: 5%;
    right: 20%;
    animation-delay: 7s;
    animation-duration: 21s;
    background-color: rgba(136, 0, 0, 0.15);
}



.circle-16 {
    width: 130px;
    height: 130px;
    top: 50%;
    left: 20%;
    animation-delay: 2s;
    animation-duration: 24s;
    background-color: rgba(136, 0, 0, 0.15);
}

.circle-17 {
    width: 70px;
    height: 70px;
    bottom: 30%;
    right: 5%;
    animation-delay: 5s;
    animation-duration: 16s;
    background-color: rgba(136, 0, 0, 0.15);
}

.circle-18 {
    width: 90px;
    height: 90px;
    top: 10%;
    left: 25%;
    animation-delay: 3s;
    animation-duration: 20s;
    background-color: rgba(136, 0, 0, 0.15);
}

        /* Right panel decorative elements */
        .right-panel-shape {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 1;
        }

        .right-panel-shape svg {
            position: absolute;
            opacity: 0.03;
            animation: float 15s ease-in-out infinite alternate;
        }

        .shape-5 {
            top: 10%;
            left: -40px;
            width: 180px;
            height: 180px;
            animation-delay: 1s;
        }

        .shape-6 {
            bottom: 10%;
            right: -40px;
            width: 220px;
            height: 220px;
            animation-delay: 3s;
        }

        /* Keyframe animations */
        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0) rotate(0deg); }
            25% { transform: translateY(-20px) translateX(10px) rotate(5deg); }
            50% { transform: translateY(10px) translateX(-15px) rotate(-5deg); }
            75% { transform: translateY(-15px) translateX(-10px) rotate(3deg); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInLeft {
            from { transform: translateX(-40px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideInRight {
            from { transform: translateX(40px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideInTop {
            from { transform: translateY(-40px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.03); }
        }

        /* Dark Mode Toggle */
        .theme-toggle {
            position: absolute;
            top: 25px;
            right: 25px;
            background-color: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow);
            transition: var(--transition);
            z-index: 10;
            animation: fadeIn 0.8s ease-out 0.5s both;
        }

        .theme-toggle:hover {
            transform: rotate(15deg);
            box-shadow: var(--shadow-lg);
        }

        .theme-toggle svg {
            width: 20px;
            height: 20px;
            color: var(--dark-gray);
            transition: var(--transition);
        }

        /* Message box styles */
        .message-box {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 12px 20px;
            border-radius: 6px;
            color: white;
            font-weight: 500;
            z-index: 1000;
            display: none;
            box-shadow: var(--shadow-lg);
            animation: slideInTop 0.5s ease-out;
            backdrop-filter: blur(10px);
            background-color: rgba(0, 0, 0, 0.7);
            font-size: 0.9rem;
        }

        .message-box.success { background-color: rgba(40, 167, 69, 0.9); }
        .message-box.error { background-color: rgba(220, 53, 69, 0.9); }
        .message-box.warning { background-color: rgba(255, 193, 7, 0.9); }
        .message-box.info { background-color: rgba(23, 162, 184, 0.9); }

        /* Loading spinner */
        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: var(--white);
            animation: spin 1s ease-in-out infinite;
            margin-left: 8px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive Adjustments */
        @media (max-width: 1200px) {
            .left-panel {
                padding: 30px;
            }
            .right-panel {
                padding: 40px;
            }
            .welcome-content h1 {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 992px) {
            .left-panel {
                padding: 20px;
            }
            .right-panel {
                padding: 30px;
            }
            .login-form {
                padding: 25px;
            }
            .welcome-content h1 {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 768px) {
            body {
                overflow: auto;
            }
            .container {
                flex-direction: column;
                height: auto;
                min-height: 100vh;
            }
            .left-panel {
                padding: 30px 15px;
                border-right: none;
                border-bottom: 1px solid var(--border-color);
                flex: none;
                height: auto;
            }
            .right-panel {
                padding: 30px 15px;
                flex-grow: 1;
            }
            .login-form {
                max-width: 100%;
                box-shadow: none;
                padding: 20px;
            }
            .welcome-content h1 {
                font-size: 1.5rem;
            }
            .theme-toggle {
                top: 15px;
                right: 15px;
            }
        }

        @media (max-width: 480px) {
            .welcome-content h1 {
                font-size: 1.4rem;
            }
            .login-heading h2 {
                font-size: 1.5rem;
            }
            .email-input-group .email-suffix {
                display: none;
            }
            .terms {
                flex-direction: column;
                text-align: center;
            }
            .terms label {
                flex-direction: column;
                text-align: center;
            }
        }
        .circle-22 {
    width: 80px;
    height: 80px;
    top: 15%;
    left: 5%;
    animation-delay: 1s;
    animation-duration: 22s;
    background-color: rgba(136, 0, 0, 0.15);
}

.circle-23 {
    width: 60px;
    height: 60px;
    bottom: 20%;
    left: 10%;
    animation-delay: 3s;
    animation-duration: 18s;
    background-color: rgba(136, 0, 0, 0.15);
}

.circle-24 {
    width: 90px;
    height: 90px;
    top: 50%;
    left: 15%;
    animation-delay: 2s;
    animation-duration: 20s;
    background-color: rgba(136, 0, 0, 0.15);
}
.official-login-link {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    animation: fadeIn 0.8s ease-out 1s both;
}

.official-login-link a {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--primary);
    text-decoration: none;
    padding: 6px 12px;
    border-radius: 8px;
    transition: var(--transition);
    background-color: transparent;
    border-bottom: 2px solid transparent;
}

.official-login-link a:hover {
    color: var(--primary-dark);
    border-bottom: 2px solid var(--primary-dark);
    transform: translateY(-1px);
}

.official-login-link a i {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 18px;
    height: 18px;
}




        </style>
    
</head>
<body>
  <div class="container">
    <!-- Left panel - Educational Theme -->
        <div class="left-panel">
      <!-- Animated floating circles -->
      <div class="floating-circle circle-1"></div>
      <div class="floating-circle circle-3"></div>
      <div class="floating-circle circle-4"></div>

      <div class="floating-circle circle-6"></div>
      <!-- Inside the left-panel div, add these after the existing circles -->
    <div class="floating-circle circle-13"></div>
    <div class="floating-circle circle-14"></div>

    <div class="floating-circle circle-16"></div>
    <div class="floating-circle circle-17"></div>
    <div class="floating-circle circle-18"></div>
      

      
      <div class ="welcome-content">
        <h1>Welcome to ExcelLens!</h1>
            <div class="illustration-container">
                <!-- Your ExcelLens image remains here -->
                <img src="../Images/ExcelLens.png" alt="Academic Excellence Illustration" class="excellens-logo" />
            </div>
      </div>
      
      <div class="welcome-content">
        
        <p>By logging in, you agree to ExcelLens's <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</p>
      </div>
    </div>



    <!-- Right panel - Login Form -->
    <div class="right-panel">
      <!-- Additional floating circles for right panel -->


      
      <div class="login-form">
        
        <div class="login-heading">
          <h2>Welcome Back</h2>
          <p>Sign in to access your academic dashboard</p>
        </div>

        <!-- Google Sign-In -->
        <div id="g_id_onload"
            data-client_id="391259308623-ukfjrlipkj0t25k4o2s5dt7ffi6qudqi.apps.googleusercontent.com"
            data-context="signin"
            data-ux_mode="popup"
            data-callback="handleCredentialResponse"
            data-auto_prompt="false"></div>

        <div class="g_id_signin"
            data-type="standard"
            data-shape="rectangular"
            data-theme="outline"
            data-text="signin_with"
            data-size="large"
            data-logo_alignment="left"
            data-width="400"></div>

        <button class="submit-btn" id="loginBtn">
            Login
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        </button>

        <div class="terms">
          <label>
            <input type="checkbox" id="termsCheckbox" checked /> 
            I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
          </label>
        </div>
            <!-- Link for Academic Official -->
       <div class="official-login-link">
            <a href="acad_official_login.php">
                <i data-lucide="user-cog"></i> Login as Academic Official
            </a>
        </div>


      </div>
    </div>
  </div>

  <script>
    // Initialize Lucide icons
    lucide.createIcons();

    // Enhanced Google Sign-In callback function
    function handleCredentialResponse(response) {
        const loginBtn = document.getElementById('loginBtn');
        const originalText = loginBtn.innerHTML;
        
        // Show loading state
        loginBtn.innerHTML = 'Verifying... <span class="spinner"></span>';
        loginBtn.disabled = true;
        
        try {
            const payload = JSON.parse(atob(response.credential.split('.')[1]));
            const email = payload.email;
            const full_name = payload.name;
            const profile_picture = payload.picture;

            if (email.includes('@g.batstate-u.edu.ph')) {
                // In a real application, you'd send this to your backend
                console.log("Attempting login for:", email, full_name);

                // Simulate API call with timeout
                setTimeout(() => {
                    // This would be replaced with actual fetch call
                    // fetch('login.php', {
                    //     method: 'POST',
                    //     headers: { 'Content-Type': 'application/json' },
                    //     body: JSON.stringify({ email, full_name, profile_picture })
                    // })
                    
                    // Simulate success response
                    const data = {
                        success: true,
                        redirect: "dashboard.html",
                        user: {
                            name: full_name,
                            email: email,
                            role: "student",
                            avatar: profile_picture
                        }
                    };
                    
                    if (data.success) {
                        showMessageBox(`Welcome back, ${full_name}! Redirecting...`, 'success');
                        // In real app: window.location.href = data.redirect;
                        
                        // Animation before redirect
                        document.querySelector('.login-form').style.animation = 'fadeIn 0.5s ease-out reverse';
                        setTimeout(() => {
                            // Show a success message since we're not actually redirecting
                            showMessageBox("Login successful! (In a real app, you'd be redirected to your dashboard)", 'success');
                            loginBtn.innerHTML = originalText;
                            loginBtn.disabled = false;
                        }, 1000);
                    } else {
                        showMessageBox("Authentication failed. Please try again.", 'error');
                        loginBtn.innerHTML = originalText;
                        loginBtn.disabled = false;
                    }
                }, 1500);
            } else {
                showMessageBox("Please use your official @g.batstate-u.edu.ph email address.", 'warning');
                loginBtn.innerHTML = originalText;
                loginBtn.disabled = false;
            }
        } catch (error) {
            console.error('Error processing Google Sign-In:', error);
            showMessageBox("An error occurred during sign-in. Please try again.", 'error');
            loginBtn.innerHTML = originalText;
            loginBtn.disabled = false;
        }
    }

    // Email login handler
    document.getElementById('loginBtn').addEventListener('click', function() {
        const emailInput = document.getElementById('emailInput');
        const email = emailInput.value.trim();
        const termsChecked = document.getElementById('termsCheckbox').checked;
        const btn = this;
        const originalText = btn.innerHTML;
        
        if (!termsChecked) {
            showMessageBox("Please agree to the Terms of Service and Privacy Policy", 'warning');
            return;
        }
        
        if (!email) {
            showMessageBox("Please enter your BatStateU email address", 'warning');
            emailInput.focus();
            return;
        }
        
        // Validate email format (simple validation)
        if (!/^[^\s@]+$/.test(email)) {
            showMessageBox("Please enter a valid email username (without @g.batstate-u.edu.ph)", 'warning');
            emailInput.focus();
            return;
        }
        
        const fullEmail = email + '@g.batstate-u.edu.ph';
        
        // Show loading state
        btn.innerHTML = 'Signing in... <span class="spinner"></span>';
        btn.disabled = true;
        
        // Simulate API call with timeout
        setTimeout(() => {
            // This would be replaced with actual fetch call
            // fetch('login.php', {
            //     method: 'POST',
            //     headers: { 'Content-Type': 'application/json' },
            //     body: JSON.stringify({ email: fullEmail })
            // })
            
            // Simulate success response
            const data = {
                success: true,
                redirect: "dashboard.html",
                user: {
                    name: email.split('.')[0].charAt(0).toUpperCase() + email.split('.')[0].slice(1),
                    email: fullEmail,
                    role: "student"
                }
            };
            
            if (data.success) {
                showMessageBox(`Welcome! Redirecting to your dashboard...`, 'success');
                // In real app: window.location.href = data.redirect;
                
                // Animation before redirect
                document.querySelector('.login-form').style.animation = 'fadeIn 0.5s ease-out reverse';
                setTimeout(() => {
                    // Show a success message since we're not actually redirecting
                    showMessageBox("Login successful! (In a real app, you'd be redirected to your dashboard)", 'success');
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }, 1000);
            } else {
                showMessageBox("Invalid credentials. Please try again.", 'error');
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        }, 2000);
    });

    // Custom message box
    function showMessageBox(message, type = 'info') {
        let messageBox = document.getElementById('messageBox');
        if (!messageBox) {
            messageBox = document.createElement('div');
            messageBox.id = 'messageBox';
            document.body.appendChild(messageBox);
        }
        messageBox.className = 'message-box ' + type;
        messageBox.textContent = message;
        messageBox.style.display = 'block';
        
        // Add close button
        const closeBtn = document.createElement('button');
        closeBtn.innerHTML = '&times;';
        closeBtn.style.position = 'absolute';
        closeBtn.style.right = '10px';
        closeBtn.style.top = '50%';
        closeBtn.style.transform = 'translateY(-50%)';
        closeBtn.style.background = 'transparent';
        closeBtn.style.border = 'none';
        closeBtn.style.color = 'white';
        closeBtn.style.cursor = 'pointer';
        closeBtn.style.fontSize = '1.1rem';
        closeBtn.style.padding = '0 5px';
        closeBtn.onclick = () => messageBox.style.display = 'none';
        
        messageBox.appendChild(closeBtn);
        
        setTimeout(() => {
            messageBox.style.opacity = '1';
        }, 10);
        
        setTimeout(() => {
            messageBox.style.opacity = '0';
            setTimeout(() => {
                messageBox.style.display = 'none';
            }, 300);
        }, 5000);
    }

    // Dark mode toggle logic
    const themeToggle = document.getElementById('themeToggle');
    themeToggle.addEventListener('click', () => {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        if (currentTheme === 'dark') {
            document.documentElement.removeAttribute('data-theme');
            localStorage.setItem('theme', 'light');
            themeToggle.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-moon"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>';
        } else {
            document.documentElement.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
            themeToggle.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sun"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>';
        }
        lucide.createIcons();
    });

    // Check for saved theme preference
    if (localStorage.getItem('theme') === 'dark' || 
        (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.setAttribute('data-theme', 'dark');
        themeToggle.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sun"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>';
    }

    // Add focus styles for accessibility
    document.querySelectorAll('button, input, [tabindex]').forEach(el => {
        el.addEventListener('focus', () => {
            el.style.outline = '2px solid var(--primary)';
            el.style.outlineOffset = '2px';
        });
        el.addEventListener('blur', () => {
            el.style.outline = 'none';
        });
    });
    </script>
</body>
</html>