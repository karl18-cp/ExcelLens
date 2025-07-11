<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExcelLens - Chairperson Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #990000;
            --secondary: #f8f0f0;
            --light-gray: #f5f5f5;
            --dark-gray: #333;
            --success: #4CAF50;
            --warning: #ff9800;
            --danger: #f44336;
            --info: #2196F3;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light-gray);
            color: var(--dark-gray);
        }
        
        .chairperson-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Navigation */
        .sidebar {
            width: 250px;
            background-color: var(--primary);
            color: white;
            padding: 20px 0;
            position: fixed;
            height: 100vh;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            transition: width 0.3s;
            z-index: 100;
        }
        
        .logo {
            text-align: center;
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .logo img {
            max-width: 80%;
            transition: all 0.3s;
        }
        
        .nav-menu {
            margin-top: 20px;
        }
        
        .nav-item {
            padding: 12px 20px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            white-space: nowrap;
        }
        
        .nav-item:hover, .nav-item.active {
            background-color: rgba(255,255,255,0.1);
        }
        
        .nav-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }
        
        /* Main Content Area */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            flex-wrap: wrap;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }
        
        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }
        
        /* Module Containers */
        .module-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 20px;
            margin-bottom: 20px;
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .module-title {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }
        
        .module-title i {
            margin-right: 10px;
        }
        
        /* Program Management Tabs */
        .management-tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            overflow-x: auto;
        }
        
        .management-tab {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
            white-space: nowrap;
        }
        
        .management-tab:hover {
            background-color: rgba(0,0,0,0.05);
        }
        
        .management-tab.active {
            border-bottom: 3px solid var(--primary);
            color: var(--primary);
            font-weight: bold;
        }
        
        /* Curriculum Management */
        .import-box {
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            margin-bottom: 20px;
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .import-box:hover {
            border-color: var(--primary);
            background-color: var(--secondary);
        }
        
        .import-box i {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        .download-template {
            display: inline-block;
            margin-top: 15px;
            color: var(--primary);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .download-template:hover {
            text-decoration: underline;
            transform: translateY(-2px);
        }
        
        /* Faculty Loading */
        .semester-selector {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .semester-selector label {
            font-weight: 500;
        }
        
        .course-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .course-table th, .course-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .course-table th {
            background-color: var(--light-gray);
            font-weight: 600;
            position: sticky;
            top: 0;
        }
        
        .course-table tr:hover {
            background-color: rgba(0,0,0,0.02);
        }
        
        .faculty-select {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            min-width: 200px;
            transition: all 0.3s;
        }
        
        .faculty-select:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 2px rgba(153,0,0,0.2);
        }
        
        .action-btn {
            padding: 5px 10px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            margin-right: 5px;
            font-size: 0.8rem;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
        }
        
        .action-btn i {
            margin-right: 5px;
        }
        
        .action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .save-btn {
            background-color: var(--primary);
            color: white;
        }
        
        .edit-btn {
            background-color: var(--info);
            color: white;
        }
        
        .delete-btn {
            background-color: var(--danger);
            color: white;
        }
        
        .submit-btn {
            background-color: var(--primary);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            margin-top: 10px;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
        }
        
        .submit-btn i {
            margin-right: 8px;
        }
        
        .submit-btn:hover {
            background-color: #800000;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        /* Current Curriculum View */
        .curriculum-table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .curriculum-table th, .curriculum-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .curriculum-table th {
            background-color: var(--light-gray);
            font-weight: 600;
            position: sticky;
            top: 0;
        }
        
        .curriculum-table tr:hover {
            background-color: rgba(0,0,0,0.02);
        }
        
        /* Alerts Section */
        .alerts-section {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 20px;
            margin-bottom: 20px;
        }

        .alerts-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .alerts-actions {
            display: flex;
            gap: 10px;
        }

        .filter-btn {
            padding: 5px 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            background-color: white;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-btn.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .filter-btn:hover {
            background-color: #f0f0f0;
        }

        .filter-btn.active:hover {
            background-color: #800000;
        }

        .alert-item {
            background-color: var(--secondary);
            border-left: 5px solid var(--primary);
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 4px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            font-size: 0.95rem;
            transition: all 0.3s;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .alert-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }

        .alert-content {
            flex: 1;
        }

        .alert-item.success {
            border-left-color: var(--success);
            background-color: rgba(76, 175, 80, 0.1);
        }

        .alert-item.warning {
            border-left-color: var(--warning);
            background-color: rgba(255, 152, 0, 0.1);
        }

        .alert-item.danger {
            border-left-color: var(--danger);
            background-color: rgba(244, 67, 54, 0.1);
        }

        .alert-item.info {
            border-left-color: var(--info);
            background-color: rgba(33, 150, 243, 0.1);
        }

        .alert-item i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .alert-meta {
            display: flex;
            align-items: center;
            margin-top: 5px;
            font-size: 0.85rem;
            color: #666;
        }

        .alert-meta i {
            margin-right: 5px;
        }

        .alert-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-actions button {
            background: none;
            border: none;
            font-size: 1rem;
            cursor: pointer;
            color: var(--dark-gray);
            transition: all 0.3s;
            padding: 5px;
            border-radius: 4px;
        }

        .alert-actions button:hover {
            background-color: rgba(0,0,0,0.05);
            color: var(--primary);
        }

        .no-alerts {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            animation: modalFadeIn 0.3s ease-out;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-header {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            color: var(--primary);
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 2px rgba(153,0,0,0.2);
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: var(--primary);
            color: white;
            padding: 15px 20px;
            border-radius: 4px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            z-index: 1001;
            animation: toastSlideIn 0.3s ease-out;
            transform: translateY(100px);
            opacity: 0;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        @keyframes toastSlideIn {
            from { transform: translateY(100px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .toast i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .toast.success {
            background-color: var(--success);
        }

        .toast.error {
            background-color: var(--danger);
        }

        .toast.warning {
            background-color: var(--warning);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
                overflow: hidden;
            }
            
            .sidebar:hover {
                width: 250px;
            }
            
            .logo img {
                width: 40px;
            }
            
            .main-content {
                margin-left: 70px;
            }
            
            .sidebar:hover + .main-content {
                margin-left: 250px;
            }
            
            .nav-item span {
                opacity: 0;
                transition: opacity 0.3s;
            }
            
            .sidebar:hover .nav-item span {
                opacity: 1;
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 10px 0;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .user-info {
                margin-top: 10px;
            }
            
            .modal-content {
                width: 95%;
            }
        }
        
        @media (max-width: 576px) {
            .management-tabs {
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 5px;
            }
            
            .course-table, .curriculum-table {
                display: block;
                overflow-x: auto;
            }
            
            .alert-item {
                flex-direction: column;
            }
            
            .alert-actions {
                margin-top: 10px;
                align-self: flex-end;
            }
        }
    </style>
</head>
<body>
    <div class="chairperson-container">
        <div class="sidebar">
            <div class="logo">
                <img src="../Images/Excel.png" alt="ExcelLens Logo">
                <h3>Chairperson Portal</h3>
            </div>
            
            <div class="nav-menu">
                <div class="nav-item active" onclick="showModule('program-management')">
                    <i class="fas fa-tasks"></i>
                    <span>Program Management</span>
                </div>
                <div class="nav-item" onclick="showModule('alerts')">
                    <i class="fas fa-bell"></i>
                    <span>Alerts</span>
                </div>
                <div class="nav-item" onclick="showModule('reports')">
                    <i class="fas fa-chart-bar"></i>
                    <span>Reports</span>
                </div>
                <div class="nav-item" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </div>
            </div>
        </div>
        
        <div class="main-content">
            <div class="header">
                <h2>Department/Program Chair Dashboard</h2>
                <div class="user-info">
                    <img src="https://via.placeholder.com/40" alt="Chairperson Avatar">
                    <span>Dr. Juan Dela Cruz</span>
                    <span style="margin-left: 10px; font-size: 0.9rem; color: #666;">(Computer Science Department)</span>
                </div>
            </div>
            
            <div id="program-management" class="module-container">
                <h2 class="module-title"><i class="fas fa-tasks"></i> Program Management</h2>
                
                <div class="management-tabs">
                    <div class="management-tab active" onclick="showManagementTab('curriculum')">Curriculum Management</div>
                    <div class="management-tab" onclick="showManagementTab('faculty-loading')">Faculty Loading</div>
                    <div class="management-tab" onclick="showManagementTab('course-scheduling')">Course Scheduling</div>
                </div>
                
                <div id="curriculum-management" class="management-content">
                    <h3>Import Curriculum</h3>
                    <div class="import-box" id="import-box" onclick="document.getElementById('pdf-upload').click()">
                        <i class="fas fa-file-import"></i>
                        <p>Drag and drop your curriculum PDF file here or click to browse</p>
                        <input type="file" id="csv-upload" accept=".pdf" style="display: none;">
                        <button class="submit-btn">
                            <i class="fas fa-folder-open"></i> Browse Files
                        </button>
                        <a href="#" class="download-template" onclick="downloadTemplate()">
                            <i class="fas fa-download"></i> Download PDF Template
                        </a>
                    </div>
                    
                    <h3>Current Curriculum</h3>
                    <div class="table-responsive">
                        <table class="curriculum-table">
                            <thead>
                                <tr>
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                    <th>Units</th>
                                    <th>Prerequisites</th>
                                    <th>Year Level</th>
                                    <th>Semester</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="curriculum-table-body">
                                <tr>
                                    <td>CS 101</td>
                                    <td>Introduction to Computer Science</td>
                                    <td>3</td>
                                    <td>None</td>
                                    <td>1st Year</td>
                                    <td>1st Semester</td>
                                    <td>
                                        <button class="action-btn edit-btn" onclick="editCourse('CS101')">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="action-btn delete-btn" onclick="deleteCourse('CS101')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>CS 201</td>
                                    <td>Data Structures and Algorithms</td>
                                    <td>3</td>
                                    <td>CS 101</td>
                                    <td>2nd Year</td>
                                    <td>1st Semester</td>
                                    <td>
                                        <button class="action-btn edit-btn" onclick="editCourse('CS201')">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="action-btn delete-btn" onclick="deleteCourse('CS201')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <button class="submit-btn" onclick="showAddCourseModal()">
                        <i class="fas fa-plus"></i> Add New Course
                    </button>
                </div>
                
                <div id="faculty-loading" class="management-content" style="display: none;">
                    <div class="semester-selector">
                        <label for="semester">Select Semester: </label>
                        <select id="semester" class="faculty-select" onchange="loadFacultyAssignments()">
                            <option value="1st-2023">1st Semester 2023-2024</option>
                            <option value="2nd-2023">2nd Semester 2023-2024</option>
                            <option value="summer-2024">Summer 2024</option>
                        </select>
                        
                        <label for="department" style="margin-left: 15px;">Department: </label>
                        <select id="department" class="faculty-select">
                            <option value="CS">Computer Science</option>
                            <option value="IT">Information Technology</option>
                            <option value="IS">Information Systems</option>
                        </select>
                    </div>
                    
                    <h3>Course Assignments</h3>
                    <div class="table-responsive">
                        <table class="course-table">
                            <thead>
                                <tr>
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                    <th>Schedule</th>
                                    <th>Section</th>
                                    <th>Assigned Faculty</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="faculty-assignments-body">
                                <tr>
                                    <td>CS 101</td>
                                    <td>Introduction to Computer Science</td>
                                    <td>MWF 8:00-9:00 AM</td>
                                    <td>CS-401</td>
                                    <td>
                                        <select class="faculty-select" id="faculty-CS101-401">
                                            <option value="">Select Faculty</option>
                                            <option value="1" selected>Prof. Maria Santos</option>
                                            <option value="2">Prof. John Smith</option>
                                            <option value="3">Prof. Anna Reyes</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button class="action-btn save-btn" onclick="saveFacultyAssignment('CS101-401')">
                                            <i class="fas fa-save"></i> Save
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>CS 201</td>
                                    <td>Data Structures and Algorithms</td>
                                    <td>TTH 1:00-2:30 PM</td>
                                    <td>CS-402</td>
                                    <td>
                                        <select class="faculty-select" id="faculty-CS201-402">
                                            <option value="">Select Faculty</option>
                                            <option value="1">Prof. Maria Santos</option>
                                            <option value="2" selected>Prof. John Smith</option>
                                            <option value="3">Prof. Anna Reyes</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button class="action-btn save-btn" onclick="saveFacultyAssignment('CS201-402')">
                                            <i class="fas fa-save"></i> Save
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <button class="submit-btn" onclick="finalizeFacultyLoading()">
                        <i class="fas fa-check-circle"></i> Finalize Faculty Loading
                    </button>
                </div>
                
                <div id="course-scheduling" class="management-content" style="display: none;">
                    <h3>Course Scheduling Coming Soon</h3>
                    <p>This feature is currently under development and will be available in the next update.</p>
                </div>
            </div>

            <div id="alerts" class="module-container" style="display: none;">
                <h2 class="module-title"><i class="fas fa-bell"></i> Automated Alerts</h2>
                <div class="alerts-section">
                    <div class="alerts-header">
                        <h3>Recent Alerts</h3>
                        <div class="alerts-actions">
                            <button class="filter-btn active" onclick="filterAlerts('all')">All</button>
                            <button class="filter-btn" onclick="filterAlerts('warning')">Warnings</button>
                            <button class="filter-btn" onclick="filterAlerts('danger')">Critical</button>
                            <button class="filter-btn" onclick="filterAlerts('success')">Success</button>
                        </div>
                    </div>
                    
                    <div id="alerts-list">
                        <div class="alert-item warning">
                            <div class="alert-content">
                                <p><i class="fas fa-exclamation-triangle"></i> High percentage (35%) of failing students in CS 101. Intervention suggested.</p>
                                <div class="alert-meta">
                                    <i class="fas fa-calendar-alt"></i> <span>Today, 10:45 AM</span>
                                    <i class="fas fa-user" style="margin-left: 15px;"></i> <span>25 students affected</span>
                                </div>
                            </div>
                            <div class="alert-actions">
                                <button title="View Details" onclick="viewAlertDetails('alert1')"><i class="fas fa-eye"></i></button>
                                <button title="Dismiss" onclick="dismissAlert('alert1')"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="alert-item danger">
                            <div class="alert-content">
                                <p><i class="fas fa-exclamation-circle"></i> Student John Doe (ID: 12345) has 3 consecutive absences in MATH 201.</p>
                                <div class="alert-meta">
                                    <i class="fas fa-calendar-alt"></i> <span>Yesterday, 3:22 PM</span>
                                    <i class="fas fa-user" style="margin-left: 15px;"></i> <span>1 student affected</span>
                                </div>
                            </div>
                            <div class="alert-actions">
                                <button title="View Details" onclick="viewAlertDetails('alert2')"><i class="fas fa-eye"></i></button>
                                <button title="Dismiss" onclick="dismissAlert('alert2')"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="alert-item success">
                            <div class="alert-content">
                                <p><i class="fas fa-star"></i> Student Jane Smith (ID: 67890) consistently excelling in all courses. Recommend enrichment.</p>
                                <div class="alert-meta">
                                    <i class="fas fa-calendar-alt"></i> <span>2 days ago</span>
                                    <i class="fas fa-user" style="margin-left: 15px;"></i> <span>1 student affected</span>
                                </div>
                            </div>
                            <div class="alert-actions">
                                <button title="View Details" onclick="viewAlertDetails('alert3')"><i class="fas fa-eye"></i></button>
                                <button title="Dismiss" onclick="dismissAlert('alert3')"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="alert-item info">
                            <div class="alert-content">
                                <p><i class="fas fa-info-circle"></i> Curriculum review for CS program is due in 2 weeks.</p>
                                <div class="alert-meta">
                                    <i class="fas fa-calendar-alt"></i> <span>3 days ago</span>
                                </div>
                            </div>
                            <div class="alert-actions">
                                <button title="View Details" onclick="viewAlertDetails('alert4')"><i class="fas fa-eye"></i></button>
                                <button title="Dismiss" onclick="dismissAlert('alert4')"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <p style="margin-top: 15px; font-size: 0.9rem; color: #666;">
                        <i class="fas fa-info-circle"></i> Alerts are generated based on predefined system rules and highlight critical academic events.
                    </p>
                </div>
            </div>

            <div id="reports" class="module-container" style="display: none;">
                <h2 class="module-title"><i class="fas fa-chart-bar"></i> Reports</h2>
                <div class="alerts-section">
                    <h3>Academic Performance Reports</h3>
                    <p>This section will contain various academic reports and analytics.</p>
                    <div style="display: flex; gap: 15px; margin-top: 20px; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 250px; background: white; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                            <h4><i class="fas fa-chart-pie"></i> Course Performance</h4>
                            <p>View performance metrics by course</p>
                            <button class="submit-btn" style="margin-top: 10px; width: 100%;" onclick="generateReport('course-performance')">
                                Generate Report
                            </button>
                        </div>
                        <div style="flex: 1; min-width: 250px; background: white; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                            <h4><i class="fas fa-users"></i> Faculty Workload</h4>
                            <p>View faculty teaching assignments</p>
                            <button class="submit-btn" style="margin-top: 10px; width: 100%;" onclick="generateReport('faculty-workload')">
                                Generate Report
                            </button>
                        </div>
                        <div style="flex: 1; min-width: 250px; background: white; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                            <h4><i class="fas fa-graduation-cap"></i> Student Progress</h4>
                            <p>Track student academic progress</p>
                            <button class="submit-btn" style="margin-top: 10px; width: 100%;" onclick="generateReport('student-progress')">
                                Generate Report
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Course Modal -->
    <div class="modal" id="add-course-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Course</h3>
                <button class="close-modal" onclick="closeModal('add-course-modal')">&times;</button>
            </div>
            <div class="modal-body">
                <form id="add-course-form">
                    <div class="form-group">
                        <label for="course-code">Course Code</label>
                        <input type="text" id="course-code" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="course-title">Course Title</label>
                        <input type="text" id="course-title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="course-units">Units</label>
                        <input type="number" id="course-units" class="form-control" min="1" max="6" required>
                    </div>
                    <div class="form-group">
                        <label for="course-prerequisites">Prerequisites</label>
                        <input type="text" id="course-prerequisites" class="form-control" placeholder="Separate multiple courses with commas">
                    </div>
                    <div class="form-group">
                        <label for="course-year">Year Level</label>
                        <select id="course-year" class="form-control" required>
                            <option value="">Select Year Level</option>
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="course-semester">Semester</label>
                        <select id="course-semester" class="form-control" required>
                            <option value="">Select Semester</option>
                            <option value="1st Semester">1st Semester</option>
                            <option value="2nd Semester">2nd Semester</option>
                            <option value="Summer">Summer</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="action-btn" onclick="closeModal('add-course-modal')">Cancel</button>
                <button class ="submit-btn" onclick="addCourse()">
                    <i class="fas fa-plus"></i> Add Course
                </button>
            </div>

        </div>
    </div>
    <!-- Toast Notification -->
    <div class="toast" id="toast-notification">
        <i class="fas fa-check-circle"></i>
        <span id="toast-message">Course added successfully!</span>
        <button class="close-toast" onclick="closeToast()">&times;</button>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script>
        function showModule(module) {
            const modules = document.querySelectorAll('.module-container');
            modules.forEach(m => m.style.display = 'none');
            document.getElementById(module).style.display = 'block';
            
            const navItems = document.querySelectorAll('.nav-item');
            navItems.forEach(item => item.classList.remove('active'));
            document.querySelector(`.nav-item[onclick="showModule('${module}')"]`).classList.add('active');
        }

        function showManagementTab(tab) {
            const tabs = document.querySelectorAll('.management-content');
            tabs.forEach(t => t.style.display = 'none');
            document.getElementById(tab + '-management').style.display = 'block';
            
            const managementTabs = document.querySelectorAll('.management-tab');
            managementTabs.forEach(t => t.classList.remove('active'));
            document.querySelector(`.management-tab[onclick="showManagementTab('${tab}')"]`).classList.add('active');
        }

        function logout() {
            // Implement logout functionality
            alert('Logging out...');
        }

        function downloadTemplate() {
            // Implement CSV template download
            alert('Downloading CSV template...');
        }

        function showAddCourseModal() {
            document.getElementById('add-course-modal').style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function addCourse() {
            // Implement course addition logic
            const courseCode = document.getElementById('course-code').value;
            const courseTitle = document.getElementById('course-title').value;
            const courseUnits = document.getElementById('course-units').value;
            const coursePrerequisites = document.getElementById('course-prerequisites').value;
            const courseYear = document.getElementById('course-year').value;
            const courseSemester = document.getElementById('course-semester').value;

            if (courseCode && courseTitle && courseUnits && courseYear && courseSemester) {
                // Add the new course to the curriculum table
                const tbody = document.getElementById('curriculum-table-body');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${courseCode}</td>
                    <td>${courseTitle}</td>
                    <td>${courseUnits}</td>
                    <td>${coursePrerequisites || 'None'}</td>
                    <td>${courseYear}</td>
                    <td>${courseSemester}</td>
                    <td>
                        <button class="action-btn edit-btn" onclick="editCourse('${courseCode}')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="action-btn delete-btn" onclick="deleteCourse('${courseCode}')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                `;
                tbody.appendChild(newRow);
                closeModal('add-course-modal');
                showToast('Course added successfully!', 'success');
            } else {
                alert('Please fill in all required fields.');
            }

        }
        function editCourse(courseCode) {
            // Implement course editing logic
            alert(`Editing course: ${courseCode}`);
        }
        function deleteCourse(courseCode) {
            // Implement course deletion logic
            const tbody = document.getElementById('curriculum-table-body');
            const rows = tbody.querySelectorAll('tr');
            rows.forEach(row => {
                if (row.cells[0].textContent === courseCode) {
                    tbody.removeChild(row);
                }
            });
            showToast('Course deleted successfully!', 'success');
        }
        function showToast(message, type) {
            const toast = document.getElementById('toast-notification');
            const toastMessage = document.getElementById('toast-message');
            toastMessage.textContent = message;
            toast.className = `toast ${type}`;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }
        function closeToast() {
            const toast = document.getElementById('toast-notification');
            toast.classList.remove('show');
        }
        function filterAlerts(type) {
            const alerts = document.querySelectorAll('.alert-item');
            alerts.forEach(alert => {
                if (type === 'all' || alert.classList.contains(type)) {
                    alert.style.display = 'flex';
                } else {
                    alert.style.display = 'none';
                }
            });
            
            const filterButtons = document.querySelectorAll('.filter-btn');
            filterButtons.forEach(btn => btn.classList.remove('active'));
            document.querySelector(`.filter-btn[onclick="filterAlerts('${type}')"]`).classList.add('active');
        }
        function viewAlertDetails(alertId) {
            // Implement alert details viewing logic
            alert(`Viewing details for ${alertId}`);
        }
        function dismissAlert(alertId) {
            // Implement alert dismissal logic
            const alertItem = document.querySelector(`.alert-item.${alertId}`);
            if (alertItem) {
                alertItem.style.display = 'none';
                showToast('Alert dismissed successfully!', 'success');
            }
        }
        function loadFacultyAssignments() {
            // Implement logic to load faculty assignments based on selected semester and department
            const semester = document.getElementById('semester').value;
            const department = document.getElementById('department').value;
            alert(`Loading faculty assignments for ${semester} in ${department} department...`);
        }
        function saveFacultyAssignment(assignmentId) {
            // Implement logic to save faculty assignment
            const facultySelect = document.getElementById(`faculty-${assignmentId}`);
            const selectedFaculty = facultySelect.value;
            if (selectedFaculty) {
                showToast(`Faculty assignment for ${assignmentId} saved successfully!`, 'success');
            } else {
                alert('Please select a faculty member.');
            }
        }
        function finalizeFacultyLoading() {
            // Implement logic to finalize faculty loading
            alert('Faculty loading finalized successfully!');
            showToast('Faculty loading finalized successfully!', 'success');
        }
        function generateReport(reportType) {
            // Implement report generation logic
            alert(`Generating ${reportType} report...`);
            showToast(`${reportType.charAt(0).toUpperCase() + reportType.slice(1)} report generated successfully!`, 'success');
        }
        // Initial module display
        document.addEventListener('DOMContentLoaded', () => {
            showModule('program-management');
            showManagementTab('curriculum');
        });
    </script>
</body>
</html>
