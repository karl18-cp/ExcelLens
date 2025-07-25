<?php
require_once '../db_connection.php';
require_once 'campus_functions.php';
require_once 'college_functions.php';
require_once 'program_functions.php';
require_once 'major_functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {

        // 🏫 Campus Module
        case 'add_campus':
            handleCampusInsertAjax($conn);
            break;
        case 'edit_campus':
            handleCampusUpdateAjax($conn);
            break;
        case 'delete_campus':
            handleCampusDeleteAjax($conn);
            break;
        case 'add_college':
            handleCollegeInsertAjax($conn);
            break;
        case 'edit_college':
            handleCollegeUpdateAjax($conn);
            break;
        case 'delete_college':
            handleCollegeDeleteAjax($conn);
            break;
        case 'add_program':
            handleProgramInsertAjax($conn);
            break;
        case 'update_program':
            handleProgramUpdateAjax($conn);
            break;
        case 'delete_program':
            handleProgramDeleteAjax($conn);
            break;
        case 'add_major':
            handleMajorInsertAjax($conn);
            break;
        case 'update_major':
            handleMajorUpdate($conn);
            break;
        case 'delete_major':
            handleMajorDelete($conn);
            break;


        case 'fetch_colleges':
    $campus_id = $_POST['campus_id'];
    $stmt = $conn->prepare("SELECT deptid, deptname FROM department WHERE camp_id = ?");
    $stmt->bind_param("i", $campus_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $colleges = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode(['status' => 'success', 'colleges' => $colleges]);
    exit();

        case 'fetch_programs':
    $deptid = $_POST['deptid'];
    $stmt = $conn->prepare("SELECT progid, progname FROM program WHERE deptid = ?");
    $stmt->bind_param("i", $deptid);
    $stmt->execute();
    $result = $stmt->get_result();
    $programs = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode(['status' => 'success', 'programs' => $programs]);
    exit();

        default:
            echo json_encode(['status' => 'error', 'message' => 'Unknown action.']);
            break;
    }
    exit(); // Important! Stops normal HTML output during AJAX call
}
$campusList = getAllCampuses($conn);
$colleges = getAllColleges($conn);
$collegeList = getAllCollegesRaw($conn);
$programs = getAllPrograms($conn);
$majors = getAllMajors($conn);
?>

<!-- Campus Module -->
<div id="campus-module" class="module-container" style="display: none;">
    <div class="module-header">
        <h2 class="module-title"><i class="fas fa-map-marker-alt"></i> Campus</h2>
    </div>
    <div class="module-body">
        <div class="nav-tabs">
            <div class="nav-tab active" onclick="showCampusTab('insert-campus')">
                <i class="fas fa-plus"></i> Insert Campus
            </div>
            <div class="nav-tab" onclick="showCampusTab('view-campuses')">
                <i class="fas fa-list"></i> View Campuses
            </div>
        </div>

        <!-- Insert Campus Tab -->
        <div id="insert-campus-tab" class="campus-tab-content">
            <form id="addCampusForm" method="POST">
    <input type="hidden" name="action" value="add_campus">
    <div class="form-grid">
        <div class="form-group">
            <label class="form-label">Campus Name</label>
            <input type="text" name="name" class="form-control" placeholder="e.g. Main Campus" required>
        </div>
        <div class="form-group">
            <label class="form-label">Campus Address</label>
            <input type="text" name="address" class="form-control" placeholder="e.g. 123 University Ave, City" required>
        </div>
    </div>
    <button type="submit" class="btn btn-success">
        <i class="fas fa-plus"></i> Add Campus
    </button>
</form>

        </div>

        <!-- View Campuses Tab -->
<div id="view-campuses-tab" class="campus-tab-content" style="display: none;">
    <div class="table-container" style="margin-top: 15px;">
        <div class="table-header">
            <h3 class="table-title">Existing Campuses</h3>
            <div class="table-actions">
                <input type="search" class="form-control" placeholder="Search campuses..." style="width: 250px;">
            </div>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Campus Name</th>
                    <th>Campus Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="campusTableBody">
    <?php if (!empty($campusList)) : ?>
        <?php foreach ($campusList as $campus): ?>
            <tr id="campus-row-<?= $campus['campus_id'] ?>">
    <td><?= htmlspecialchars($campus['camname']) ?></td>
    <td><?= htmlspecialchars($campus['camadd']) ?></td>
    <td>
        <button class="btn btn-sm btn-outline" onclick="openEditCampusModal(
            <?= $campus['campus_id'] ?>,
            '<?= addslashes($campus['camname']) ?>',
            '<?= addslashes($campus['camadd']) ?>'
        )">
            <i class="fas fa-edit"></i>
        </button>
        <button class="btn btn-sm btn-danger" onclick="confirmDeleteCampus(<?= $campus['campus_id'] ?>)">
            <i class="fas fa-trash"></i>
        </button>
    </td>
</tr>

        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="3">No campuses found.</td>
        </tr>
    <?php endif; ?>
</tbody>

        </table>
    </div>
</div>

    </div>
</div>

<!-- Colleges Module -->
<div id="colleges-module" class="module-container" style="display: none;">
    <div class="module-header">
        <h2 class="module-title"><i class="fas fa-building"></i> Colleges</h2>
    </div>
    <div class="module-body">

        <div class="nav-tabs">
            <div class="nav-tab active" onclick="showCollegeTab('insert-college')">
                <i class="fas fa-plus"></i> Insert College
            </div>
            <div class="nav-tab" onclick="showCollegeTab('view-colleges')">
                <i class="fas fa-list"></i> View Colleges
            </div>
        </div>
        <div id="insert-college-tab" class="college-tab-content">
        <!-- Insert College Form -->
         
        <form id="addCollegeForm" method="POST">
    <input type="hidden" name="action" value="add_college">
    <div class="form-grid">
        <!-- Dynamic Campus Combo -->
        <div class="form-group">
            <label class="form-label">Select Campus</label>
            <select name="camp_id" class="form-control" required>
                <option value="">Select Campus</option>
                <?php foreach ($campusList as $campus): ?>
                    <option value="<?= $campus['campus_id'] ?>">
                        <?= htmlspecialchars($campus['camname']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- College Name -->
        <div class="form-group">
            <label class="form-label">College Name</label>
            <input type="text" name="deptname" class="form-control" placeholder="e.g. College of Engineering" required>
        </div>

        <!-- Abbreviation -->
        <div class="form-group">
            <label class="form-label">Abbreviation</label>
            <input type="text" name="deptnick" class="form-control" placeholder="e.g. COE" required>
        </div>
    </div>
    <button type="submit" class="btn btn-success">
        <i class="fas fa-plus"></i> Add College
    </button>
</form>
    </div>

        <!-- View Colleges Table -->
<div id="view-colleges-tab" class="college-tab-content" style="display: none;">
    <div class="table-container" style="margin-top: 15px;">
        <div class="table-header">
            <h3 class="table-title">Existing Colleges</h3>
            <div class="table-actions">
                <input type="search" class="form-control" placeholder="Search colleges..." style="width: 250px;">
            </div>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Campus</th>
                    <th>College Name</th>
                    <th>Abbreviation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="collegeTableBody">
    <?php if (!empty($colleges)) : ?>
        <?php foreach ($colleges as $college): ?>
            <tr id="college-row-<?= $college['id'] ?>">
                <td><?= htmlspecialchars($college['campus']) ?></td>
                <td><?= htmlspecialchars($college['name']) ?></td>
                <td><?= htmlspecialchars($college['code']) ?></td>
                <td>
                    <button class="btn btn-sm btn-outline" onclick="openEditCollegeModal(
                    <?= $college['id'] ?>,
                    '<?= addslashes($college['campus']) ?>',
                    '<?= addslashes($college['name']) ?>',
                    '<?= addslashes($college['code']) ?>'
                )">
                    <i class="fas fa-edit"></i>
                    </button>

                    <button class="btn btn-sm btn-danger" onclick="confirmDeleteCollege(<?= $college['id'] ?>)">
        <i class="fas fa-trash"></i>
    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="4">No colleges found.</td></tr>
    <?php endif; ?>
</tbody>

        </table>
    </div>
</div>

    </div>
</div>

<!-- Programs Module -->
<div id="programs-module" class="module-container" style="display: none;">
    <div class="module-header">
        <h2 class="module-title"><i class="fas fa-graduation-cap"></i> Programs</h2>
    </div>
    <div class="module-body">
        <div class="nav-tabs">
            <div class="nav-tab active" onclick="showProgramTab('insert-program')">
                <i class="fas fa-plus"></i> Insert Program
            </div>
            <div class="nav-tab" onclick="showProgramTab('view-programs')">
                <i class="fas fa-list"></i> View Programs
            </div>
        </div>

        <!-- Insert Program Form -->
        <div id="insert-program-tab" class="program-tab-content">
            <div class="form-grid">
                <!-- Campus Combo -->
<div class="form-group">
    <label class="form-label">Select Campus</label>
    <select id="program-campus" class="form-control form-select" required>
        <option value="">Select Campus</option>
        <?php foreach ($campusList as $campus): ?>
            <option value="<?= $campus['campus_id'] ?>"><?= htmlspecialchars($campus['camname']) ?></option>
        <?php endforeach; ?>
    </select>
</div>

<!-- College Combo -->
<div class="form-group">
    <label class="form-label">Select College</label>
    <select id="program-college" class="form-control form-select" required>
        <option value="">Select College</option>
        <?php foreach ($collegeList as $college): ?>
            <option value="<?= $college['deptid'] ?>" data-campus="<?= $college['camp_id'] ?>">
                <?= htmlspecialchars($college['deptname']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>


                <!-- Program Name -->
                <div class="form-group">
                    <label class="form-label">Program Name</label>
                    <input type="text" id="program-name" class="form-control" placeholder="e.g. Computer Science">
                </div>

                <!-- Abbreviation -->
                <div class="form-group">
                    <label class="form-label">Abbreviation</label>
                    <input type="text" id="program-abbreviation" class="form-control" placeholder="e.g. BSCS">
                </div>

               
            </div>

            <button class="btn btn-success" onclick="addProgram()">
                <i class="fas fa-plus"></i> Add Program
            </button>
        </div>

                <!-- View Programs Tab -->
        <div id="view-programs-tab" class="program-tab-content" style="display: none;">
            <div class="table-container" style="margin-top: 15px;">
                <div class="table-header">
                    <h3 class="table-title">Existing Programs</h3>
                    <div class="table-actions">
                        <input type="search" class="form-control" placeholder="Search programs..." style="width: 250px;">
                    </div>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Campus</th>
                            <th>College</th>
                            <th>Program Name</th>
                            <th>Abbreviation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="programTableBody">
    <?php if (!empty($programs)) : ?>
        <?php foreach ($programs as $program): ?>
        <tr id="program-row-<?= $program['id'] ?>">
            <td><?= htmlspecialchars($program['campus']) ?></td>
            <td><?= htmlspecialchars($program['college']) ?></td>
            <td><?= htmlspecialchars($program['progname']) ?></td>
            <td><?= htmlspecialchars($program['abbre']) ?></td>
            <td>
                <button class="btn btn-sm btn-outline" onclick="openEditProgramModal(
  <?= $program['id'] ?>,
  '<?= addslashes($program['progname']) ?>',
  '<?= addslashes($program['abbre']) ?>'
)">
    <i class="fas fa-edit"></i>
</button>

                <button class="btn btn-sm btn-danger" onclick="confirmDeleteProgram(<?= $program['id'] ?>)">
    <i class="fas fa-trash"></i>
</button>

            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="5">No programs found.</td></tr>
    <?php endif; ?>
</tbody>

                </table>
            </div>
        </div>

    </div>
</div>

<!-- Majors Module -->
<div id="majors-module" class="module-container" style="display: none;">
    <div class="module-header">
        <h2 class="module-title"><i class="fas fa-book"></i> Majors</h2>
    </div>
    <div class="module-body">
        <div class="nav-tabs">
            <div class="nav-tab active" onclick="showMajorTab('insert-major')">
                <i class="fas fa-plus"></i> Insert Major
            </div>
            <div class="nav-tab" onclick="showMajorTab('view-majors')">
                <i class="fas fa-list"></i> View Majors
            </div>
        </div>

        <!-- Insert Major Tab -->
        <div id="insert-major-tab" class="major-tab-content">
    <form id="addMajorForm" method="POST">
        <input type="hidden" name="action" value="add_major">
        <div class="form-grid">

            <!-- Campus Combo -->
<select name="campus_id" id="major-campus" class="form-control" required>
    <option value="">Select Campus</option>
    <?php foreach ($campusList as $campus): ?>
        <option value="<?= $campus['campus_id'] ?>"><?= htmlspecialchars($campus['camname']) ?></option>
    <?php endforeach; ?>
</select>

<!-- College -->
<select name="college_id" id="major-college" class="form-control" required>
    <option value="">Select College</option>
</select>

<!-- Program -->
<select name="programid" id="major-program" class="form-control" required>
    <option value="">Select Program</option>
</select>


            <!-- Major Name -->
            <div class="form-group">
                <label class="form-label">Major Name</label>
                <input type="text" name="trackname" class="form-control" placeholder="e.g. Data Science" required>
            </div>

            <!-- Abbreviation -->
            <div class="form-group">
                <label class="form-label">Abbreviation</label>
                <input type="text" name="abbrev" class="form-control" placeholder="e.g. DS" required>
            </div>

        </div>
        <button type="submit" class="btn btn-success">
            <i class="fas fa-plus"></i> Add Major
        </button>
    </form>
</div>


        <!-- View Majors Tab -->
        <div id="view-majors-tab" class="major-tab-content" style="display: none;">
            <div class="table-container" style="margin-top: 15px;">
                <div class="table-header">
                    <h3 class="table-title">Existing Majors</h3>
                    <div class="table-actions">
                        <input type="search" class="form-control" placeholder="Search majors..." style="width: 250px;">
                    </div>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>College</th>
                            <th>Program</th>
                            <th>Major Name</th>
                            <th>Abbreviation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php if (!empty($majors)) : ?>
        <?php foreach ($majors as $major): ?>
            <tr>
                <td><?= htmlspecialchars($major['college']) ?></td>
                <td><?= htmlspecialchars($major['program']) ?></td>
                <td><?= htmlspecialchars($major['trackname']) ?></td>
                <td><?= htmlspecialchars($major['abbrev']) ?></td>
                <td>
                    <button class="btn btn-sm btn-outline" onclick="openEditMajorModal(
                        <?= $major['id'] ?>,
                        '<?= addslashes($major['trackname']) ?>',
                        '<?= addslashes($major['abbrev']) ?>'
                    )"><i class="fas fa-edit"></i></button>

                    <button class="btn btn-sm btn-danger" onclick="confirmDeleteMajor(<?= $major['id'] ?>)">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="5">No majors found.</td></tr>
    <?php endif; ?>
</tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<!-- Year Levels Module -->
<div id="yearlevels-module" class="module-container" style="display: none;">
    <div class="module-header">
        <h2 class="module-title"><i class="fas fa-layer-group"></i> Year Levels</h2>
    </div>
    <div class="module-body">
        <div class="nav-tabs">
            <div class="nav-tab active" onclick="showYearLevelTab('insert-year-level')">
                <i class="fas fa-plus"></i> Insert Year Level
            </div>
            <div class="nav-tab" onclick="showYearLevelTab('view-year-levels')">
                <i class="fas fa-list"></i> View Year Levels
            </div>
        </div>

        <div id="insert-year-level-tab" class="year-level-tab-content">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Year Level</label>
                    <select class="form-control form-select">
                        <option>1st Year</option>
                        <option>2nd Year</option>
                        <option>3rd Year</option>
                        <option>4th Year</option>
                        <option>5th Year</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Select Program</label>
                    <select id="year-program" class="form-control form-select">
                        <option>Select Program</option>
                        <option>Computer Science</option>
                        <option>Information Technology</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-success" onclick="addYearLevel()">
                <i class="fas fa-plus"></i> Add Year Level
            </button>
        </div>

        <div id="view-year-levels-tab" class="year-level-tab-content" style="display: none;">
            <div class="table-container" style="margin-top: 15px;">
                <div class="table-header">
                    <h3 class="table-title">Existing Year Levels</h3>
                    <div class="table-actions">
                        <input type="search" class="form-control" placeholder="Search year levels..." style="width: 250px;">
                    </div>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Year Level</th>
                            <th>Program</th>
                            <th>College</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample rows -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="editCampusModal" class="modal" style="display: none;">
    <div class="modal-content">
        <h3>Edit Campus</h3>
        <form id="editCampusForm">
            <input type="hidden" name="action" value="edit_campus">
            <input type="hidden" name="id" id="edit-campus-id">

            <div class="form-group">
                <label>Campus Name</label>
                <input type="text" name="name" id="edit-campus-name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Campus Address</label>
                <input type="text" name="address" id="edit-campus-address" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-secondary" onclick="closeEditCampusModal()">Cancel</button>
        </form>
    </div>
</div>

<div id="editCollegeModal" class="modal" style="display: none;">
    <div class="modal-content">
        <h3>Edit College</h3>
        <form id="editCollegeForm">
            <input type="hidden" name="action" value="edit_college">
            <input type="hidden" name="id" id="edit-college-id">

            <div class="form-group">
                <label>Select Campus</label>
                <select name="camp_id" id="edit-campus-select" class="form-control" required>
                    <option value="">Select Campus</option>
                    <?php foreach ($campusList as $campus): ?>
                        <option value="<?= $campus['campus_id'] ?>">
                            <?= htmlspecialchars($campus['camname']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>College Name</label>
                <input type="text" name="deptname" id="edit-deptname" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Abbreviation</label>
                <input type="text" name="deptnick" id="edit-deptnick" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-secondary" onclick="closeEditCollegeModal()">Cancel</button>
        </form>
    </div>
</div>

<div id="editProgramModal" class="modal" style="display: none;">
  <div class="modal-content">
    <h3>Edit Program</h3>
    <form id="editProgramForm">
      <input type="hidden" name="action" value="update_program">
      <input type="hidden" name="progid" id="edit-progid">

      <div class="form-group">
        <label>Program Name</label>
        <input type="text" name="progname" id="edit-progname" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Abbreviation</label>
        <input type="text" name="abbre" id="edit-abbre" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-success">Update</button>
      <button type="button" class="btn btn-secondary" onclick="closeEditProgramModal()">Cancel</button>
    </form>
  </div>
</div>
<!-- Edit Major Modal -->
<div id="editMajorModal" class="modal" style="display:none;">
    <div class="modal-content">
        <h3>Edit Major</h3>
        <form id="editMajorForm">
            <input type="hidden" name="id" id="edit-major-id">
            
            <div class="form-group">
                <label class="form-label">Major Name</label>
                <input type="text" name="trackname" id="edit-major-name" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Abbreviation</label>
                <input type="text" name="abbrev" id="edit-major-abbrev" class="form-control" required>
            </div>

            <div class="modal-actions">
                <button type="submit" class="btn btn-success">Update</button>
                <button type="button" class="btn btn-secondary" onclick="closeEditMajorModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>


<script>
    document.getElementById("addCampusForm").addEventListener("submit", function(e) {
    e.preventDefault(); // Prevent normal form submission

    const form = e.target;
    const formData = new FormData(form);

    fetch('system_config.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert("Campus added successfully!");

            // Add the new row to the table
            const campus = data.campus;
            const row = `
                <tr>
                    <td>${campus.name}</td>
                    <td>${campus.address}</td>
                    <td>
                        <button class="btn btn-sm btn-outline" onclick="editCampus(${campus.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteCampus(${campus.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            document.getElementById("campusTableBody").insertAdjacentHTML('beforeend', row);

            // Reset form
            form.reset();
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(err => {
        console.error(err);
        alert("An error occurred while adding the campus.");
    });
});

function openEditCampusModal(id, name, address) {
    document.getElementById("edit-campus-id").value = id;
    document.getElementById("edit-campus-name").value = name;
    document.getElementById("edit-campus-address").value = address;
    document.getElementById("editCampusModal").style.display = "block";
}

function closeEditCampusModal() {
    document.getElementById("editCampusModal").style.display = "none";
}

document.getElementById("editCampusForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch('system_config.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            alert("Campus updated successfully.");
            location.reload(); // Reload to reflect changes or manually update DOM
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(err => {
        console.error(err);
        alert("Something went wrong.");
    });
});

function confirmDeleteCampus(id) {
    if (confirm("Are you sure you want to delete this campus?")) {
        const formData = new FormData();
        formData.append('action', 'delete_campus');
        formData.append('id', id);

        fetch('system_config.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                alert("Campus deleted successfully.");
                document.querySelector(`#campus-row-${id}`)?.remove(); // remove row if exists
            } else {
                alert("Error: " + data.message);
            }
        })
        .catch(err => {
            console.error(err);
            alert("Something went wrong.");
        });
    }
}

document.getElementById("addCollegeForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch('system_config.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            alert("College added successfully.");
            form.reset();
            // Optionally update table/list if viewing colleges
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(err => {
        console.error(err);
        alert("Something went wrong.");
    });
});

function openEditCollegeModal(id, campusName, deptname, deptnick) {
    document.getElementById("edit-college-id").value = id;
    document.getElementById("edit-deptname").value = deptname;
    document.getElementById("edit-deptnick").value = deptnick;

    // Select matching campus by name
    const campusSelect = document.getElementById("edit-campus-select");
    for (let option of campusSelect.options) {
        if (option.text.trim() === campusName.trim()) {
            option.selected = true;
            break;
        }
    }

    document.getElementById("editCollegeModal").style.display = "block";
}

function closeEditCollegeModal() {
    document.getElementById("editCollegeModal").style.display = "none";
}

document.getElementById("editCollegeForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('system_config.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            alert("College updated successfully.");
            location.reload(); // Or update DOM without reloading
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(err => {
        console.error(err);
        alert("Something went wrong.");
    });
});

function confirmDeleteCollege(id) {
    if (confirm("Are you sure you want to delete this college?")) {
        const formData = new FormData();
        formData.append('action', 'delete_college');
        formData.append('id', id);

        fetch('system_config.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                alert("College deleted successfully.");
                document.getElementById("college-row-" + id)?.remove();
            } else {
                alert("Error: " + data.message);
            }
        })
        .catch(err => {
            console.error(err);
            alert("Something went wrong.");
        });
    }
}

document.getElementById("program-campus").addEventListener("change", function() {
    const selectedCampus = this.value;
    const collegeSelect = document.getElementById("program-college");

    // Reset and re-enable
    collegeSelect.value = "";
    [...collegeSelect.options].forEach(opt => {
        if (opt.value === "") return; // Keep "Select College" option
        const campusId = opt.getAttribute("data-campus");
        opt.style.display = (campusId === selectedCampus) ? "block" : "none";
    });
});

function addProgram() {
    const collegeId = document.getElementById("program-college").value;
    const progName = document.getElementById("program-name").value.trim();
    const abbreviation = document.getElementById("program-abbreviation").value.trim();

    if (!collegeId || !progName || !abbreviation) {
        alert("Please fill in all fields.");
        return;
    }

    const formData = new FormData();
    formData.append("action", "add_program");
    formData.append("deptid", collegeId);
    formData.append("progname", progName);
    formData.append("abbre", abbreviation);

    fetch("system_config.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            alert("Program added successfully.");
            document.getElementById("program-name").value = "";
            document.getElementById("program-abbreviation").value = "";
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(err => {
        console.error(err);
        alert("Something went wrong.");
    });
}

function openEditProgramModal(id, name, abbre) {
    document.getElementById('edit-progid').value = id;
    document.getElementById('edit-progname').value = name;
    document.getElementById('edit-abbre').value = abbre;
    document.getElementById('editProgramModal').style.display = 'block';
}

function closeEditProgramModal() {
    document.getElementById('editProgramModal').style.display = 'none';
}

document.getElementById('editProgramForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('system_config.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Program updated successfully.');
            location.reload(); // optional, or you can update the row dynamically
        } else {
            alert('Update failed: ' + data.message);
        }
    })
    .catch(error => {
        console.error(error);
        alert('An error occurred.');
    });
});

function confirmDeleteProgram(id) {
    if (confirm("Are you sure you want to delete this program?")) {
        const formData = new FormData();
        formData.append('action', 'delete_program');
        formData.append('id', id);

        fetch('system_config.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById("program-row-" + id)?.remove();
                alert("Program deleted successfully.");
            } else {
                alert("Deletion failed: " + data.message);
            }
        })
        .catch(error => {
            console.error(error);
            alert("An error occurred.");
        });
    }
}

document.getElementById("major-campus").addEventListener("change", function () {
    const campusId = this.value;
    const collegeSelect = document.getElementById("major-college");
    const programSelect = document.getElementById("major-program");

    // Reset selects
    collegeSelect.innerHTML = '<option value="">Select College</option>';
    programSelect.innerHTML = '<option value="">Select Program</option>';

    if (campusId) {
        fetch("system_config.php", {
            method: "POST",
            body: new URLSearchParams({
                action: "fetch_colleges",
                campus_id: campusId
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === "success") {
                data.colleges.forEach(college => {
                    const opt = document.createElement("option");
                    opt.value = college.deptid;
                    opt.textContent = college.deptname;
                    collegeSelect.appendChild(opt);
                });
            }
        });
    }
});

document.getElementById("major-college").addEventListener("change", function () {
    const deptId = this.value;
    const programSelect = document.getElementById("major-program");

    programSelect.innerHTML = '<option value="">Select Program</option>';

    if (deptId) {
        fetch("system_config.php", {
            method: "POST",
            body: new URLSearchParams({
                action: "fetch_programs",
                deptid: deptId
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === "success") {
                data.programs.forEach(program => {
                    const opt = document.createElement("option");
                    opt.value = program.progid;
                    opt.textContent = program.progname;
                    programSelect.appendChild(opt);
                });
            }
        });
    }
});

document.getElementById("addMajorForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch("system_config.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            alert("Major added successfully!");
            form.reset();
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(err => {
        console.error(err);
        alert("Something went wrong.");
    });
});

function openEditMajorModal(id, name, abbrev) {
    document.getElementById('edit-major-id').value = id;
    document.getElementById('edit-major-name').value = name;
    document.getElementById('edit-major-abbrev').value = abbrev;
    document.getElementById('editMajorModal').style.display = 'block';
}

function closeEditMajorModal() {
    document.getElementById('editMajorModal').style.display = 'none';
}

document.getElementById('editMajorForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    formData.append('action', 'update_major');

    fetch('system_config.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Major updated successfully!');
            location.reload(); // or refetch via AJAX
        } else {
            alert('Error: ' + data.message);
        }
    });
});

function confirmDeleteMajor(id) {
    if (confirm("Are you sure you want to delete this major?")) {
        fetch('system_config.php', {
            method: 'POST',
            body: new URLSearchParams({
                action: 'delete_major',
                id: id
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                alert("Major deleted successfully!");
                document.getElementById(`major-row-${id}`).remove(); // remove row from UI
            } else {
                alert("Error: " + data.message);
            }
        });
    }
}

</script>
             