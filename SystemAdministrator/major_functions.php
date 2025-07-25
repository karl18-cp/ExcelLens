<?php
function handleMajorInsertAjax($conn) {
    $programid = $_POST['programid'] ?? null;
    $trackname = trim($_POST['trackname'] ?? '');
    $abbrev = trim($_POST['abbrev'] ?? '');

    if (!empty($programid) && !empty($trackname) && !empty($abbrev)) {
        $stmt = $conn->prepare("INSERT INTO track (trackname, abbrev, programid) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $trackname, $abbrev, $programid);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing fields.']);
    }
    exit();
}

function handleMajorUpdate($conn) {
    $id = $_POST['id'] ?? null;
    $trackname = trim($_POST['trackname'] ?? '');
    $abbrev = trim($_POST['abbrev'] ?? '');

    if ($id && $trackname && $abbrev) {
        $stmt = $conn->prepare("UPDATE track SET trackname = ?, abbrev = ? WHERE track_id = ?");
        $stmt->bind_param("ssi", $trackname, $abbrev, $id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing fields.']);
    }

    exit();
}

function handleMajorDelete($conn) {
    $id = $_POST['id'] ?? null;

    if ($id) {
        $stmt = $conn->prepare("DELETE FROM track WHERE track_id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid ID.']);
    }

    exit();
}


function getAllMajors($conn) {
    $sql = "SELECT t.track_id AS id, t.trackname, t.abbrev,
                   p.progname AS program,
                   d.deptname AS college
            FROM track t
            JOIN program p ON t.programid = p.progid
            JOIN department d ON p.deptid = d.deptid";

    $result = $conn->query($sql);
    $majors = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $majors[] = $row;
        }
    }

    return $majors;
}

?>