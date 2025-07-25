<?php
require_once '../db_connection.php'; // adjust path if needed
date_default_timezone_set('Asia/Manila');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $campus_id = (int) $_POST['campus'];
    $college_id = (int) $_POST['college'];
    $program_id = (int) $_POST['program'];


    // Step 1: Check for existing pending request
    $checkStmt = $conn->prepare("SELECT * FROM pending_accounts WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $existing = $checkStmt->get_result();

    if ($existing->num_rows > 0) {
        echo "<script>alert('You already submitted a request. Please wait for review.'); window.history.back();</script>";
        exit;
    }


    // Step 5: Insert the request
    $insert = $conn->prepare("INSERT INTO pending_accounts (full_name, email, campus, college, program, date_requested, is_approved) VALUES (?, ?, ?, ?, ?, CURDATE(), 'Pending')");
    $insert->bind_param("ssiii", $full_name, $email, $campus_id, $college_id, $program_id);

    if ($insert->execute()) {
        echo "<script>alert('Your registration request has been submitted. Please wait for review.'); window.location.href = 'faculty_request_form.php';</script>";
    } else {
        echo "<script>alert('Error submitting request. Please try again.'); window.history.back();</script>";
    }
}
?>
