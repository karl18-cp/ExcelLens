<?php
require_once '../db_connection.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['deptid'] ?? '';

    if (!empty($id)) {
        $stmt = $conn->prepare("DELETE FROM department WHERE deptid = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "error" => "Invalid ID"]);
    }
}
?>
