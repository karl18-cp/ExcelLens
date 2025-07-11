<?php
require_once '../db_connection.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $progname = $_POST['progname'] ?? '';
    $progyear = $_POST['progyear'] ?? '';
    $deptid = $_POST['deptid'] ?? '';

    if (!empty($progname) && !empty($progyear) && !empty($deptid)) {
        $stmt = $conn->prepare("INSERT INTO program (progname, progyear, deptid) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $progname, $progyear, $deptid);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "error" => "Missing input values"]);
    }
}
?>
