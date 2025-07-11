<?php
require_once '../db_connection.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['deptid'] ?? '';
    $name = $_POST['deptname'] ?? '';
    $nick = $_POST['deptnick'] ?? '';

    if (!empty($id) && !empty($name) && !empty($nick)) {
        $stmt = $conn->prepare("UPDATE department SET deptname = ?, deptnick = ? WHERE deptid = ?");
        $stmt->bind_param("ssi", $name, $nick, $id);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "error" => "Missing input"]);
    }
}
?>
