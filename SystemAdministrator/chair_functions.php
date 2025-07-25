<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Make sure PHPMailer is autoloaded

function handleInsertChair($conn) {
    $title = $_POST['title'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $prog_id = $_POST['prog_id'] ?? '';

    if (!$title || !$name || !$email || !$username || !$password || !$prog_id) {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields.']);
        return;
    }

    $role = "Chairperson";
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // Step 1: Insert into user_accounts
    $stmt = $conn->prepare("INSERT INTO user_accounts (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed, $role);
    if (!$stmt->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to create user account.']);
        return;
    }
    $user_id = $conn->insert_id;

    // Step 2: Insert into pchair
    $stmt2 = $conn->prepare("INSERT INTO pchair (user_id, title, name, email, prog_id) VALUES (?, ?, ?, ?, ?)");
    $stmt2->bind_param("isssi", $user_id, $title, $name, $email, $prog_id);
    if (!$stmt2->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Chair insert failed: ' . $stmt2->error]);
        return;
    }

    // Step 3: Send Email with PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'excellens.system@gmail.com'; // your Gmail
        $mail->Password   = 'ktne wmba xjjx vmqw';        // app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('excellens.system@gmail.com', 'ExcelLens Admin');
        $mail->addAddress($email, "{$title} {$name}");

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your ExcelLens System Account';
        $mail->Body = "
            <p>Dear {$title} {$name},</p>
            <p>You have been appointed as the <strong>Department Chairperson</strong> in the ExcelLens system.</p>
            <p><strong>Here are your account credentials:</strong></p>
            <ul>
                <li><strong>Role:</strong> Chairperson</li>
                <li><strong>Username:</strong> {$username}</li>
                <li><strong>Password:</strong> {$password}</li>
            </ul>
            <p>Please keep these credentials confidential and log in to the system at your earliest convenience.</p>
            <p>Best regards,<br>ExcelLens Administration</p>
        ";

        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Chairperson account created and credentials sent via email.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'warning', 'message' => 'Chairperson created, but email failed: ' . $mail->ErrorInfo]);
    }
}

function getAllChairs($conn) {
    $sql = "SELECT 
                pchair.user_id AS id,
                pchair.title,
                pchair.name,
                pchair.email,
                pchair.prog_id,
                program.progname
            FROM pchair
            JOIN program ON pchair.prog_id = program.progid";
    
    $result = $conn->query($sql);
    $chairs = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $chairs[] = $row;
        }
    }

    return $chairs;
}

?>
