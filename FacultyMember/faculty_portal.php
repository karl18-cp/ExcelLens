<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExcelLens - Academic Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="faculty.css">


<style>
 :root {
            --primary: #990000;
            --primary-light: #b30000;
            --primary-dark: #660000;
            --secondary: #f8f0f0;
            --light-gray: #f5f5f5;
            --dark-gray: #333;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --info: #17a2b8;
            --white: #ffffff;
            --border-color: #e3e6ea;
            --text-muted: #6c757d;
            --shadow: 0 2px 10px rgba(0,0,0,0.1);
            --shadow-lg: 0 8px 30px rgba(0,0,0,0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--light-gray);
            color: var(--dark-gray);
            line-height: 1.6;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            transition: all 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-header h4 {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .sidebar-header h4 {
            opacity: 0;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-section-title {
            padding: 0.75rem 1rem;
            font-size: 0.75rem; /* Smaller font size */
            font-weight: 600;   /* Bold */
            color: rgba(255,255,255,0.5); /* Muted white */
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-top: 1rem; /* Space above title */
            transition: opacity 0.3s ease, height 0.3s ease, padding 0.3s ease, margin 0.3s ease; /* Added for smooth collapse */
        }

        .sidebar.collapsed .nav-section-title {
            opacity: 0; /* Hide title when collapsed */
            height: 0; /* Collapse space */
            padding: 0;
            margin: 0;
            overflow: hidden;
        }

        /* Adjust margin for the first section title if needed */
        .sidebar-nav > .nav-section-title:first-child {
            margin-top: 0;
        }


        .nav-item {
            margin: 0.25rem 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 0;
            gap: 0.75rem;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: var(--white);
            border-left: 3px solid var(--white);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .nav-text {
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .nav-text {
            opacity: 0;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
        }

        .main-content.expanded {
            margin-left: 70px;
        }

        /* Top Navigation */
        .top-nav {
            background: var(--white);
            box-shadow: var(--shadow);
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .toggle-btn {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: var(--dark-gray);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease;
        }

        .toggle-btn:hover {
            background: var(--light-gray);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 600;
        }

        /* Dashboard Content */
        .dashboard-content {
            padding: 2rem 1.5rem;
        }

        .page-title {
            margin-bottom: 2rem;
        }

        .page-title h1 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 0.5rem;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
            font-size: 0.875rem;
        }

        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
        }

        /* Cards */
        .dashboard-card {
            background: var(--white);
            border-radius: 0.75rem;
            box-shadow: var(--shadow);
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 1.5rem; /* Added margin for spacing between cards */
        }

        .dashboard-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .card-header {
            background: none;
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
            font-weight: 600;
            color: var(--dark-gray);
        }
        .card-header .nav-tabs { /* Ensure tabs in card header are styled well */
            border-bottom: none;
            margin-bottom: -1.5rem; /* Adjust to align with padding */
        }
        .card-header .nav-tabs .nav-link {
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
            color: var(--text-muted);
        }
         .card-header .nav-tabs .nav-link.active {
            color: var(--primary);
            background-color: var(--white);
            border-color: var(--border-color) var(--border-color) var(--white);
        }


        .card-body {
            padding: 1.5rem;
        }

        /* Stats Cards */
        .stats-card {
            background: var(--white);
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            border-left: 4px solid var(--primary);
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-2px);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stats-icon.primary {
            background: rgba(153, 0, 0, 0.1);
            color: var(--primary);
        }

        .stats-icon.success {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }

        .stats-icon.warning {
            background: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }

        .stats-icon.info {
            background: rgba(23, 162, 184, 0.1);
            color: var(--info);
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 0.5rem;
        }

        .stats-label {
            color: var(--text-muted);
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--primary-light);
            border-color: var(--primary-light);
            transform: translateY(-1px);
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
            font-weight: 500;
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            border-color: var(--primary);
        }

        /* Tables */
        .table {
            background: var(--white);
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .table thead th {
            background: var(--secondary);
            border: none;
            font-weight: 600;
            color: var(--dark-gray);
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            border-color: var(--border-color);
            vertical-align: middle;
        }

        /* Forms */
        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(153, 0, 0, 0.25);
        }

        /* Alerts */
        .alert {
            border-radius: 0.75rem;
            border: none;
            padding: 1rem 1.5rem;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }

        .alert-warning {
            background: rgba(255, 193, 7, 0.1);
            color: #856404;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }

        .alert-info {
            background: rgba(23, 162, 184, 0.1);
            color: var(--info);
        }

        /* CQI Recommendations */
        .cqi-recommendation {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-left: 4px solid var(--info);
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .cqi-recommendation h6 {
            color: var(--info);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        /* Progress bars */
        .progress {
            height: 8px;
            border-radius: 10px;
            background: var(--light-gray);
        }

        .progress-bar {
            background: var(--primary);
            border-radius: 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .dashboard-content {
                padding: 1rem;
            }
        }

        /* Module specific styles */
        .module-card {
            background: var(--white);
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .module-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        .module-icon {
            width: 50px;
            height: 50px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            background: rgba(153, 0, 0, 0.1);
            color: var(--primary);
        }

        .file-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: 0.75rem;
            padding: 2rem;
            text-align: center;
            background: var(--light-gray);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-area:hover {
            border-color: var(--primary);
            background: rgba(153, 0, 0, 0.05);
        }

        .grade-table {
            font-size: 0.875rem;
        }

        .grade-input {
            width: 80px;
            padding: 0.25rem 0.5rem;
            border: 1px solid var(--border-color);
            border-radius: 0.25rem;
            text-align: center;
        }

        .course-work-upload-section {
            background-color: var(--secondary);
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
        }
    </style>
</head>
<body>
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h4>ExcelLens</h4>
        </div>
        <ul class="sidebar-nav list-unstyled">
            <li class="nav-section-title"><span class="nav-text">Overview</span></li>
            <li class="nav-item">
                <a href="#dashboard" class="nav-link active" data-section="dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li class="nav-section-title"><span class="nav-text">Management</span></li>
            <li class="nav-item">
                <a href="#course-management" class="nav-link" data-section="course-management">
                    <i class="fas fa-book"></i>
                    <span class="nav-text">Course Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#class-management" class="nav-link" data-section="class-management">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">Class Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#coursework" class="nav-link" data-section="coursework">
                    <i class="fas fa-tasks"></i>
                    <span class="nav-text">Course Work</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#grade-computation" class="nav-link" data-section="grade-computation">
                    <i class="fas fa-calculator"></i>
                    <span class="nav-text">Grade Computation</span>
                </a>
            </li>

            <li class="nav-section-title"><span class="nav-text">Tools & Reports</span></li>
            <li class="nav-item">
                <a href="#analytics" class="nav-link" data-section="analytics">
                    <i class="fas fa-chart-line"></i>
                    <span class="nav-text">Analytics & CQI</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#reports" class="nav-link" data-section="reports">
                    <i class="fas fa-file-alt"></i>
                    <span class="nav-text">Reports</span>
                </a>
            </li>

            <li class="nav-section-title"><span class="nav-text">System</span></li>
            <li class="nav-item">
                <a href="#settings" class="nav-link" data-section="settings">
                    <i class="fas fa-cog"></i>
                    <span class="nav-text">Settings</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="main-content" id="mainContent">
        <nav class="top-nav">
            <button class="toggle-btn" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
            <div class="user-profile">
                <span class="me-3">Welcome, <strong>Prof. John Doe</strong></span>
                <div class="user-avatar">JD</div>
            </div>
        </nav>

        <div class="dashboard-content">
            <div id="dashboard-section" class="content-section">
                <div class="page-title">
                    <h1>Dashboard</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </nav>
                </div>

                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="stats-card">
                            <div class="stats-icon primary">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="stats-number">12</div>
                            <div class="stats-label">Active Courses</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="stats-card">
                            <div class="stats-icon success">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stats-number">324</div>
                            <div class="stats-label">Total Students</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="stats-card">
                            <div class="stats-icon warning">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <div class="stats-number">48</div>
                            <div class="stats-label">Pending Assessments</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="stats-card">
                            <div class="stats-icon info">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="stats-number">87%</div>
                            <div class="stats-label">Average Grade</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="dashboard-card">
                            <div class="card-header">
                                <h5 class="mb-0">Recent Activities</h5>
                            </div>
                            <div class="card-body">
                                <div class="activity-item d-flex align-items-center mb-3">
                                    <div class="activity-icon bg-primary text-white rounded-circle p-2 me-3">
                                        <i class="fas fa-upload"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Class list uploaded for CS101</h6>
                                        <small class="text-muted">2 hours ago</small>
                                    </div>
                                </div>
                                <div class="activity-item d-flex align-items-center mb-3">
                                    <div class="activity-icon bg-success text-white rounded-circle p-2 me-3">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Midterm grades computed for MATH201</h6>
                                        <small class="text-muted">4 hours ago</small>
                                    </div>
                                </div>
                                <div class="activity-item d-flex align-items-center">
                                    <div class="activity-icon bg-info text-white rounded-circle p-2 me-3">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">CIS uploaded for ENG301</h6>
                                        <small class="text-muted">1 day ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="dashboard-card">
                            <div class="card-header">
                                <h5 class="mb-0">Quick Actions</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" data-section="class-management">
                                        <i class="fas fa-upload me-2"></i>Upload Class List
                                    </button>
                                    <button class="btn btn-outline-primary" data-section="coursework">
                                        <i class="fas fa-plus me-2"></i>Create Assessment
                                    </button>
                                    <button class="btn btn-outline-primary" data-section="grade-computation">
                                        <i class="fas fa-calculator me-2"></i>Compute Grades
                                    </button>
                                    <button class="btn btn-outline-primary" data-section="reports">
                                        <i class="fas fa-download me-2"></i>Generate Reports
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="course-management-section" class="content-section" style="display: none;">
                <div class="page-title">
                    <h1>Course Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#dashboard" class="sidebar-link" data-section="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Course Management</li>
                        </ol>
                    </nav>
                </div>

                <div class="dashboard-card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="courseManagementTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="my-courses-tab" data-bs-toggle="tab" data-bs-target="#myCoursesContent" type="button" role="tab" aria-controls="myCoursesContent" aria-selected="true">My Courses</button>
                            </li>
                            
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="cis-upload-tab" data-bs-toggle="tab" data-bs-target="#cisUploadContent" type="button" role="tab" aria-controls="cisUploadContent" aria-selected="false">CIS Upload</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="courseManagementTabsContent">
                            <div class="tab-pane fade show active" id="myCoursesContent" role="tabpanel" aria-labelledby="my-courses-tab">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">My Directly Managed Courses</h5>
                                    
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Course Code</th>
                                                <th>Course Title</th>
                                                <th>Section</th>
                                                <th>Students</th>
                                                <th>Status</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>CS101</strong></td>
                                                <td>Introduction to Computer Science</td>
                                                <td>A</td>
                                                <td>32</td>
                                                <td><span class="badge bg-success">Active</span></td>
                                                
                                            </tr>
                                            <tr>
                                                <td><strong>MATH201</strong></td>
                                                <td>Calculus I</td>
                                                <td>B</td>
                                                <td>28</td>
                                                <td><span class="badge bg-success">Active</span></td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="cisUploadContent" role="tabpanel" aria-labelledby="cis-upload-tab">
                                <h5 class="mb-3">Course Information Syllabus (CIS) Upload</h5>
                                <div class="file-upload-area" onclick="document.getElementById('cisFile').click()">
                                    <i class="fas fa-file-pdf fa-3x text-muted mb-3"></i>
                                    <h6>Upload Course Information Syllabus</h6>
                                    <p class="text-muted small">Drop PDF file here or click to browse. This will help automate grading component setup.</p>
                                    <input type="file" id="cisFile" accept=".pdf" style="display: none;" onchange="displayFileName('cisFile', 'cisFileNameDisplay')">
                                </div>
                                <div id="cisFileNameDisplay" class="mt-2 text-muted small"></div>
                                <div class="mt-3">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <small>The system will attempt to automatically extract assessment types and grading weights using OCR technology from the uploaded CIS. You can verify and edit this information later.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="class-management-section" class="content-section" style="display: none;">
                <div class="page-title">
                    <h1>Class Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#dashboard" class="sidebar-link" data-section="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Class Management</li>
                        </ol>
                    </nav>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard-card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Student Management</h5>
                                <div style="display: flex; gap: 10px; align-items: center;">
  <button class="btn btn-primary btn-sm"
          onclick="document.getElementById('classListFile').click()"
          title="Upload class list using the standardized PDF template">
    <i class="fas fa-upload me-1"></i>Upload Class List
  </button>

  <button id="confirmBtn" class="btn btn-success btn-sm" style="display: none;" onclick="confirmUploadedFile()">
    <i class="fas fa-check me-1"></i>Confirm File
  </button>

  <input type="file"
         id="classListFile"
         accept=".pdf"
         style="display: none;"
         onchange="handleClassListUpload(this)">
</div>
                            </div>
                            <div class="card-body">
                                <div id="classListFileNameDisplay" class="mb-2 text-muted small"></div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <select class="form-control">
                                            <option>Select Course</option>
                                            <option>CS101 - Introduction to Computer Science</option>
                                            <option>MATH201 - Calculus I</option>
                                            <option>ENG301 - Technical Writing</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Search students (SR-CODE or Name)...">
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-outline-primary">
                                            <i class="fas fa-filter me-1"></i>Filter
                                        </button>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>SR-CODE</th>
                                                <th>Student Name</th>
                                                <th>Email</th>
                                                <th>Course</th>
                                                <th>Section</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>2024-0001</strong></td>
                                                <td>Dela Cruz, Juan</td>
                                                <td>juan.delacruz@example.com</td>
                                                <td>CS101</td>
                                                <td>A</td>
                                                <td><span class="badge bg-success">Enrolled</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary me-1" title="Edit Student Details"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" title="Remove Student from Class"><i class="fas fa-user-minus"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>2024-0002</strong></td>
                                                <td>Garcia, Maria</td>
                                                <td>maria.garcia@example.com</td>
                                                <td>CS101</td>
                                                <td>A</td>
                                                <td><span class="badge bg-success">Enrolled</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary me-1" title="Edit Student Details"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" title="Remove Student from Class"><i class="fas fa-user-minus"></i></button>
                                                </td>
                                            </tr>
                                             <tr>
                                                <td><strong>2024-0003</strong></td>
                                                <td>Santos, Jose</td>
                                                <td>jose.santos@example.com</td>
                                                <td>MATH201</td>
                                                <td>B</td>
                                                <td><span class="badge bg-secondary">Dropped</span></td>
                                                 <td>
                                                    <button class="btn btn-sm btn-outline-primary me-1" title="Edit Student Details"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" title="Remove Student from Class"><i class="fas fa-user-minus"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="coursework-section" class="content-section" style="display: none;">
                <div class="page-title">
                    <h1>Course Work Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#dashboard" class="sidebar-link" data-section="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Course Work</li>
                        </ol>
                    </nav>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <select class="form-control" id="courseWorkCourseSelect">
                            <option selected disabled>Select Course to Manage Work...</option>
                            <option value="CS101">CS101 - Introduction to Computer Science</option>
                            <option value="MATH201">MATH201 - Calculus I</option>
                            <option value="ENG301">ENG301 - Technical Writing</option>
                        </select>
                    </div>
                </div>

                <div class="dashboard-card course-work-upload-section">
                    <div class="card-header">
                         <h5 class="mb-0">Course Work Material (e.g., Syllabus, Lecture Notes)</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">Upload general course materials like the detailed syllabus, lecture notes, or resource packs here. Specific assessments (quizzes, exams) are managed below.</p>
                        <div class="mb-3">
                            <label for="courseWorkPdfUpload" class="form-label">Upload PDF Material:</label>
                            <input type="file" class="form-control" id="courseWorkPdfUpload" accept=".pdf" onchange="displayFileName('courseWorkPdfUpload', 'courseWorkPdfFileNameDisplay')">
                            <div id="courseWorkPdfFileNameDisplay" class="mt-1 text-muted small"></div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-outline-secondary btn-sm me-2" id="saveCourseWorkMaterial" title="Saves current progress or draft of course work materials. Does not submit or finalize.">
                                <i class="fas fa-save me-1"></i>Save Work
                            </button>
                            <button class="btn btn-primary btn-sm" id="uploadCourseWorkMaterial" title="Uploads the selected PDF and links it to this course. For specific assessment scores (Quizzes, Exams etc.), use the respective tabs below.">
                                <i class="fas fa-cloud-upload-alt me-1"></i>Upload & Link Material
                            </button>
                        </div>
                         <small class="text-muted d-block">
                            <strong>Note:</strong> 'Save Work' might store your selections locally or as a draft. 'Upload & Link Material' finalizes the upload of the selected file for student access (actual functionality depends on system implementation).
                        </small>
                        <hr>
                        <h6>Uploaded Materials for this Course:</h6>
                        <div id="uploadedCourseWorkFiles" class="list-group list-group-flush">
                            <p class="text-muted small">No materials uploaded yet for the selected course.</p>
                        </div>
                    </div>
                </div>


                <div class="dashboard-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Assessments Management</h5>
                        <button class="btn btn-primary btn-sm" title="Create a new quiz, exam, assignment, etc.">
                            <i class="fas fa-plus me-1"></i>Add New Assessment
                        </button>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-3" id="assessmentTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="quizzes-tab" data-bs-toggle="tab" data-bs-target="#quizzes" type="button" role="tab" aria-controls="quizzes" aria-selected="true">Quizzes</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="exams-tab" data-bs-toggle="tab" data-bs-target="#exams" type="button" role="tab" aria-controls="exams" aria-selected="false">Examinations</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="assignments-tab" data-bs-toggle="tab" data-bs-target="#assignments" type="button" role="tab" aria-controls="assignments" aria-selected="false">Assignments</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="lab-activities-tab" data-bs-toggle="tab" data-bs-target="#lab-activities" type="button" role="tab" aria-controls="lab-activities" aria-selected="false">Lab Activities</button>
                            </li>
                             <li class="nav-item" role="presentation">
                                <button class="nav-link" id="other-assessments-tab" data-bs-toggle="tab" data-bs-target="#other-assessments" type="button" role="tab" aria-controls="other-assessments" aria-selected="false">Other</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="assessmentTabsContent">
                            <div class="tab-pane fade show active" id="quizzes" role="tabpanel" aria-labelledby="quizzes-tab">
                                <p class="text-muted">Manage quizzes for the selected course. Click "Add New Assessment" to create a quiz.</p>
                                <div class="table-responsive">
                                    <table class="table grade-table">
                                        <thead>
                                            <tr><th>Title</th><th>Due Date</th><th>Max Score</th><th>Status</th><th>Actions</th></tr>
                                        </thead>
                                        <tbody>
                                            <tr><td>Quiz 1: Basic Concepts</td><td>2024-09-15</td><td>20</td><td><span class="badge bg-success">Posted</span></td><td><button class="btn btn-sm btn-outline-primary" title="Edit Quiz"><i class="fas fa-edit"></i></button> <button class="btn btn-sm btn-outline-info" title="View Submissions"><i class="fas fa-eye"></i></button></td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="exams" role="tabpanel" aria-labelledby="exams-tab">
                                <p class="text-muted">Manage examinations. Ensure details match the Course Information Syllabus.</p>
                                 <div class="table-responsive">
                                    <table class="table grade-table">
                                        <thead>
                                            <tr><th>Title</th><th>Date</th><th>Max Score</th><th>Status</th><th>Actions</th></tr>
                                        </thead>
                                        <tbody>
                                            <tr><td>Midterm Exam</td><td>2024-10-20</td><td>100</td><td><span class="badge bg-warning text-dark">Upcoming</span></td><td><button class="btn btn-sm btn-outline-primary" title="Edit Exam"><i class="fas fa-edit"></i></button> <button class="btn btn-sm btn-outline-info" title="View Details"><i class="fas fa-eye"></i></button></td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="assignments" role="tabpanel" aria-labelledby="assignments-tab">
                                <p class="text-muted">Manage assignments. Define clear criteria for submissions.</p>
                                <div class="alert alert-light small">No assignments created yet for this course.</div>
                            </div>
                             <div class="tab-pane fade" id="lab-activities" role="tabpanel" aria-labelledby="lab-activities-tab">
                                <p class="text-muted">Manage laboratory activities and practical work.</p>
                                <div class="alert alert-light small">No lab activities created yet for this course.</div>
                            </div>
                            <div class="tab-pane fade" id="other-assessments" role="tabpanel" aria-labelledby="other-assessments-tab">
                                <p class="text-muted">Manage other types of assessments as defined in your CIS.</p>
                                <div class="alert alert-light small">No other assessments created yet for this course.</div>
                            </div>
                        </div>
                         <div class="mt-4">
                            <h5>Assessment Criteria & Weighting (from CIS)</h5>
                            <p class="text-muted small">Assessment criteria and their weights are typically populated from the uploaded CIS. You can review and adjust them if needed via Course Management.</p>
                            <div class="alert alert-info"><i class="fas fa-info-circle me-2"></i>Extracted from CIS for CS101: Quizzes (20%), Midterm Exam (30%), Assignments (25%), Final Exam (25%). <a href="#course-management" class="sidebar-link" data-section="course-management">Verify/Edit in Course Management</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="grade-computation-section" class="content-section" style="display: none;">
                <div class="page-title">
                    <h1>Grade Computation</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#dashboard" class="sidebar-link" data-section="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Grade Computation</li>
                        </ol>
                    </nav>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <select class="form-control" id="gradeCourseSelect">
                            <option selected disabled>Select Course for Grade Computation...</option>
                            <option value="CS101">CS101 - Introduction to Computer Science</option>
                            <option value="MATH201">MATH201 - Calculus I</option>
                            <option value="ENG301">ENG301 - Technical Writing</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7">
                        <div class="dashboard-card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Student Scores & Computation</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <button class="btn btn-primary me-2"><i class="fas fa-keyboard me-1"></i>Input Scores Manually</button>
                                    <button class="btn btn-outline-primary me-2" onclick="document.getElementById('googleClassroomScores').click()"><i class="fab fa-google me-1"></i>Import from Google Classroom</button>
                                    <input type="file" id="googleClassroomScores" style="display:none;" onchange="displayFileName('googleClassroomScores', 'googleScoresFileNameDisplay')">
                                     <button class="btn btn-outline-primary" onclick="document.getElementById('csvScores').click()"><i class="fas fa-file-csv me-1"></i>Upload Scores (CSV)</button>
                                    <input type="file" id="csvScores" accept=".csv" style="display:none;" onchange="displayFileName('csvScores', 'csvScoresFileNameDisplay')">
                                </div>
                                <div id="googleScoresFileNameDisplay" class="mb-1 text-muted small"></div>
                                <div id="csvScoresFileNameDisplay" class="mb-1 text-muted small"></div>
                                <div class="alert alert-info small">
                                    <i class="fas fa-info-circle me-2"></i>Ensure raw scores are entered. The system will automatically apply the transmutation table and grading formula based on the course's CIS.
                                </div>
                                <div class="table-responsive mt-3">
                                     <table class="table grade-table">
                                        <thead>
                                            <tr>
                                                <th>SR-CODE</th>
                                                <th>Student Name</th>
                                                <th>Quiz 1 (20)</th>
                                                <th>Assign 1 (50)</th>
                                                <th>Midterm (100)</th>
                                                <th>Final Grade</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>2024-0001</td>
                                                <td>Dela Cruz, Juan</td>
                                                <td><input type="number" class="grade-input" value="18"></td>
                                                <td><input type="number" class="grade-input" value="45"></td>
                                                <td><input type="number" class="grade-input" value="85"></td>
                                                <td><strong>92.50 (A)</strong></td>
                                                <td><span class="badge bg-success">Passed</span></td>
                                            </tr>
                                             <tr>
                                                <td>2024-0002</td>
                                                <td>Garcia, Maria</td>
                                                <td><input type="number" class="grade-input" value="15"></td>
                                                <td><input type="number" class="grade-input" value="38"></td>
                                                <td><input type="number" class="grade-input" value="72"></td>
                                                <td><strong>81.70 (B)</strong></td>
                                                <td><span class="badge bg-success">Passed</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3 d-flex justify-content-end">
                                    <button class="btn btn-success"><i class="fas fa-check me-1"></i>Finalize & Compute All Grades</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="dashboard-card">
                            <div class="card-header">
                                <h5 class="mb-0">Grade Reports & Transmutation</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted small">Once grades are computed, you can generate various reports.</p>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-outline-primary btn-sm"><i class="fas fa-file-csv me-2"></i>Download Class Record (CSV)</button>
                                    <button class="btn btn-outline-primary btn-sm"><i class="fas fa-file-csv me-2"></i>Download Class Standing (CSV)</button>
                                    <button class="btn btn-outline-primary btn-sm"><i class="fas fa-file-csv me-2"></i>Download Report of Grades (CSV)</button>
                                    <button class="btn btn-outline-primary btn-sm"><i class="fas fa-file-csv me-2"></i>Download Computation of Grades (CSV)</button>
                                </div>
                                <hr>
                                <h6 class="mt-3">Transmutation Table</h6>
                                <p class="text-muted small">The system uses a predefined transmutation table. <a href="#">View/Manage Table</a></p>
                                 <div class="progress mt-2" style="height: 10px;">
                                    <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="text-muted">Example: Raw Score 85/100 -> 92%</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="analytics-section" class="content-section" style="display: none;">
                <div class="page-title">
                    <h1>Analytics & CQI</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#dashboard" class="sidebar-link" data-section="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Analytics & CQI</li>
                        </ol>
                    </nav>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <select class="form-control" id="analyticsCourseSelect">
                            <option selected disabled>Select Course for Analytics...</option>
                            <option value="CS101">CS101 - Introduction to Computer Science</option>
                            <option value="MATH201">MATH201 - Calculus I</option>
                            <option value="ENG301">ENG301 - Technical Writing</option>
                            <option value="ALL">All My Courses</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="dashboard-card mb-4">
                             <div class="card-header">
                                <h5 class="mb-0">Performance Overview</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Showing analytics for <strong>CS101 - Introduction to Computer Science</strong>.</p>
                                <h6>Grade Distribution (Midterm)</h6>
                                <div class="progress mb-1"> <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">A (25%)</div></div>
                                <div class="progress mb-1"> <div class="progress-bar bg-info" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">B (35%)</div></div>
                                <div class="progress mb-1"> <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">C (20%)</div></div>
                                <div class="progress mb-3"> <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">D/F (20%)</div></div>

                                <h6>Passing vs. Failing (Overall)</h6>
                                <p><strong>Passing:</strong> 80%, <strong>Failing:</strong> 20%</p>
                            </div>
                        </div>
                         <div class="dashboard-card">
                             <div class="card-header">
                                <h5 class="mb-0">Traditional Reports</h5>
                            </div>
                            <div class="card-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action">Class Standings Report</a>
                                    <a href="#" class="list-group-item list-group-item-action">Student Progress Reports</a>
                                    <a href="#" class="list-group-item list-group-item-action">Passing/Failing Trends</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="dashboard-card">
                            <div class="card-header">
                                <h5 class="mb-0">CQI Recommendations</h5>
                            </div>
                            <div class="card-body">
                                <div class="cqi-recommendation">
                                    <h6><i class="fas fa-lightbulb me-2"></i>Low Midterm Performance</h6>
                                    <p class="small">More than 50% of students in <strong>CS101</strong> scored below C on the Midterm Exam.
                                        Consider:
                                        <ul>
                                            <li class="small">Conducting a review session for key topics.</li>
                                            <li class="small">Re-evaluating the clarity of test instructions.</li>
                                            <li class="small">Revising instructional materials for challenging concepts.</li>
                                        </ul>
                                    </p>
                                </div>
                                <div class="cqi-recommendation">
                                    <h6><i class="fas fa-star me-2"></i>High Achiever Alert</h6>
                                    <p class="small">Student <strong>Anna Reyes (2024-0005)</strong> in <strong>MATH201</strong> has consistently scored above 95% on all assessments.
                                         Consider:
                                        <ul>
                                            <li class="small">Providing enrichment activities or advanced modules.</li>
                                        </ul>
                                    </p>
                                </div>
                                <div class="alert alert-warning small">
                                    <i class="fas fa-exclamation-triangle me-2"></i>These recommendations are auto-generated and intended for faculty reflection and planning.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="reports-section" class="content-section" style="display: none;">
                <div class="page-title">
                    <h1>Generate Reports</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#dashboard" class="sidebar-link" data-section="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Reports</li>
                        </ol>
                    </nav>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <select class="form-control" id="reportsCourseSelect">
                            <option selected disabled>Select Course to Generate Reports...</option>
                            <option value="CS101">CS101 - Introduction to Computer Science</option>
                            <option value="MATH201">MATH201 - Calculus I</option>
                            <option value="ENG301">ENG301 - Technical Writing</option>
                            <option value="ALL">General Reports (Not Course Specific)</option>
                        </select>
                    </div>
                </div>
                <div class="dashboard-card">
                    <div class="card-header">
                        <h5 class="mb-0">Available Reports</h5>
                    </div>
                    <div class="card-body">
                         <p class="text-muted small">Select a report type and click "Generate" or "Download". Some reports are course-specific.</p>
                        <div class="list-group">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Class List</span>
                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-download me-1"></i>Download (CSV)</button>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Course Assessment Summary</span>
                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-file-pdf me-1"></i>Generate (PDF)</button>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Student Grade Sheet (Per Student)</span>
                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-search me-1"></i>View/Select Student</button>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Class Records (as per Grade Computation)</span>
                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-download me-1"></i>Download (CSV)</button>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Class Standings (as per Grade Computation)</span>
                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-download me-1"></i>Download (CSV)</button>
                            </div>
                             <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Report of Grades (Final Grades - CSV)</span>
                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-download me-1"></i>Download (CSV)</button>
                            </div>
                             <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Computation of Grades (Detailed - CSV)</span>
                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-download me-1"></i>Download (CSV)</button>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Student Progress Reports (from Analytics)</span>
                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-chart-line me-1"></i>View in Analytics</button>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Passing/Failing Trends Report (from Analytics)</span>
                                 <button class="btn btn-sm btn-outline-primary"><i class="fas fa-chart-pie me-1"></i>View in Analytics</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="settings-section" class="content-section" style="display: none;">
                <div class="page-title">
                    <h1>Settings</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#dashboard" class="sidebar-link" data-section="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="dashboard-card mb-4">
                            <div class="card-header"><h5 class="mb-0">Profile Management</h5></div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="profileName" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="profileName" value="Prof. John Doe" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="profileEmail" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="profileEmail" value="john.doe@university.edu" readonly>
                                         <small class="text-muted">Contact admin to change primary details.</small>
                                    </div>
                                     <div class="mb-3">
                                        <label for="profileContact" class="form-label">Contact Number (Optional)</label>
                                        <input type="text" class="form-control" id="profileContact" placeholder="Enter your contact number">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </form>
                            </div>
                        </div>
                         <div class="dashboard-card">
                            <div class="card-header"><h5 class="mb-0">System Preferences</h5></div>
                            <div class="card-body">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" role="switch" id="emailNotifications" checked>
                                    <label class="form-check-label" for="emailNotifications">Receive Email Notifications</label>
                                </div>
                                 <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" role="switch" id="darkMode">
                                    <label class="form-check-label" for="darkMode">Dark Mode (Experimental)</label>
                                </div>
                                <button class="btn btn-outline-primary mt-2">Save Preferences</button>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="dashboard-card">
                            <div class="card-header"><h5 class="mb-0">Grading & Transmutation</h5></div>
                            <div class="card-body">
                                <p class="text-muted small">Default transmutation tables and grading policies are set at the institutional level. You may view them here.</p>
                                <button class="btn btn-info btn-sm mb-2"><i class="fas fa-table me-1"></i>View Institutional Transmutation Table</button>
                                <button class="btn btn-info btn-sm mb-2"><i class="fas fa-file-alt me-1"></i>View Grading Policy Document</button>
                                <div class="alert alert-secondary small mt-3">
                                   <i class="fas fa-university me-2"></i> For specific course grading components (e.g. weights for quizzes, exams), manage them under "Course Management" via CIS upload or manual setup.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="faculty.js"></script>
<script>
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const toggleSidebarBtn = document.getElementById('toggleSidebar');
    const navLinks = document.querySelectorAll('.sidebar-nav .nav-link, .breadcrumb-item a.sidebar-link, .quick-actions .btn[data-section]');

    // Function to display filename after selection (for multiple inputs)
    function displayFileName(inputId, displayId) {
        const input = document.getElementById(inputId);
        const display = document.getElementById(displayId);
        if (input && input.files.length > 0) {
            display.textContent = `Selected file: ${input.files[0].name}`;
        } else {
            display.textContent = '';
        }
    }
    
    // Function to handle section switching
    function showSection(sectionId) {
        document.querySelectorAll('.content-section').forEach(section => {
            section.style.display = 'none';
        });
        const activeSection = document.getElementById(sectionId + '-section');
        if (activeSection) {
            activeSection.style.display = 'block';
        }

        document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
            link.classList.remove('active');
            if (link.dataset.section === sectionId) {
                link.classList.add('active');
            }
        });
    }

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if(this.dataset.section) {
                 // For actual href links like breadcrumbs, prevent default if it's a section link
                if (this.getAttribute('href') && this.getAttribute('href').startsWith('#')) {
                    e.preventDefault();
                }
            }

            const sectionId = this.dataset.section;
            if (sectionId) {
                showSection(sectionId);
                // Update URL hash, but only if it's a primary navigation, not for quick action buttons that might also have data-section
                if(this.classList.contains('nav-link') || this.classList.contains('sidebar-link')) {
                    window.location.hash = sectionId;
                }
                

                // If sidebar is not collapsed and screen is small (mobile behavior)
                if (window.innerWidth <= 768 && !sidebar.classList.contains('collapsed') && sidebar.classList.contains('show')) {
                     sidebar.classList.remove('show'); // Hide sidebar on mobile after click
                }
            }
        });
    });
    
    // Initial section load based on hash or default to dashboard
    function loadInitialSection() {
        let sectionId = window.location.hash.substring(1);
        if (!sectionId || !document.getElementById(sectionId + '-section')) {
            sectionId = 'dashboard'; // Default section
        }
        showSection(sectionId);
         // Ensure the correct sidebar link is active
        document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
            link.classList.remove('active');
            if (link.dataset.section === sectionId) {
                link.classList.add('active');
            }
        });

        // FIX: Explicitly activate the first tab in Assessments Management on load
        // This ensures the content is visible even if the sidebar hasn't been toggled.
        const quizzesTabButton = document.getElementById('quizzes-tab');
        if (quizzesTabButton) {
            const bsTab = new bootstrap.Tab(quizzesTabButton);
            bsTab.show();
        }
    }
    
    let desktopToggleHandler = () => {
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('expanded');
        // Toggle visibility of nav-section-title text, not the element itself
        document.querySelectorAll('.sidebar .nav-section-title .nav-text').forEach(titleText => {
            titleText.style.display = sidebar.classList.contains('collapsed') ? 'none' : '';
        });
    };
    
    let mobileToggleHandler = () => {
         sidebar.classList.toggle('show'); // Used for transform: translateX
    };

    // Responsive sidebar behavior for mobile
    function checkMobileSidebar() {
        if (toggleSidebarBtn) { // Ensure button exists
            toggleSidebarBtn.removeEventListener('click', desktopToggleHandler);
            toggleSidebarBtn.removeEventListener('click', mobileToggleHandler);

            if (window.innerWidth <= 768) {
                if(!sidebar.classList.contains('collapsed')) { 
                    sidebar.classList.add('collapsed'); 
                    mainContent.classList.add('expanded');
                }
                sidebar.classList.remove('show'); 
                toggleSidebarBtn.addEventListener('click', mobileToggleHandler);
            } else {
                sidebar.classList.remove('show'); 
                toggleSidebarBtn.addEventListener('click', desktopToggleHandler);
            }
            // Initial state for section titles based on sidebar state
            document.querySelectorAll('.sidebar .nav-section-title .nav-text').forEach(titleText => {
                 titleText.style.display = sidebar.classList.contains('collapsed') ? 'none' : '';
            });
        }
    }


    // Call on load and resize
    window.addEventListener('load', () => {
        loadInitialSection();
        checkMobileSidebar();
    });
    window.addEventListener('resize', checkMobileSidebar);

    // Add click listener to sidebar links for mobile to hide sidebar after navigation
    document.querySelectorAll('.sidebar .nav-link').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 768 && sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });
    });

     // Ensure nav-text within nav-section-title is also handled for collapse/expand
    if (toggleSidebarBtn) {
        toggleSidebarBtn.addEventListener('click', () => {
             // This is part of the desktopToggleHandler logic now
        });
    }

    let uploadedFile = null;

function handleClassListUpload(input) {
    uploadedFile = input.files[0];
    if (!uploadedFile) return;

    console.log(`Selected file: "${uploadedFile.name}"`);

    // Show confirm button
    document.getElementById('confirmBtn').style.display = 'inline-block';
}

function confirmUploadedFile() {
    if (!uploadedFile) {
        console.warn("No file uploaded.");
        return;
    }

    console.log(`✅ Confirmed: "${uploadedFile.name}" will now be sent.`);

    const formData = new FormData();
    formData.append('pdf', uploadedFile);

    fetch('insert_students_from_pdf.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        console.log(data.message || 'Upload complete.');
    })
    .catch(err => {
        console.error('Upload failed:', err.message);
    });

    // Optionally hide the confirm button after sending
    // document.getElementById('confirmBtn').style.display = 'none';
}

</script>
</body>
</html>