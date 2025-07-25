<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Adjust path if needed

function handleInsertVCAA($conn) {
    $title = $_POST['title'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $campus_id = $_POST['campus_id'] ?? '';

    $role = "VCAA";
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // Step 1: Insert into user_accounts
    $stmt1 = $conn->prepare("INSERT INTO user_accounts (username, password, role) VALUES (?, ?, ?)");
    $stmt1->bind_param("sss", $username, $hashed, $role);

    if (!$stmt1->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to create user account.']);
        return;
    }

    $user_id = $conn->insert_id;

    // Step 2: Insert into vcaa table
    $stmt2 = $conn->prepare("INSERT INTO vcaa (user_id, title, name, email, campusid) VALUES (?, ?, ?, ?, ?)");
    $stmt2->bind_param("isssi", $user_id, $title, $name, $email, $campus_id);

    if (!$stmt2->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'User created but failed to insert into VCAA table.']);
        return;
    }

    // Step 3: Send Email with PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'excellens.system@gmail.com'; // 🔴 Replace with your Gmail
        $mail->Password   = 'ktne wmba xjjx vmqw';      // 🔴 App Password only
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('excellens.system@gmail.com', 'ExcelLens Admin');
        $mail->addAddress($email, "{$title} {$name}");

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Your ExcelLens System Account';
        $mail->Body = "
            <p>Dear {$title} {$name},</p>
            <p>You have been appointed as the <strong>Vice Chancellor for Academic Affairs (VCAA)</strong> in the ExcelLens system.</p>
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
        echo json_encode(['status' => 'success', 'message' => 'VCAA account created and credentials sent via email.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'warning', 'message' => 'Account created, but email failed: ' . $mail->ErrorInfo]);
    }
}

function getAllVCAA($conn) {
    $sql = "SELECT user_id, title, name, email, campusid FROM vcaa";
    $result = $conn->query($sql);

    $vcaaList = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $vcaaList[] = [
                'id' => $row['user_id'], // alias to 'id' so frontend doesn't break
                'title' => $row['title'],
                'name' => $row['name'],
                'email' => $row['email'],
                'campusid' => $row['campusid']
            ];
        }
    }

    return $vcaaList;
}



function handleUpdateVCAA($conn) {
    $id = $_POST['vcaa_id'] ?? '';
    $title = $_POST['title'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';

    if (!$id || !$title || !$name || !$email) {
        echo json_encode(['status' => 'error', 'message' => 'Incomplete data.']);
        return;
    }

    $stmt = $conn->prepare("UPDATE vcaa SET title = ?, name = ?, email = ? WHERE user_id = ?");

    $stmt->bind_param("sssi", $title, $name, $email, $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'VCAA record updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update VCAA record.']);
    }
}

function handleDeleteVCAA($conn) {
    $id = $_POST['vcaa_id'] ?? '';

    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'Missing VCAA ID.']);
        return;
    }

    // ✅ Step 1: Delete from user_accounts first
    $stmt = $conn->prepare("DELETE FROM user_accounts WHERE user_id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // vcaa is automatically deleted via ON DELETE CASCADE
        echo json_encode(['status' => 'success', 'message' => 'VCAA account deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete user account: ' . $stmt->error]);
    }
}


?>