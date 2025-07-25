<?php
function handleCollegeInsertAjax($conn) {
    $campusID = $_POST['camp_id'];
    $deptname = trim($_POST['deptname']);
    $deptnick = trim($_POST['deptnick']);

    if (!empty($campusID) && !empty($deptname) && !empty($deptnick)) {
        $stmt = $conn->prepare("INSERT INTO department (deptname, deptnick, camp_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $deptname, $deptnick, $campusID);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Please fill in all fields.']);
    }

    exit();
}
function handleCollegeUpdateAjax($conn) {
    $id = $_POST['id'];
    $camp_id = $_POST['camp_id'];
    $deptname = trim($_POST['deptname']);
    $deptnick = trim($_POST['deptnick']);

    if (!empty($id) && !empty($camp_id) && !empty($deptname) && !empty($deptnick)) {
        $stmt = $conn->prepare("UPDATE department SET deptname = ?, deptnick = ?, camp_id = ? WHERE deptid = ?");
        $stmt->bind_param("ssii", $deptname, $deptnick, $camp_id, $id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
    }

    exit();
}

function handleCollegeDeleteAjax($conn) {
    $id = $_POST['id'];

    if (!empty($id)) {
        $stmt = $conn->prepare("DELETE FROM department WHERE deptid = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing college ID.']);
    }

    exit();
}

function getAllColleges($conn) {
    $sql = "SELECT d.deptid AS id, d.deptname AS name, d.deptnick AS code, c.camname AS campus
            FROM department d
            JOIN campuses c ON d.camp_id = c.campus_id";
    $result = $conn->query($sql);

    $colleges = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $colleges[] = $row;
        }
    }
    return $colleges;
}
function getAllCollegesRaw($conn) {
    $sql = "SELECT deptid, deptname, deptnick, camp_id FROM department";
    $result = $conn->query($sql);
    $colleges = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $colleges[] = $row;
        }
    }
    return $colleges;
}


?>