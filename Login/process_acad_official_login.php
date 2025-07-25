<?php
session_start();
require_once '../db_connection.php';

header('Content-Type: application/json');

// Step 1: Check request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Step 2: Get and sanitize input
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all fields']);
    exit;
}

// Step 3: Query the database
$stmt = $conn->prepare("SELECT user_id, username, password, role FROM user_accounts WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'User not found']);
    exit;
}

$user = $result->fetch_assoc();

// Step 4: Verify hashed password
if (!password_verify($password, $user['password'])) {
    echo json_encode(['success' => false, 'message' => 'Incorrect password']);
    exit;
}

// Step 5: Store session info
$_SESSION['user_id'] = $user['user_id'];
$_SESSION['username'] = $user['username'];
$_SESSION['role'] = $user['role'];

// Step 6: Determine redirect based on role
switch ($user['role']) {
    case 'VCAA':
        $redirectPath = '../VCAAPortal.php';
        break;
    case 'College Dean':
        $redirectPath = '../DeanPortal.php';
        break;
    case 'Chairperson':
        $redirectPath = '../ProgramChair/chairperson_portal.php';
        break;
    case 'Admin':
        $redirectPath = '../SystemAdministrator/admin_portal.php';
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Unauthorized role']);
        exit;
}

// Step 7: Success
echo json_encode([
    'success' => true,
    'message' => 'Login successful',
    'redirect' => $redirectPath
]);
?>
