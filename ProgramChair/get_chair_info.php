<?php
session_start();
require_once '../db_connection.php'; // Update path if different

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT p.title, p.name, p.prog_id, pr.abbre
        FROM pchair p
        JOIN program pr ON p.prog_id = pr.progid
        WHERE p.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'No chairperson found']);
    exit;
}

$row = $result->fetch_assoc();

echo json_encode([
    'success' => true,
    'name' => $row['title'] . ' ' . $row['name'],
    'role' => 'Department Chairperson',
    'program' => $row['abbre'],
    'prog_id' => $row['prog_id'] // ✅ Add this line
]);
