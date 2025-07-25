<?php
require_once '../db_connection.php';
session_start();

// ✅ Get prog_id
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT prog_id FROM pchair WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($programId);
$stmt->fetch();
$stmt->close();

if (!$programId) {
    echo json_encode(['success' => false, 'message' => 'Program ID not found.']);
    exit;
}

// ✅ Handle uploaded PDF
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf'])) {
    $file = $_FILES['pdf'];
    $filename = basename($file['name']);
    $targetPath = '../uploads/curriculum/' . $filename;

    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        echo json_encode(['success' => false, 'message' => 'Failed to upload file.']);
        exit;
    }

    // ✅ Insert into curriculum table
    $currName = pathinfo($filename, PATHINFO_FILENAME);
    $stmt = $conn->prepare("INSERT INTO curriculum (currname, file, prog_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $currName, $filename, $programId);
    $stmt->execute();
    $curriculumId = $stmt->insert_id;

    // ✅ Parse with Tabula
    $tabulaJar = '../tabula/tabula.jar';
    $cmd = "java -jar \"$tabulaJar\" -p all -f JSON \"$targetPath\"";
    $output = shell_exec($cmd);

    file_put_contents('tabula_debug.json', $output ?: 'Tabula produced no output.');

    $tables = json_decode($output, true);
    if (!$tables || !is_array($tables)) {
        echo json_encode(['success' => false, 'message' => 'Failed to parse PDF using Tabula.']);
        exit;
    }

    // ✅ Parse & insert rows
    $year = '';
    $semester = '';
    $insertCount = 0;

    foreach ($tables as $table) {
        foreach ($table['data'] as $row) {
            $cells = array_map(fn($cell) => trim($cell['text']), $row);
            $joined = strtoupper(implode(' ', $cells));
            file_put_contents('parsed_rows.log', $joined . "\n", FILE_APPEND);

            // Detect Year/Semester
            if (preg_match('/(FIRST|SECOND|THIRD|FOURTH|FIFTH) YEAR/', $joined, $match)) {
                $year = ucwords(strtolower($match[0]));
                continue;
            }
            if (preg_match('/(FIRST|SECOND|MIDTERM|SUMMER) SEMESTER/', $joined, $match)) {
                $semester = ucwords(strtolower($match[0]));
                continue;
            }

            if (count($cells) < 3 || !$year || !$semester) continue;

            $ccode = $cells[0];
            $ctitle = $cells[1];
            $units = null;

            // Try to find numeric value in next 2 columns
            if (isset($cells[2]) && is_numeric($cells[2])) {
                $units = intval($cells[2]);
            } elseif (isset($cells[3]) && is_numeric($cells[3])) {
                $units = intval($cells[3]);
            }

            if (!$ccode || !$ctitle || $units === null) continue;

            file_put_contents('insert_preview.log', "$ccode | $ctitle | $units | $year | $semester\n", FILE_APPEND);

            $stmt = $conn->prepare("INSERT INTO courses (curriculumid, ccode, ctitle, units, year, semester) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ississ", $curriculumId, $ccode, $ctitle, $units, $year, $semester);
            $stmt->execute();
            $insertCount++;
        }
    }

    echo json_encode([
        'success' => true,
        'message' => "Inserted $insertCount courses into curriculum."
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
