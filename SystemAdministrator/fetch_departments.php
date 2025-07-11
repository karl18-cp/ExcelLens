<?php
require_once '../db_connection.php';

$result = $conn->query("SELECT deptid, deptname FROM department");

while ($row = $result->fetch_assoc()) {
    echo "<option value='{$row['deptid']}'>{$row['deptname']}</option>";
}
?>
