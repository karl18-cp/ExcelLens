<?php
function handleProgramInsertAjax($conn) {
    $deptid = $_POST['deptid'];
    $progname = trim($_POST['progname']);
    $abbre = trim($_POST['abbre']);

    if (!empty($deptid) && !empty($progname) && !empty($abbre)) {
        $stmt = $conn->prepare("INSERT INTO program (progname, abbre, deptid) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $progname, $abbre, $deptid);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields.']);
    }

    exit();
}

function handleProgramUpdateAjax($conn) {
    $progid = $_POST['progid'];
    $progname = trim($_POST['progname']);
    $abbre = trim($_POST['abbre']);

    if (!empty($progid) && !empty($progname) && !empty($abbre)) {
        $stmt = $conn->prepare("UPDATE program SET progname = ?, abbre = ? WHERE progid = ?");
        $stmt->bind_param("ssi", $progname, $abbre, $progid);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing fields']);
    }

    exit();
}

function handleProgramDeleteAjax($conn) {
    $id = $_POST['id'];

    if (!empty($id)) {
        $stmt = $conn->prepare("DELETE FROM program WHERE progid = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing ID']);
    }

    exit();
}


function getAllPrograms($conn) {
    $sql = "SELECT p.progid AS id, p.progname, p.abbre, 
                   d.deptname AS college, 
                   c.camname AS campus
            FROM program p
            JOIN department d ON p.deptid = d.deptid
            JOIN campuses c ON d.camp_id = c.campus_id";

    $result = $conn->query($sql);
    $programs = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $programs[] = $row;
        }
    }

    return $programs;
}


?>