<?php
require_once '../db_connection.php';

$type = $_GET['type'] ?? '';
$parent_id = $_GET['parent_id'] ?? '';

header('Content-Type: application/json');

switch ($type) {
    case 'campuses':
        $query = "SELECT campus_id, camname FROM campuses";
        $result = $conn->query($query);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = ['id' => $row['campus_id'], 'name' => $row['camname']];
        }
        echo json_encode($data);
        break;

    case 'departments':
        $stmt = $conn->prepare("SELECT deptid, deptname FROM department WHERE camp_id = ?");
        $stmt->bind_param("i", $parent_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = ['id' => $row['deptid'], 'name' => $row['deptname']];
        }
        echo json_encode($data);
        break;

    case 'programs':
        $stmt = $conn->prepare("SELECT progid, progname FROM program WHERE deptid = ?");
        $stmt->bind_param("i", $parent_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = ['id' => $row['progid'], 'name' => $row['progname']];
        }
        echo json_encode($data);
        break;

    default:
        echo json_encode([]);
}
