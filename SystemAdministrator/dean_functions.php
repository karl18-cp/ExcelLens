<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // 

function handleInsertDean($conn) {
    $title = $_POST['title'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $dept_id = $_POST['dept_id'] ?? '';

    if (!$title || !$name || !$email || !$username || !$password || !$dept_id) {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields.']);
        return;
    }

    $role = "College Dean";
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // Step 1: Insert into user_accounts
    $stmt = $conn->prepare("INSERT INTO user_accounts (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed, $role);
    if (!$stmt->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to create user account.']);
        return;
    }
    $user_id = $conn->insert_id;

    // Step 2: Insert into deans
    $stmt2 = $conn->prepare("INSERT INTO deans (user_id, title, name, email, dept_id) VALUES (?, ?, ?, ?, ?)");
    $stmt2->bind_param("isssi", $user_id, $title, $name, $email, $dept_id);
    if (!$stmt2->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Dean insert failed: ' . $stmt2->error]);
        return;
    }

    // Step 3: Send Email with PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'excellens.system@gmail.com';
        $mail->Password   = 'ktne wmba xjjx vmqw'; // 🔴 App password only
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('excellens.system@gmail.com', 'ExcelLens Admin');
        $mail->addAddress($email, "{$title} {$name}");

        $mail->isHTML(true);
        $mail->Subject = 'Your ExcelLens System Account';
        $mail->Body = "
            <p>Dear {$title} {$name},</p>
            <p>You have been appointed as the <strong>College Dean</strong> in the ExcelLens system.</p>
            <p><strong>Here are your account credentials:</strong></p>
            <ul>
                <li><strong>Role:</strong> {$role}</li>
                <li><strong>Username:</strong> {$username}</li>
                <li><strong>Password:</strong> {$password}</li>
            </ul>
            <p>Please keep these credentials confidential and log in to the system at your earliest convenience.</p>
            <p>Best regards,<br>ExcelLens Administration</p>
        ";

        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Dean account created and credentials sent via email.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'warning', 'message' => 'Account created, but email failed: ' . $mail->ErrorInfo]);
    }
}

function getAllDeans($conn) {
    $sql = "
        SELECT d.dean_id, d.title, d.name, d.email, d.dept_id, dept.deptname 
        FROM deans d
        JOIN department dept ON d.dept_id = dept.deptid
    ";
    $result = $conn->query($sql);

    $deans = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $deans[] = [
                'id' => $row['dean_id'],
                'title' => $row['title'],
                'name' => $row['name'],
                'email' => $row['email'],
                'dept_id' => $row['dept_id'],
                'deptname' => $row['deptname']
            ];
        }
    }

    return $deans;
}

function handleUpdateDean($conn) {
    $id = $_POST['dean_id'] ?? '';
    $title = $_POST['title'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $dept_id = $_POST['dept_id'] ?? '';

    if (!$id || !$title || !$name || !$email || !$dept_id) {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields.']);
        return;
    }

    $stmt = $conn->prepare("UPDATE deans SET title = ?, name = ?, email = ?, dept_id = ? WHERE dean_id = ?");
    $stmt->bind_param("sssii", $title, $name, $email, $dept_id, $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Dean record updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update dean: ' . $stmt->error]);
    }
}

function handleDeleteDean($conn) {
    $id = $_POST['dean_id'] ?? '';

    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'Missing Dean ID.']);
        return;
    }

    // Step 1: Delete from user_accounts (deans will be deleted via ON DELETE CASCADE)
    $stmt = $conn->prepare("DELETE FROM user_accounts WHERE user_id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Dean account deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete dean: ' . $stmt->error]);
    }
}

function handleUpdateChair($conn) {
    $id = $_POST['chair_id'] ?? '';
    $title = $_POST['title'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';

    if (!$id || !$title || !$name || !$email) {
        echo json_encode(['status' => 'error', 'message' => 'Incomplete data.']);
        return;
    }

    $stmt = $conn->prepare("UPDATE pchair SET title = ?, name = ?, email = ? WHERE user_id = ?");
    $stmt->bind_param("sssi", $title, $name, $email, $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Chairperson updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Update failed: ' . $stmt->error]);
    }
}

function handleDeleteChair($conn) {
    $id = $_POST['chair_id'] ?? '';

    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'Missing Chair ID.']);
        return;
    }

    // Step 1: Delete from user_accounts; pchair will be auto-deleted via ON DELETE CASCADE
    $stmt = $conn->prepare("DELETE FROM user_accounts WHERE user_id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Chairperson account deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete Chairperson account: ' . $stmt->error]);
    }
}

?>


