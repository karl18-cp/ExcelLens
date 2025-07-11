<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['email']) || !isset($data['full_name'])) {
        echo json_encode(['success' => false, 'message' => 'Missing credentials']);
        exit;
    }

    $_SESSION['email'] = $data['email'];
    $_SESSION['full_name'] = $data['full_name'];

    echo json_encode(['success' => true, 'redirect' => 'pending_access.php']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>ExcelLens - Login</title>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
        :root {
            --primary-red: #C62828;
            --primary-red-darker: #A91717;
            --text-dark: #424242;
            --text-medium: #757575;
            --text-light: #BDBDBD;
            --border-light: #E0E0E0;
            --background-soft: #FDFDFD;
            --background-panel: #FFFFFF;
            --font-family-main: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: var(--font-family-main);
        }

        body {
            background-color: var(--background-soft);
            color: var(--text-medium);
        }

        .container {
            display: flex;
            min-height: 100vh;
            flex-direction: row;
            perspective: 1000px;
            animation: fadeInSlide 1s ease-out;
        }

        .left-panel {
            flex: 1;
            background-color: var(--background-panel);
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            border-right: 1px solid var(--border-light);
        }

        .right-panel {
            flex: 1;
            padding: 60px 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: var(--background-soft);
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 40px;
            color: var(--text-dark);
            position: relative;
            z-index: 5;
        }

        .welcome-text h1 {
            font-size: 30px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .welcome-text p {
            font-size: 15px;
            line-height: 1.6;
        }

        .welcome-text a,
        .terms a {
            color: var(--primary-red);
            text-decoration: none;
            font-weight: 500;
        }

        .welcome-text a:hover,
        .terms a:hover {
            text-decoration: underline;
        }

        .illustration-container {
            width: 100%;
            max-width: 350px;
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2;
        }

        .illustration-container .excellens-logo {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .login-form {
            max-width: 450px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            height: 80px;
        }

        .login-heading {
            margin-bottom: 30px;
            text-align: center;
        }

        .login-heading h2 {
            font-size: 26px;
            color: var(--text-dark);
            margin-bottom: 8px;
            font-weight: 600;
        }

        .login-heading p {
            color: var(--text-medium);
            font-size: 15px;
        }

        .user-type {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .user-option {
            flex: 1;
            padding: 15px;
            border: 1px solid var(--border-light);
            border-radius: 8px;
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-right: 10px;
            background-color: var(--background-panel);
            transition: all 0.3s ease;
        }

        .user-option:last-child {
            margin-right: 0;
        }

        .user-option.active {
            border-color: var(--primary-red);
            box-shadow: 0 0 0 2px rgba(198, 40, 40, 0.2);
        }

        .user-option.active .icon svg path {
            fill: var(--primary-red);
        }

        .user-option input[type="radio"] {
            margin-right: 12px;
            accent-color: var(--primary-red);
        }

        .user-option span {
            color: var(--text-dark);
            font-weight: 500;
        }

        .user-option .icon {
            margin-left: auto;
        }

        .user-option .icon svg path {
            fill: var(--text-medium);
            transition: fill 0.3s ease;
        }

        .user-option:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .user-option:hover .icon svg path {
            fill: var(--primary-red);
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            color: var(--text-light);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .divider::before, .divider::after {
            content: '';
            display: inline-block;
            width: 30%;
            height: 1px;
            background-color: var(--border-light);
            vertical-align: middle;
            margin: 0 10px;
        }

        .email-input-group {
            position: relative;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }

        .email-input-group .email-input {
            flex: 1;
            padding: 14px;
            border: 1px solid var(--border-light);
            border-radius: 8px 0 0 8px;
            border-right: none;
            outline: none;
            font-size: 15px;
            color: var(--text-dark);
        }

        .email-input-group .email-input:focus {
            border-color: var(--primary-red);
            box-shadow: 0 0 0 2px rgba(198, 40, 40, 0.2);
        }

        .email-input-group .email-input::placeholder {
            color: var(--text-light);
        }

        .email-input-group .email-suffix {
            padding: 14px;
            background-color: #F0F0F0;
            border: 1px solid var(--border-light);
            border-left: none;
            border-radius: 0 8px 8px 0;
            color: var(--text-medium);
            font-size: 15px;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background-color: var(--primary-red);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .submit-btn:hover {
            background-color: var(--primary-red-darker);
            transform: scale(1.01);
        }

        .submit-btn:active {
            transform: scale(0.99);
        }

        .terms {
            margin-top: 25px;
            text-align: center;
            color: var(--text-medium);
            font-size: 13px;
            line-height: 1.5;
        }

        .terms input[type="checkbox"] {
            margin-right: 8px;
            vertical-align: middle;
            accent-color: var(--primary-red);
        }

        .background-shape {
            position: absolute;
            background-color: var(--primary-red);
            opacity: 0.08;
            z-index: 1;
            animation: float 6s ease-in-out infinite alternate;
            border-radius: 50%;
        }

        .shape-1 {
            width: 200px;
            height: 200px;
            top: -50px;
            left: -50px;
        }

        .shape-2 {
            width: 300px;
            height: 300px;
            bottom: -100px;
            right: -100px;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            bottom: 50px;
            left: 50px;
            animation-delay: 1s;
        }

        .shape-4 {
            width: 250px;
            height: 250px;
            top: -100px;
            right: -50px;
            animation-delay: 2s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes fadeInSlide {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .left-panel {
                display: none;
            }

            .right-panel {
                padding: 30px 20px;
                flex-grow: 1;
            }

            .login-form {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
  <div class="container">
    <!-- Left panel -->
    <div class="left-panel">
      <div class="welcome-text">
        <h1>Welcome to ExcelLens!</h1>
        <p>By logging in, you agree to ExcelLens's <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</p>
      </div>
      <div class="illustration-container">
        <img src="../Images/Excel.png" alt="ExcelLens Logo" class="excellens-logo" />
      </div>
      <div class="background-shape shape-1"></div>
      <div class="background-shape shape-2"></div>
      <div class="background-shape shape-3"></div>
      <div class="background-shape shape-4"></div>
    </div>

    <!-- Right panel -->
    <div class="right-panel">
      
        <div class="logo-container"></div>
        <div class="login-heading">
          <h2>Login</h2>
          <p>Welcome back! Sign in as:</p>
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
            data-logo_alignment="left"></div>

       

      

        <button class="submit-btn">Continue</button>

        <div class="terms">
          <label>
            <input type="checkbox" /> I Acknowledge <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>
          </label>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.querySelectorAll('.user-option').forEach(option => {
      option.addEventListener('click', function () {
        document.querySelectorAll('.user-option').forEach(el => el.classList.remove('active'));
        this.classList.add('active');
        this.querySelector('input').checked = true;
        document.querySelectorAll('.user-option .icon svg path').forEach(path => {
          path.style.fill = 'var(--text-medium)';
        });
        this.querySelector('.icon svg path').style.fill = 'var(--primary-red)';
      });
    });

    function handleCredentialResponse(response) {
  const payload = JSON.parse(atob(response.credential.split('.')[1]));
  const email = payload.email;
  const full_name = payload.name;

  if (email.includes('@g.batstate-u.edu.ph')) {
    fetch('login.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ email, full_name })
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        window.location.href = data.redirect;
      } else {
        alert(data.message);
      }
    });
  } else {
    alert("Unauthorized email domain.");
  }
}

    document.querySelector('.user-option.active .icon svg path').style.fill = 'var(--primary-red)';
  </script>
</body>
</html>
