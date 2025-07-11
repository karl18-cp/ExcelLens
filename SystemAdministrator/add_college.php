<?php
require_once '../db_connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['deptname'] ?? '';
    $nick = $_POST['deptnick'] ?? '';

    if (!empty($name) && !empty($nick)) {
        $stmt = $conn->prepare("INSERT INTO department (deptname, deptnick) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $nick);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Missing fields']);
    }
}
?>
