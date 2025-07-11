<?php
require_once '../db_connection.php';

$result = $conn->query("SELECT deptid, deptname, deptnick FROM department");

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td><strong>{$row['deptname']}</strong></td>
        <td>{$row['deptnick']}</td>
        <td>—</td>
        <td>
            <button class='btn btn-sm btn-outline' onclick=\"openEditModal('{$row['deptid']}', '{$row['deptname']}', '{$row['deptnick']}')\">
                <i class='fas fa-edit'></i>
            </button>
            <button class='btn btn-sm btn-danger' onclick=\"confirmDeleteCollege('{$row['deptid']}')\">
                <i class='fas fa-trash'></i>
            </button>
        </td>
      </tr>";

    }
} else {
    echo "<tr><td colspan='4'>No colleges found.</td></tr>";
}
?>
