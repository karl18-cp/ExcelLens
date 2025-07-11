<?php
require_once '../db_connection.php';

$sql = "SELECT p.progid, p.progname, p.progyear, d.deptname
        FROM program p
        JOIN department d ON p.deptid = d.deptid";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td><strong>{$row['progname']}</strong></td>
                <td>{$row['deptname']}</td>
                <td>{$row['progyear']}</td>
                <td>
                    <button class='btn btn-sm btn-outline'><i class='fas fa-edit'></i></button>
                    <button class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No programs found.</td></tr>";
}
?>
