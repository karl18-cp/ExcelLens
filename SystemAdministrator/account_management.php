<?php
require_once '../db_connection.php';
require_once 'vcaa_functions.php'; // cleanly separated
require_once 'campus_functions.php';
require_once 'college_functions.php';
require_once 'dean_functions.php';
require_once 'chair_functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'insert_vcaa':
            handleInsertVCAA($conn);
            break;
        case 'update_vcaa':
            handleUpdateVCAA($conn);
            break;
        case 'delete_vcaa':
            handleDeleteVCAA($conn);
            break;
        case 'insert_dean':
            handleInsertDean($conn);
            break;
        case 'update_dean':
            handleUpdateDean($conn);
            break;
        case 'delete_dean':
            handleDeleteDean($conn);
            break;
        case 'insert_chair':
            handleInsertChair($conn);
            break;
        case 'update_chair':
            handleUpdateChair($conn);
            break;
        case 'delete_chair':
            handleDeleteChair($conn);
            break;


        default:
            echo json_encode(['status' => 'error', 'message' => 'Unknown action.']);
            break;
    }
    exit;
}
$campusList = getAllCampuses($conn);
$colleges = getAllCollegesRaw($conn);
$vcaaList = getAllVCAA($conn);
$deans = getAllDeans($conn);
$chairs = getAllChairs($conn);


?>


<!-- Account Management Module -->
<div id="account-management" class="module-container" style="display: none;">
    <div class="module-header">
        <h2 class="module-title" id="account-management-title">
            <i class="fas fa-users-cog"></i>
            Account Management
        </h2>
    </div>
    <div class="module-body">

        <!-- VCAA Accounts -->
<div id="vcaa-accounts" class="user-accounts">
    <p class="section-info"><i class="fas fa-info-circle"></i> This section is for adding Vice Chancellor for Academic Affairs.</p>

    <div class="nav-tabs sub-tabs">
        <div class="nav-tab active" onclick="showVCAATab('insert-vcaa')">
            <i class="fas fa-plus"></i> Insert VCAA
        </div>
        <div class="nav-tab" onclick="showVCAATab('view-vcaa')">
            <i class="fas fa-list"></i> View VCAA
        </div>
    </div>

    <!-- Insert VCAA Tab -->
    <div id="insert-vcaa-tab" class="vcaa-tab-content">
    <div class="form-grid">
        <div class="form-group">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" placeholder="e.g. Dr">
        </div>
        <div class="form-group">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" placeholder="e.g. Maria Santos">
        </div>
        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="vc.academic@batstate-u.edu.ph">
        </div>
        <div class="form-group">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-label">Password</label>
            <input type="text" name="password" class="form-control">
        </div>
        <div class="form-group">
           <label class="form-label">Select Campus</label>
            <select name="campus_id" class="form-control" required>
                <option value="">Select Campus</option>
                <?php foreach ($campusList as $campus): ?>
                    <option value="<?= $campus['campus_id'] ?>">
                        <?= htmlspecialchars($campus['camname']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <button class="btn btn-success" id="createVcaaBtn">
        <i class="fas fa-save"></i> Create VCAA Account
    </button>
</div>


    <!-- View VCAA Tab -->
    <div id="view-vcaa-tab" class="vcaa-tab-content" style="display:none;">
        <input type="text" class="form-control search-input" placeholder="Search VCAA by name..." onkeyup="searchTable('vcaa-table', this.value)">
        <table id="vcaa-table" class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
    <?php foreach ($vcaaList as $vcaa): ?>
        <tr 
    data-id="<?= $dean['user_id'] ?>" 
    data-title="<?= htmlspecialchars($dean['title']) ?>" 
    data-name="<?= htmlspecialchars($dean['name']) ?>" 
    data-email="<?= htmlspecialchars($dean['email']) ?>" 
    data-deptname="<?= htmlspecialchars($dean['deptname']) ?>"
>

    <td><?= htmlspecialchars($vcaa['title'] . ' ' . $vcaa['name']) ?></td>
    <td><?= htmlspecialchars($vcaa['email']) ?></td>
    <td>
        <button class="btn btn-sm btn-outline" onclick="editVCAA(this)">
            <i class="fas fa-edit"></i>
        </button>
        <button class="btn btn-sm btn-danger" onclick="deleteVCAA(this)">
            <i class="fas fa-trash"></i>
        </button>
    </td>
</tr>

    <?php endforeach; ?>
</tbody>

        </table>
    </div>
</div>


        <!-- College Deans Accounts -->
<div id="deans-accounts" class="user-accounts" style="display: none;">
    <p class="section-info"><i class="fas fa-info-circle"></i> This section is for adding College Deans.</p>

    <div class="nav-tabs sub-tabs">
        <div class="nav-tab active" onclick="showDeanTab('insert-dean')">
            <i class="fas fa-plus"></i> Insert Dean
        </div>
        <div class="nav-tab" onclick="showDeanTab('view-dean')">
            <i class="fas fa-list"></i> View Deans
        </div>
    </div>

    <!-- Insert Dean Tab -->
    <div id="insert-dean-tab" class="dean-tab-content">
        <div class="form-grid">
            <div class="form-group">
    <label class="form-label">Campus</label>
    <select id="dean-campus" class="form-control">
        <option value="">Select Campus</option>
        <?php foreach ($campusList as $campus): ?>
            <option value="<?= $campus['campus_id'] ?>">
                <?= htmlspecialchars($campus['camname']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="form-group">
    <label class="form-label">Select College</label>
    <select id="dean-department" class="form-control form-select" required>
        <option value="">Select College</option>
        <?php foreach ($colleges as $college): ?>
            <option value="<?= $college['deptid'] ?>" data-campus="<?= $college['camp_id'] ?>">
                <?= htmlspecialchars($college['deptname']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
            <div class="form-group">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" placeholder="e.g.Dr">
</div>
<div class="form-group">
    <label class="form-label">Full Name</label>
    <input type="text" name="name" class="form-control" placeholder="e.g.Maria Santos">
</div>
<div class="form-group">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" placeholder="vc.academic@batstate-u.edu.ph">
</div>
<div class="form-group">
    <label class="form-label">Username</label>
    <input type="text" name="username" class="form-control" placeholder="Username">
</div>
<div class="form-group">
    <label class="form-label">Password</label>
    <input type="text" name="password" class="form-control" placeholder="Password">
</div>
        </div>
        <button class="btn btn-success">
            <i class="fas fa-save"></i> Create Dean Account
        </button>
    </div>

    <!-- View Deans Tab -->
    <div id="view-dean-tab" class="dean-tab-content" style="display:none;">
        <input type="text" class="form-control search-input" placeholder="Search Dean by name..." onkeyup="searchTable('deans-table', this.value)">
        <table id="deans-table" class="data-table">
            <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>College</th>
        <th>Actions</th>
    </tr>
</thead>

            <tbody>
    <?php foreach ($deans as $dean): ?>
    <tr data-id="<?= $dean['id'] ?>" 
        data-title="<?= htmlspecialchars($dean['title']) ?>" 
        data-name="<?= htmlspecialchars($dean['name']) ?>" 
        data-email="<?= htmlspecialchars($dean['email']) ?>" 
        data-deptname="<?= htmlspecialchars($dean['deptname']) ?>">
        <td><?= htmlspecialchars($dean['title'] . ' ' . $dean['name']) ?></td>
        <td><?= htmlspecialchars($dean['email']) ?></td>
        <td><?= htmlspecialchars($dean['deptname']) ?></td>
        <td>
            <button class="btn btn-sm btn-outline" onclick="editDean(this)">
                <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-danger" onclick="deleteDean(this)">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>

        </table>
    </div>
</div>


        <!-- Chairpersons Accounts -->
<div id="chairs-accounts" class="user-accounts" style="display: none;">
    <p class="section-info"><i class="fas fa-info-circle"></i> This section is for adding Department Chairpersons.</p>

    <div class="nav-tabs sub-tabs">
        <div class="nav-tab active" onclick="showChairTab('insert-chair')">
            <i class="fas fa-plus"></i> Insert Chair
        </div>
        <div class="nav-tab" onclick="showChairTab('view-chair')">
            <i class="fas fa-list"></i> View Chairs
        </div>
    </div>

    <!-- Insert Chair Tab -->
    <div id="insert-chair-tab" class="chair-tab-content">
    <div class="form-grid">
        <!-- Campus Combo -->
        <div class="form-group">
            <label class="form-label">Campus</label>
            <select id="chair-campus" class="form-control">
                <option value="">Select Campus</option>
                <?php foreach ($campusList as $campus): ?>
                    <option value="<?= $campus['campus_id'] ?>"><?= htmlspecialchars($campus['camname']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- College Combo -->
        <div class="form-group">
            <label class="form-label">College</label>
            <select id="chair-college" class="form-control">
                <option value="">Select College</option>
            </select>
        </div>

        <!-- Program Combo -->
        <div class="form-group">
            <label class="form-label">Program</label>
            <select id="chair-program" class="form-control" required>
                <option value="">Select Program</option>
            </select>
        </div>

        <!-- Title, Name, Email, Username, Password -->
        <div class="form-group">
            <label class="form-label">Title</label>
            <input type="text" id="chair-title" class="form-control" placeholder="e.g.Dr">
        </div>
        <div class="form-group">
            <label class="form-label">Full Name</label>
            <input type="text" id="chair-name" class="form-control" placeholder="e.g.Maria Santos">
        </div>
        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" id="chair-email" class="form-control" placeholder="vc.academic@batstate-u.edu.ph">
        </div>
        <div class="form-group">
            <label class="form-label">Username</label>
            <input type="text" id="chair-username" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-label">Password</label>
            <input type="text" id="chair-password" class="form-control">
        </div>
    </div>
    <button class="btn btn-success" id="createChairBtn">
        <i class="fas fa-save"></i> Create Chair Account
    </button>
</div>

    
    

    <!-- View Chair Tab -->
    <div id="view-chair-tab" class="chair-tab-content" style="display:none;">
        <input type="text" class="form-control search-input" placeholder="Search Chair by name..." onkeyup="searchTable('chairs-table', this.value)">
        <table id="chairs-table" class="data-table">
            <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Program</th>
        <th>Actions</th>
    </tr>
</thead>

            <tbody>
    <?php
    $chairs = getAllChairs($conn);
    foreach ($chairs as $chair): ?>
        <tr 
            data-id="<?= $chair['id'] ?>" 
            data-title="<?= htmlspecialchars($chair['title']) ?>" 
            data-name="<?= htmlspecialchars($chair['name']) ?>" 
            data-email="<?= htmlspecialchars($chair['email']) ?>" 
            data-program="<?= htmlspecialchars($chair['progname']) ?>"
        >
            <td><?= htmlspecialchars($chair['title'] . ' ' . $chair['name']) ?></td>
            <td><?= htmlspecialchars($chair['email']) ?></td>
            <td><?= htmlspecialchars($chair['progname']) ?></td>
            <td>
                <button class="btn btn-sm btn-outline" onclick="editChair(this)">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-sm btn-danger" onclick="deleteChair(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

        </table>
    </div>
</div>


       
    </div>
</div>

<!-- Edit VCAA Modal -->
<div id="edit-vcaa-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeEditVCAAModal()">&times;</span>
        <h3>Edit VCAA Account</h3>
        <form id="editVcaaForm">
            <input type="hidden" name="vcaa_id" id="edit-vcaa-id">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" id="edit-title" class="form-control">
            </div>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" id="edit-name" class="form-control">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="edit-email" class="form-control">
            </div>
            <button type="button" class="btn btn-primary" onclick="submitEditVCAA()">Save Changes</button>
        </form>
    </div>
</div>

<!-- Edit Dean Modal -->
<div id="edit-dean-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeEditDeanModal()">&times;</span>
        <h3>Edit Dean Account</h3>
        <form id="editDeanForm">
            <input type="hidden" name="dean_id" id="edit-dean-id">
            
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" id="edit-dean-title" class="form-control">
            </div>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" id="edit-dean-name" class="form-control">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="edit-dean-email" class="form-control">
            </div>
            <div class="form-group">
                <label>College</label>
                <select name="dept_id" id="edit-dean-department" class="form-control">
                    <option value="">Select College</option>
                    <?php foreach ($colleges as $college): ?>
                        <option value="<?= $college['deptid'] ?>">
                            <?= htmlspecialchars($college['deptname']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="button" class="btn btn-primary" onclick="submitEditDean()">Save Changes</button>
        </form>
    </div>
</div>

<!-- Edit Chair Modal -->
<div id="edit-chair-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeEditChairModal()">&times;</span>
        <h3>Edit Chairperson Account</h3>
        <form id="editChairForm">
            <input type="hidden" name="chair_id" id="edit-chair-id">

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" id="edit-chair-title" class="form-control">
            </div>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" id="edit-chair-name" class="form-control">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="edit-chair-email" class="form-control">
            </div>
            <button type="button" class="btn btn-primary" onclick="submitEditChair()">Save Changes</button>
        </form>
    </div>
</div>


<script>
    document.getElementById("createVcaaBtn").addEventListener("click", function () {
    const formData = new FormData();
    formData.append("action", "insert_vcaa");
    formData.append("title", document.querySelector("[name='title']").value);
    formData.append("name", document.querySelector("[name='name']").value);
    formData.append("email", document.querySelector("[name='email']").value);
    formData.append("username", document.querySelector("[name='username']").value);
    formData.append("password", document.querySelector("[name='password']").value);
    formData.append("campus_id", document.querySelector("[name='campus_id']").value);

    fetch("account_management.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
    })
    .catch(err => {
        console.error("Error:", err);
        alert("An error occurred.");
    });
});

function editVCAA(btn) {
    const row = btn.closest('tr');
    document.getElementById('edit-vcaa-id').value = row.dataset.id;
    document.getElementById('edit-title').value = row.dataset.title;
    document.getElementById('edit-name').value = row.dataset.name;
    document.getElementById('edit-email').value = row.dataset.email;
    document.getElementById('edit-vcaa-modal').style.display = 'block';
}

function closeEditVCAAModal() {
    document.getElementById('edit-vcaa-modal').style.display = 'none';
}

function submitEditVCAA() {
    const formData = new FormData(document.getElementById('editVcaaForm'));
    formData.append('action', 'update_vcaa');

    fetch("account_management.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if (data.status === 'success') {
            location.reload(); // Refresh to show updated row
        }
    })
    .catch(err => {
        console.error(err);
        alert("An error occurred.");
    });
}

function deleteVCAA(btn) {
    const row = btn.closest('tr');
    const id = row.dataset.id;
    const confirmed = confirm("Are you sure you want to delete this VCAA account?");

    if (!confirmed) return;

    const formData = new FormData();
    formData.append("action", "delete_vcaa");
    formData.append("vcaa_id", id);

    fetch("account_management.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if (data.status === 'success') {
            row.remove(); // remove row from table
        }
    })
    .catch(err => {
        console.error(err);
        alert("An error occurred during deletion.");
    });
}
document.getElementById("dean-campus").addEventListener("change", function () {
    const selectedCampus = this.value;
    const collegeSelect = document.getElementById("dean-department");

    // Reset to default
    collegeSelect.value = "";

    [...collegeSelect.options].forEach(opt => {
        if (opt.value === "") return; // Skip "Select College"
        const campusId = opt.getAttribute("data-campus");
        opt.style.display = (campusId === selectedCampus) ? "block" : "none";
    });
});


document.querySelector("#insert-dean-tab .btn-success").addEventListener("click", function () {
    const formData = new FormData();
    formData.append("action", "insert_dean");
    formData.append("title", document.querySelector("#insert-dean-tab [placeholder='e.g.Dr']").value);
    formData.append("name", document.querySelector("#insert-dean-tab [placeholder='e.g.Maria Santos']").value);
    formData.append("email", document.querySelector("#insert-dean-tab [type='email']").value);
    formData.append("username", document.querySelector("#insert-dean-tab [name='dean_username'], #insert-dean-tab [placeholder='Username']").value);
    formData.append("password", document.querySelector("#insert-dean-tab [name='dean_password'], #insert-dean-tab [placeholder='Password']").value);
    formData.append("dept_id", document.getElementById("dean-department").value);

    fetch("account_management.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
.then(text => {
    try {
        const data = JSON.parse(text);
        alert(data.message);
    } catch (err) {
        console.error("Invalid JSON:", text);
        alert("An error occurred while parsing server response.");
    }
})
.catch(err => {
    console.error("Request failed:", err);
    alert("A network error occurred.");
});

});

function editDean(btn) {
    const row = btn.closest('tr');
    document.getElementById('edit-dean-id').value = row.dataset.id;
    document.getElementById('edit-dean-title').value = row.dataset.title;
    document.getElementById('edit-dean-name').value = row.dataset.name;
    document.getElementById('edit-dean-email').value = row.dataset.email;

    // Select correct department
    const deptSelect = document.getElementById('edit-dean-department');
    for (let i = 0; i < deptSelect.options.length; i++) {
        if (deptSelect.options[i].textContent === row.dataset.deptname) {
            deptSelect.selectedIndex = i;
            break;
        }
    }

    document.getElementById('edit-dean-modal').style.display = 'block';
}

function closeEditDeanModal() {
    document.getElementById('edit-dean-modal').style.display = 'none';
}

function submitEditDean() {
    const formData = new FormData(document.getElementById('editDeanForm'));
    formData.append("action", "update_dean");

    fetch("account_management.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if (data.status === 'success') {
            location.reload(); // Refresh to show updated row
        }
    })
    .catch(err => {
        console.error("Dean update failed:", err);
        alert("An error occurred.");
    });
}

function deleteDean(btn) {
    const row = btn.closest('tr');
    const id = row.dataset.id;

    const confirmed = confirm("Are you sure you want to delete this Dean account?");
    if (!confirmed) return;

    const formData = new FormData();
    formData.append("action", "delete_dean");
    formData.append("dean_id", id);

    fetch("account_management.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if (data.status === 'success') {
            row.remove(); // Remove from table UI
        }
    })
    .catch(err => {
        console.error("Error deleting dean:", err);
        alert("An error occurred during deletion.");
    });
}

document.getElementById("chair-campus").addEventListener("change", function () {
    const campusId = this.value;
    const collegeSelect = document.getElementById("chair-college");
    const programSelect = document.getElementById("chair-program");

    // Reset
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

document.getElementById("chair-college").addEventListener("change", function () {
    const deptId = this.value;
    const programSelect = document.getElementById("chair-program");

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

document.getElementById("createChairBtn").addEventListener("click", function () {
    const formData = new FormData();
    formData.append("action", "insert_chair");
    formData.append("title", document.getElementById("chair-title").value);
    formData.append("name", document.getElementById("chair-name").value);
    formData.append("email", document.getElementById("chair-email").value);
    formData.append("username", document.getElementById("chair-username").value);
    formData.append("password", document.getElementById("chair-password").value);
    formData.append("prog_id", document.getElementById("chair-program").value);

    fetch("account_management.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
    })
    .catch(err => {
        console.error(err);
        alert("An error occurred.");
    });
});

function editChair(btn) {
    const row = btn.closest('tr');

    document.getElementById('edit-chair-id').value = row.dataset.id;
    document.getElementById('edit-chair-title').value = row.dataset.title;
    document.getElementById('edit-chair-name').value = row.dataset.name;
    document.getElementById('edit-chair-email').value = row.dataset.email;

    document.getElementById('edit-chair-modal').style.display = 'block';
}

function closeEditChairModal() {
    document.getElementById('edit-chair-modal').style.display = 'none';
}

function submitEditChair() {
    const formData = new FormData(document.getElementById('editChairForm'));
    formData.append("action", "update_chair");

    fetch("account_management.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if (data.status === 'success') {
            location.reload();
        }
    })
    .catch(err => {
        console.error("Chair update failed:", err);
        alert("An error occurred.");
    });
}

function deleteChair(btn) {
    const row = btn.closest('tr');
    const id = row.dataset.id;

    const confirmed = confirm("Are you sure you want to delete this Chairperson account?");
    if (!confirmed) return;

    const formData = new FormData();
    formData.append("action", "delete_chair");
    formData.append("chair_id", id);

    fetch("account_management.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if (data.status === 'success') {
            row.remove(); // Remove row from UI
        }
    })
    .catch(err => {
        console.error("Chair deletion failed:", err);
        alert("An error occurred during deletion.");
    });
}

</script>