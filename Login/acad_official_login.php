<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>ExcelLens - Academic Official Login</title>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <!-- Lucide Icons for professional icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
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
    margin-bottom: 30px;
    color: var(--dark-gray);
    position: relative;
    z-index: 5;
    max-width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}


        .welcome-content h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            font-weight: 700;
            var(--dark-gray);
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
  display: flex;
  flex-direction: column;
  align-items: flex-start;  /* Align all items to the left */
  justify-content: center;
  text-align: left;         /* Left-align text */
  margin: 15px 0;
  animation: fadeIn 1s ease-out 0.6s both;
}

.feature-item {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 12px;
  color: var(--dark-gray);
  font-size: 0.9rem;
}

.feature-icon {
  background-color: rgba(136, 0, 0, 0.1);
  color: var(--primary);
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
    display: flex;
    justify-content: center;   /* ✅ Centers horizontally */
    align-items: center;       /* ✅ Centers vertically (if needed) */
    margin: 0 auto 20px auto;  /* ✅ Center block with margin auto */
    background: transparent;
    border: none;
    box-shadow: none;
    z-index: 2;
        display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto 10px auto; /* top auto adjusts spacing */
    max-width: 350px;
    width: 100%;
}


.illustration-container img {
    display: block;
    margin: 0 auto;
    max-width: 100%;
    height: auto;
    border-radius: 0 !important;
    box-shadow: none !important;
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
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
            padding: 60px 50px;
            background-color: var(--white);
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            animation: slideInRight 0.8s ease-out;
            position: relative;
            z-index: 2;
                            background: transparent;     /* No background */
        border: none;                /* No border */
        box-shadow: none !important; /* Remove shadow if applied globally */
        border-radius: 0px;          /* Remove curve */
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

        .form-group {
            margin-bottom: 20px;
            animation: fadeIn 0.8s ease-out 0.7s both;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-gray);
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            overflow: hidden;
            transition: var(--transition);
        }

        .input-group:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(136, 0, 0, 0.3);
        }

        .input-group .input-icon {
            padding: 12px 8px 12px 15px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
        }

        .input-group .input-icon svg {
            width: 18px;
            height: 18px;
        }

        .input-group input {
            flex: 1;
            padding: 12px 15px 12px 0;
            border: none;
            outline: none;
            font-size: 1rem;
            color: var(--dark-gray);
            background: transparent;
        }

        .input-group input::placeholder {
            color: var(--text-muted);
            opacity: 0.7;
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
            background-color: rgba(136, 0, 0, 0.08);
            z-index: 1;
            animation: float 15s ease-in-out infinite;
            filter: blur(1px);
        }

        .circle-1 {
            width: 150px;
            height: 150px;
            top: 5%;
            left: 5%;
            animation-delay: 0s;
            animation-duration: 20s;
            background-color: rgba(136, 0, 0, 0.15);
        }

        .circle-2 {
            width: 100px;
            height: 100px;
            bottom: 10%;
            right: 8%;
            animation-delay: 2s;
            animation-duration: 18s;
            background-color: rgba(136, 0, 0, 0.15);
        }

        .circle-3 {
            width: 80px;
            height: 80px;
            top: 25%;
            right: 12%;
            animation-delay: 4s;
            animation-duration: 16s;
            background-color: rgba(136, 0, 0, 0.15);
        }

        .circle-4 {
            width: 120px;
            height: 120px;
            bottom: 20%;
            left: 8%;
            animation-delay: 6s;
            animation-duration: 22s;
            background-color: rgba(136, 0, 0, 0.15);
        }

        .circle-5 {
            width: 70px;
            height: 70px;
            top: 65%;
            left: 15%;
            animation-delay: 3s;
            animation-duration: 14s;
            background-color: rgba(136, 0, 0, 0.15);
        }

        .circle-6 {
            width: 90px;
            height: 90px;
            top: 15%;
            right: 20%;
            animation-delay: 5s;
            animation-duration: 19s;
            background-color: rgba(136, 0, 0, 0.15);
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

        }

        @media (max-width: 480px) {
            .welcome-content h1 {
                font-size: 1.4rem;
            }
            .login-heading h2 {
                font-size: 1.5rem;
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

        .back-to-home {
            position: absolute;
            top: 25px;
            left: 25px;
            z-index: 10;
        }

        .back-to-home a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--primary);
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 8px;
            transition: var(--transition);
            background-color: rgba(136, 0, 0, 0.1);
        }

        .back-to-home a:hover {
            background-color: rgba(136, 0, 0, 0.2);
            transform: translateY(-1px);
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
      <div class="floating-circle circle-13"></div>
      <div class="floating-circle circle-14"></div>
      <div class="floating-circle circle-16"></div>
      <div class="floating-circle circle-17"></div>
      <div class="floating-circle circle-18"></div>
      
      <div class="welcome-content">
        <h1>Academic Official Login</h1>

        <div class="illustration-container">
          <img src="../Images/ExcelLens.png" alt="Academic Administration Illustration" />
        </div>
        <div class="features-list">
          <div class="feature-item">
            <div class="feature-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
            </div>
            <span>Secure access to academic records</span>
          </div>
          <div class="feature-item">
            <div class="feature-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bar-chart-3"><path d="M3 3v18h18"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/></svg>
            </div>
            <span>Comprehensive analytics dashboard</span>
          </div>
          <div class="feature-item">
            <div class="feature-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <span>Student progress monitoring</span>
          </div>
        </div>
        <p>By logging in, you agree to ExcelLens's <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</p>
      </div>
    </div>

    <!-- Right panel - Login Form -->
    <div class="right-panel">
      <div class="back-to-home">
        <a href="login.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
          Back
        </a>
      </div>
      
      <div class="login-form">
        <div class="login-heading">
          <h2>Official Login</h2>
          <p>Sign in with your institutional credentials</p>
        </div>

        <form id="officialLoginForm">
  <div class="form-group">
    <label for="email">Username</label>
    <div class="input-group">
      <div class="input-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
      </div>
      <input type="text" id="username" name="username" placeholder="Your Username" required>

    </div>
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <div class="input-group">
      <div class="input-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
      </div>
      <input type="password" id="password" name="password" placeholder="Enter your password" required>
    </div>
  </div>

<!-- 🔗 Faculty request link -->
<div class="request-link" style="margin: 12px 0; text-align: center;">
    <a href="faculty_request_form.php" style="font-size: 0.9rem; color: gray; text-decoration: none;">
    If you are a faculty member and have not sent a request yet, 
    <span style="text-decoration: underline;">Register here</span>.
    </a>

</div>


  
  

  <button type="submit" class="submit-btn">
    Sign In
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
  </button>
</form>




      </div>

      <!-- Decorative shapes -->
      <div class="right-panel-shape">
        <svg class="shape-5" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
          <path fill="var(--primary)" d="M45.4,-45.2C57.6,-32.1,65.2,-16,65.1,0.1C65,16.2,57.1,32.4,44.9,43.6C32.7,54.8,16.4,61.1,-1.1,62.2C-18.5,63.3,-37,59.2,-49.1,48C-61.2,36.8,-66.9,18.5,-66.4,0.5C-65.9,-17.5,-59.2,-35,-47.1,-48.1C-35,-61.2,-17.5,-69.9,-0.1,-69.8C17.3,-69.7,34.6,-60.8,45.4,-45.2Z" transform="translate(100 100)"/>
        </svg>
        <svg class="shape-6" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
          <path fill="var(--primary)" d="M46.1,-46.1C59.5,-32.7,70.1,-16.3,70.3,0.3C70.5,16.9,60.2,33.8,46.8,47.3C33.4,60.8,16.7,70.9,0.1,70.8C-16.5,70.7,-33,60.4,-47.6,46.9C-62.2,33.4,-74.9,16.7,-74.9,0C-74.9,-16.7,-62.2,-33.4,-47.6,-46.8C-33,-60.3,-16.5,-70.5,0.1,-70.6C16.7,-70.7,33.4,-59.6,46.1,-46.1Z" transform="translate(100 100)"/>
        </svg>
      </div>
    </div>



    <!-- Message box for notifications -->
    <div class="message-box" id="messageBox"></div>
  </div>

  <script>
    // Initialize Lucide icons
    lucide.createIcons();
    



    // Form submission handling
    document.getElementById('officialLoginForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const messageBox = document.getElementById('messageBox');
      messageBox.textContent = 'Signing in...';
      messageBox.className = 'message-box info';
      messageBox.style.display = 'block';
      
      // Simulate login process
      setTimeout(() => {
        // In a real application, this would be an AJAX call to your backend
        messageBox.textContent = 'Login successful! Redirecting...';
        messageBox.className = 'message-box success';
        
        // Redirect to dashboard after a short delay
        setTimeout(() => {
          window.location.href = 'dashboard.php';
        }, 1500);
      }, 2000);
    });
    
    // Google Sign-In callback
    function handleCredentialResponse(response) {
      const messageBox = document.getElementById('messageBox');
      messageBox.textContent = 'Google authentication successful! Processing...';
      messageBox.className = 'message-box info';
      messageBox.style.display = 'block';
      
      // Here you would typically send the credential to your backend for verification
      console.log('Google ID token:', response.credential);
      
      setTimeout(() => {
        messageBox.textContent = 'Login successful! Redirecting...';
        messageBox.className = 'message-box success';
        
        // Redirect to dashboard after a short delay
        setTimeout(() => {
          window.location.href = 'dashboard.php';
        }, 1500);
      }, 2000);
    }
    
    // Display any error messages from URL parameters
    window.addEventListener('DOMContentLoaded', () => {
      const urlParams = new URLSearchParams(window.location.search);
      const error = urlParams.get('error');
      
      if (error) {
        const messageBox = document.getElementById('messageBox');
        messageBox.textContent = decodeURIComponent(error);
        messageBox.className = 'message-box error';
        messageBox.style.display = 'block';
        
        // Hide after 5 seconds
        setTimeout(() => {
          messageBox.style.display = 'none';
        }, 5000);
      }
    });

    document.getElementById('officialLoginForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const messageBox = document.getElementById('messageBox');
  messageBox.textContent = 'Signing in...';
  messageBox.className = 'message-box info';
  messageBox.style.display = 'block';

  const formData = new FormData(this); // ✅ THIS LINE IS ALREADY CORRECT

  fetch('process_acad_official_login.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    messageBox.textContent = data.message;
    if (data.success) {
      messageBox.className = 'message-box success';
      setTimeout(() => {
        window.location.href = data.redirect;
      }, 1500);
    } else {
      messageBox.className = 'message-box error';
      setTimeout(() => {
        messageBox.style.display = 'none';
      }, 5000);
    }
  })
  .catch(error => {
    console.error('Error:', error);
    messageBox.textContent = 'An error occurred. Please try again.';
    messageBox.className = 'message-box error';
    setTimeout(() => {
      messageBox.style.display = 'none';
    }, 5000);
  });
});


  </script>
</body>
</html>

