<?php
function handleCampusInsertAjax($conn) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_campus') {
        $name = trim($_POST['name']);
        $address = trim($_POST['address']);

        if (!empty($name) && !empty($address)) {
            $stmt = $conn->prepare("INSERT INTO campuses (camname, camadd) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $address);

            if ($stmt->execute()) {
                $id = $conn->insert_id;
                echo json_encode([
                    'status' => 'success',
                    'campus' => [
                        'id' => $id,
                        'name' => $name,
                        'address' => $address
                    ]
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        }

        exit(); // Stop further execution
    }
}
function handleCampusUpdateAjax($conn) {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);

    if (!empty($id) && !empty($name) && !empty($address)) {
        $stmt = $conn->prepare("UPDATE campuses SET camname = ?, camadd = ? WHERE campus_id = ?");
        $stmt->bind_param("ssi", $name, $address, $id);

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

function handleCampusDeleteAjax($conn) {
    $id = $_POST['id'];

    if (!empty($id)) {
        $stmt = $conn->prepare("DELETE FROM campuses WHERE campus_id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing campus ID.']);
    }

    exit();
}


function getAllCampuses($conn) {
    $sql = "SELECT campus_id, camname, camadd FROM campuses";
    $result = $conn->query($sql);

    $campuses = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $campuses[] = $row;
        }
    }
    return $campuses;
}

?>
