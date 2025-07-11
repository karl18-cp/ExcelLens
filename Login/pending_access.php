<?php
require_once '../db_connection.php';
session_start();

// Handle "Send Request" form submission via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($_SESSION['email']) || !isset($_SESSION['full_name'])) {
        echo json_encode(['success' => false, 'message' => 'Session expired. Please log in again.']);
        exit;
    }

    if (!isset($data['role']) || empty($data['role'])) {
        echo json_encode(['success' => false, 'message' => 'Role not selected.']);
        exit;
    }

    $email = $_SESSION['email'];
    $full_name = $_SESSION['full_name'];
    $role = $data['role'];
    $is_approved = 'Pending';
    $status = 'Pending';
    $date_requested = date('Y-m-d H:i:s');

    // Prevent duplicates
    $check = $conn->prepare("SELECT id FROM pending_accounts WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Already submitted.']);
        exit;
    }

    $check->close();

    // Insert
    $insert = $conn->prepare("INSERT INTO pending_accounts (full_name, email, role, date_requested, is_approved) VALUES (?, ?, ?, ?, ?)");
$insert->bind_param("sssss", $full_name, $email, $role, $date_requested, $is_approved);


    if ($insert->execute()) {
        echo json_encode(['success' => true, 'message' => 'Request submitted.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Insert failed.']);
    }

    $insert->close();
    $conn->close();
    exit;
}
?>


<!-- HTML UI for pending_access.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Access Pending - ExcelLens</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    :root {
      --primary: #c62828;
      --green: #388e3c;
      --green-hover: #2e7d32;
      --light-bg: #fdfdfd;
      --text-dark: #333;
      --text-light: #777;
      --card-bg: #fff;
      --border: #e0e0e0;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--light-bg);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: var(--text-dark);
    }

    .card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 40px;
      max-width: 500px;
      width: 100%;
      text-align: center;
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
      animation: fadeIn 0.6s ease-in-out;
    }

    h1 {
      color: var(--primary);
      margin-bottom: 15px;
    }

    p {
      color: var(--text-light);
      margin-bottom: 25px;
      line-height: 1.5;
    }

    .form-group {
      margin-bottom: 20px;
      text-align: left;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 500;
    }

    select {
      width: 100%;
      padding: 12px;
      border: 1px solid var(--border);
      border-radius: 6px;
      font-size: 15px;
      background-color: #fff;
      color: var(--text-dark);
    }

    .btn {
      padding: 12px 20px;
      color: white;
      border: none;
      border-radius: 6px;
      text-decoration: none;
      font-size: 15px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .btn-green {
      background-color: var(--green);
    }
    .btn-green:hover {
      background-color: var(--green-hover);
    }

    .btn-red {
      background-color: var(--primary);
      margin-top: 10px;
      display: inline-block;
    }
    .btn-red:hover {
      background-color: #a91e1e;
    }

    .success-message {
      display: none;
      margin-top: 15px;
      color: green;
      font-size: 14px;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 500px) {
      .card {
        margin: 0 15px;
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>
  <div class="card">
    <h1>Access Pending</h1>
    <p>Your account is currently pending approval. You may request access by selecting an approver below.</p>

    <form id="accessRequestForm" onsubmit="handleRequest(event)">
      <div class="form-group">
        <label for="requestTo">Request access from:</label>
        <select id="requestTo" name="requestTo" required>
          <option value="">-- Select Role --</option>
          <option value="Faculty Member">Faculty Member</option>
          <option value="Department/Program Chairperson">Department/Program Chairperson</option>
          <option value="College Dean">College Dean</option>
        </select>
      </div>

      <button type="submit" class="btn btn-green">Send Request</button>
      <p class="success-message" id="successMsg">✅ Your request has been submitted!</p>
    </form>

    <a href="login.php" class="btn btn-red">Back to Login</a>
  </div>

  <script>
    function handleRequest(e) {
      e.preventDefault();
      const selectedRole = document.getElementById('requestTo').value;

      fetch('pending_access.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ role: selectedRole })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          document.getElementById('successMsg').style.display = 'block';
        } else {
          alert(data.message || 'Something went wrong.');
        }
      });
    }
  </script>
</body>
</html>
