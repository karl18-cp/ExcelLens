<?php
require_once __DIR__ . '/../vendor/autoload.php';

require_once '../db_connection.php'; // ⚠️ Adjust this to your DB connection file

use Smalot\PdfParser\Parser;

header('Content-Type: application/json');

if (!isset($_FILES['pdf'])) {
    echo json_encode(['success' => false, 'message' => 'No file uploaded']);
    exit;
}

$parser = new Parser();
$pdf = $parser->parseFile($_FILES['pdf']['tmp_name']);
$text = $pdf->getText();

// Extract static info
$department = '';
$program = '';
$section = '';
$courseCode = '';

if (preg_match('/College of (.+)/i', $text, $match)) {
    $department = 'College of ' . trim($match[1]);
}
if (preg_match('/Bachelor of Science in [^\n]+/i', $text, $match)) {
    $program = trim($match[0]);
}
if (preg_match('/Section:\s*([A-Z\-0-9 ]+)/i', $text, $match)) {
    $section = trim($match[1]);
}
if (preg_match('/Course:\s*([A-Z]{2,4} \d{3})/i', $text, $match)) {
    $courseCode = trim($match[1]);
}

// Get department ID
$stmt = $conn->prepare("SELECT deptid FROM department WHERE deptname = ?");
$stmt->bind_param("s", $department);
$stmt->execute();
$result = $stmt->get_result();
if (!$result->num_rows) {
    echo json_encode(['success' => false, 'message' => "Department not found: $department"]);
    exit;
}
$deptID = $result->fetch_assoc()['deptid'];

// Get program ID
$stmt = $conn->prepare("SELECT progid FROM program WHERE progname = ? AND deptid = ?");
$stmt->bind_param("si", $program, $deptID);
$stmt->execute();
$result = $stmt->get_result();
if (!$result->num_rows) {
    echo json_encode(['success' => false, 'message' => "Program not found: $program"]);
    exit;
}
$progID = $result->fetch_assoc()['progid'];

// Get course ID
$stmt = $conn->prepare("SELECT course_id FROM courses WHERE ccode = ?");
$stmt->bind_param("s", $courseCode);
$stmt->execute();
$result = $stmt->get_result();
if (!$result->num_rows) {
    echo json_encode(['success' => false, 'message' => "Course not found: $courseCode"]);
    exit;
}
$courseID = $result->fetch_assoc()['course_id'];

// Extract student lines
preg_match_all('/\d+\s+([A-Z][a-z]+(?:\s[A-Z][a-z]+)*),\s+([A-Z][a-z]+),\s+([A-Z])\.\s+(\d{2}-\d{5})/', $text, $matches, PREG_SET_ORDER);

$inserted = 0;

foreach ($matches as $match) {
    $last = trim($match[1]);
    $first = trim($match[2]);
    $middle = trim($match[3]);
    $srCode = trim($match[4]);
    $email = $srCode . '@g.batstate-u.edu.ph';

    // Insert into students
    $stmt = $conn->prepare("INSERT INTO students (firstname, lastname, Midde, srcode, email, depart_id, program_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssii", $first, $last, $middle, $srCode, $email, $deptID, $progID);
    $stmt->execute();
    $studID = $conn->insert_id;

    // Insert into studentsection
    $stmt = $conn->prepare("INSERT INTO studentsection (stud_id, cour_id, section) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $studID, $courseID, $section);
    $stmt->execute();

    $inserted++;
}

echo json_encode(['success' => true, 'message' => "$inserted students inserted successfully."]);
