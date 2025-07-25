<?php
require_once '../db_connection.php'; // adjust path if needed

$pendingMessage = '';
$emailFromGoogle = $_GET['email'] ?? ''; // optional: sent as query param if needed

if (!empty($emailFromGoogle)) {
    $stmt = $conn->prepare("SELECT * FROM pending_accounts WHERE email = ?");
    $stmt->bind_param("s", $emailFromGoogle);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $pendingMessage = "✅ You have already submitted a faculty request. Please wait for approval.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Faculty Registration Request</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://accounts.google.com/gsi/client" async defer></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f8f0f0;
      padding: 40px;
    }

    .form-container {
      background: white;
      padding: 30px;
      max-width: 600px;
      margin: auto;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #880000;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
      margin-bottom: 8px;
      display: block;
    }

    select {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }

    button {
      width: 100%;
      background: #880000;
      color: white;
      padding: 12px;
      border: none;
      font-weight: bold;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
    }

    button:hover {
      background: #550000;
    }

    .g_id_signin, #g_id_onload {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }

    .hidden {
      display: none;
    }

    .info-box {
      background: #eef;
      padding: 12px;
      margin-bottom: 20px;
      border-left: 5px solid #3366cc;
      font-size: 0.95rem;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Faculty Registration</h2>
    <?php if ($pendingMessage): ?>
  <div class="info-box" style="background: #e0ffe0; border-left-color: green; color: #333;">
    <?= $pendingMessage ?>
  </div>
<?php endif; ?>


    <div class="info-box">
      Please sign in using your BatState-U institutional Google account to auto-fill your name and email.
    </div>

    <!-- Google Sign-In -->
  <div id="g_id_onload"
     data-client_id="511673515215-286ppb5ta5vah0q1e934oispeec84euq.apps.googleusercontent.com"

         data-context="signin"
         data-ux_mode="popup"
         data-callback="handleGoogleResponse"
         data-auto_prompt="false">
    </div>
    <div class="g_id_signin"
         data-type="standard"
         data-shape="pill"
         data-theme="outline"
         data-text="continue_with"
         data-size="large"
         data-logo_alignment="left">
    </div>

    <!-- Form -->
    <?php if (!$pendingMessage): ?>
  <form id="facultyRequestForm" class="hidden" method="POST" action="process_faculty_request.php">
      <input type="hidden" name="email" id="email">
      <input type="hidden" name="full_name" id="full_name">

      <div class="form-group">
  <label for="campus">Campus</label>
  <select name="campus" id="campus" required>
    <option value="">Select Campus</option>
  </select>
</div>

<div class="form-group">
  <label for="college">College</label>
  <select name="college" id="college" required>
    <option value="">Select College</option>
  </select>
</div>

<div class="form-group">
  <label for="program">Program</label>
  <select name="program" id="program" required>
    <option value="">Select Program</option>
  </select>
</div>

      <button type="submit">Send Request</button>
    </form>
<?php endif; ?>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
    fetch('load_options.php?type=campuses')
      .then(res => res.json())
      .then(data => {
        const campusSelect = document.getElementById('campus');
        data.forEach(campus => {
          const opt = document.createElement('option');
          opt.value = campus.id;
          opt.textContent = campus.name;
          campusSelect.appendChild(opt);
        });
      });
  });

  // Load departments when campus changes
  document.getElementById('campus').addEventListener('change', function () {
    const campusId = this.value;
    const collegeSelect = document.getElementById('college');
    const programSelect = document.getElementById('program');

    collegeSelect.innerHTML = '<option value="">Select College</option>';
    programSelect.innerHTML = '<option value="">Select Program</option>';

    if (campusId) {
      fetch(`load_options.php?type=departments&parent_id=${campusId}`)
        .then(res => res.json())
        .then(data => {
          data.forEach(college => {
            const opt = document.createElement('option');
            opt.value = college.id;
            opt.textContent = college.name;
            collegeSelect.appendChild(opt);
          });
        });
    }
  });

  // Load programs when college changes
  document.getElementById('college').addEventListener('change', function () {
    const collegeId = this.value;
    const programSelect = document.getElementById('program');
    programSelect.innerHTML = '<option value="">Select Program</option>';

    if (collegeId) {
      fetch(`load_options.php?type=programs&parent_id=${collegeId}`)
        .then(res => res.json())
        .then(data => {
          data.forEach(program => {
            const opt = document.createElement('option');
            opt.value = program.id;
            opt.textContent = program.name;
            programSelect.appendChild(opt);
          });
        });
    }
  });

    function handleGoogleResponse(response) {
      const data = parseJwt(response.credential);
      const email = data.email;
      const name = data.name;

            if (
        !email.endsWith("@batstate-u.edu.ph") &&
        !email.endsWith("@g.batstate-u.edu.ph")
        ) {
        alert("Please use your BatStateU institutional email.");
        return;
        }

 
      document.getElementById("email").value = email;
      document.getElementById("full_name").value = name;

      document.getElementById("facultyRequestForm").classList.remove("hidden");
    }

    function parseJwt(token) {
      const base64Url = token.split('.')[1];
      const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
      const jsonPayload = decodeURIComponent(window.atob(base64).split('').map(c =>
        '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2)
      ).join(''));

      return JSON.parse(jsonPayload);
    }
  </script>
</body>
</html>
