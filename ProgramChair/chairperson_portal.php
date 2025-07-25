

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExcelLens - Chairperson Portal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* CSS Variables */
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
            --blue: #1e88e5;
            --white: #ffffff;
            --border-color: #e3e6ea;
            --text-muted: #6c757d;
            --shadow: 0 2px 10px rgba(0,0,0,0.1);
            --shadow-lg: 0 8px 30px rgba(0,0,0,0.12);
            --sidebar-width: 260px;
            --sidebar-width-collapsed: 70px;
        }

        /* Base Styles */
        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--light-gray);
            color: var(--dark-gray);
        }

        /* Layout Container */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* Sidebar Styles */
        .sidebar {
            font-family: 'Inter', 'Segoe UI', Tahoma, Verdana, sans-serif;
            font-size: 16px;
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--white);
            color: var(--dark-gray);
            box-shadow: 2px 0 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: var(--sidebar-width-collapsed);
        }
        .sidebar.collapsed .logo-text,
        .sidebar.collapsed .nav-text,
        .sidebar.collapsed .nav-section-title,
        .sidebar.collapsed .toggle-arrow {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }
        .sidebar.collapsed .submenu {
            margin-left: 0.25rem;
            border-left: none;
        }
        .sidebar.collapsed .submenu .nav-item {
            padding-left: 1rem;
            justify-content: center;
        }
        .sidebar.collapsed .submenu .nav-text {
            display: none;
        }
        .sidebar.collapsed .submenu .nav-item i {
            margin: 0 auto;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.25rem;
        }
        .logo-toggle {
            background: none;
            border: none;
            color: var(--dark-gray);
            font-size: 1.25rem;
            cursor: pointer;
        }
        .logo img {
            height: 32px;
        }
        .logo-text {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary);
            transition: opacity 0.2s ease;
        }

        .nav-menu {
            padding: 1rem 0.5rem;
        }
        .nav-section + .nav-section {
            margin-top: 1.5rem;
        }
        
        /* Section Title Styling */
        .nav-section-title {
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-muted);
            letter-spacing: 1px;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 1rem;
            border-radius: 0.35rem 0 0 0.35rem;
            text-decoration: none;
            color: var(--dark-gray);
            font-weight: 500;
            transition: background 0.15s ease, color 0.15s ease;
            cursor: pointer;
            font-size: 16px;
        }
        .nav-item i {
            color: var(--dark-gray);
        }
        .nav-item:hover {
            background: rgba(0, 0, 0, 0.05);
        }
        .nav-item.active {
            background: rgba(153, 0, 0, 0.08);
            border-left: 4px solid var(--primary);
        }
        .nav-item.active i {
            color: var(--primary);
        }

        /* Submenu */
        .submenu {
            display: none;
            margin-left: 1rem;
            border-left: 2px solid rgba(153, 0, 0, 0.1);
        }
        .submenu .nav-item {
            padding-left: 1.5rem;
            font-size: 15px;
        }
        .submenu .nav-item.active {
            background: rgba(153, 0, 0, 0.08);
            border-left: 3px solid var(--primary);
            font-weight: 600;
        }
        .submenu .nav-item.active i {
            color: var(--primary);
        }
        .submenu.show {
            display: block;
        }

        /* Main Content Styles */
        .main-content {
            flex-grow: 1;
            padding: 20px;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
        }

        .sidebar.collapsed + .main-content {
            margin-left: var(--sidebar-width-collapsed);
        }

        /* Header Styles */
        .header {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 15px 20px;
            margin-bottom: 20px;
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: var(--shadow);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .theme-toggle {
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: var(--dark-gray);
        }

        .notification-icon {
            position: relative;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .notification-icon .notification-badge {
            position: absolute;
            top: -3px;
            right: -3px;
            width: 8px;
            height: 8px;
            background: var(--danger);
            border-radius: 50%;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .user-info img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }

        .user-details {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }

        .user-name {
            font-weight: 600;
        }

        .user-role {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        /* Content Area Styles */
        .content-area {
            background-color: var(--white);
            border-radius: 8px;
            padding: 20px;
            box-shadow: var(--shadow);
        }

        .content-area h1 {
            color: var(--primary-dark);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
            }
            
            .sidebar {
                width: 260px; /* Keep a fixed width for mobile slide-in */
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            
            /* Remove conflicting .collapsed styles for mobile */
            .sidebar.collapsed {
                width: 260px; /* It shouldn't collapse to icon-width on mobile */
            }

            .sidebar.collapsed + .main-content {
                margin-left: 0;
            }
        }


        /* Tabs Styles */
        .tabs {
            display: flex;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .tab-button {
            padding: 10px 15px;
            cursor: pointer;
            background-color: transparent;
            border: none;
            border-bottom: 3px solid transparent;
            font-size: 1em;
            color: var(--text-muted);
            transition: all 0.3s ease;
            margin-right: 5px;
        }

        .tab-button:hover {
            color: var(--primary-dark);
            border-color: var(--primary-light);
        }

        .tab-button.active {
            color: var(--primary);
            border-color: var(--primary);
            font-weight: bold;
        }

        .tab-content, .sub-tab-content {
            display: none;
            padding: 20px 0;
            animation: fadeIn 0.5s ease;
        }

        .tab-content.active, .sub-tab-content.active {
            display: block;
        }

        /* General UI Elements */
        .card {
            background-color: var(--white);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
        }

        .card-header {
            font-size: 1.2em;
            font-weight: bold;
            color: var(--primary-dark);
            margin-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: var(--dark-gray);
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            font-size: 1em;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(153, 0, 0, 0.25);
        }

        /* Button Styles - Improved with consistent color scheme */
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: var(--white);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .btn-primary { background-color: var(--primary); }
        .btn-primary:hover { background-color: var(--primary-light); }
        .btn-secondary { background-color: var(--text-muted); color: var(--white); }
        .btn-secondary:hover { background-color: #5a6268; }
        .btn-success { background-color: var(--success); }
        .btn-success:hover { background-color: #218838; }
        .btn-danger { background-color: var(--danger); }
        .btn-danger:hover { background-color: #c82333; }
        .btn-warning { background-color: var(--warning); color: var(--dark-gray); }
        .btn-warning:hover { background-color: #e0a800; }
        .btn-info { background-color: var(--info); }
        .btn-info:hover { background-color: #138496; }
        .btn-outline-primary {
            background-color: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
        }
        .btn-outline-primary:hover {
            background-color: var(--primary);
            color: var(--white);
        }
        
        /* New blue outline button for editing actions */
        .btn-blue-outline {
            background-color: transparent;
            color: var(--blue);
            border: 1px solid var(--blue);
        }
        .btn-blue-outline:hover {
            background-color: var(--blue);
            color: var(--white);
        }

       /* Enhanced Tables */
        .table-container {
            background: var(--white);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow);
            margin-top: 1.5rem;
        }

        .table-header {
            padding: 1rem 1.25rem;
            background: var(--light-gray);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            font-weight: 600;
            color: var(--dark-gray);
            font-size: 1.125rem;
        }

        .table-actions {
            display: flex;
            gap: 0.5rem;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            padding: 0.75rem 1rem;
            text-align: left;
            background: var(--light-gray);
            font-weight: 600;
            color: var(--dark-gray);
            border-bottom: 1px solid var(--border-color);
        }

        .data-table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .data-table tr:hover {
            background: var(--secondary);
        }


        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: var(--white);
            margin: auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            width: 90%;
            max-width: 600px;
            position: relative;
            animation: fadeIn 0.3s ease-out;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .modal-header h3 { margin: 0; color: var(--primary-dark); }

        .close-button {
            color: var(--dark-gray);
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close-button:hover,
        .close-button:focus { color: var(--danger); }

        .modal-footer {
            border-top: 1px solid var(--border-color);
            padding-top: 15px;
            margin-top: 20px;
            text-align: right;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        /* Toast Notifications */
        #toastContainer {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            background-color: var(--white);
            color: var(--dark-gray);
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 250px;
            max-width: 350px;
            opacity: 0;
            transform: translateX(100%);
            animation: slideIn 0.5s forwards, fadeOut 0.5s 4.5s forwards;
            border-left: 5px solid;
        }

        .toast.success { border-color: var(--success); }
        .toast.error { border-color: var(--danger); }
        .toast.info { border-color: var(--info); }
        .toast i { font-size: 1.5em; }
        .toast.success i { color: var(--success); }
        .toast.error i { color: var(--danger); }
        .toast.info i { color: var(--info); }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; transform: translateX(100%); }
        }

        /* PDF Upload Area */
        .pdf-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
            background-color: var(--light-gray);
        }

        .pdf-upload-area.drag-over {
            border-color: var(--primary);
            background-color: var(--secondary);
        }

        .pdf-upload-area p { margin: 0; color: var(--text-muted); }

        .pdf-upload-area i {
            color: var(--primary);
            transition: transform 0.3s ease;
        }

        .pdf-upload-area:hover i {
            transform: scale(1.1);
        }

        .pdf-upload-area input[type="file"] { display: none; }

        /* Alert Boxes */
        .alert-box {
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            background-color: var(--light-gray);
        }

        .alert-box.warning {
            border-left: 5px solid var(--warning);
        }

        .alert-box.danger {
            border-left: 5px solid var(--danger);
        }

        .alert-box.success {
            border-left: 5px solid var(--success);
        }

        .alert-content {
            flex-grow: 1;
        }

        .alert-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-dismiss {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-muted);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Make all tab headers red */
        .tab-content h2 {
          color: var(--primary);
          display: flex;
          align-items: center;
          font-size: 1.5rem;
          margin-bottom: 1rem;
        }

        /* Style the icon inside each header */
        .tab-content h2 i {
          color: var(--primary);
          margin-right: 0.5rem;
        }

        /* separator under each tab‐content heading */
        .sub-tab-separator {
          display: block;
          width: calc(100% + 40px);      /* 40px = 2 × your 20px horizontal padding */
          margin: 0.5rem -20px 1rem;      /* pull it out to the box edges */
          border: none;
          border-top: 1px solid var(--border-color);
        }
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .form-group.col-md-4 {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (min-width: 768px) {
            .form-group.col-md-4 {
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
            }
        }
        .mt-3 {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">
                <button class="logo-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <img src="../Images/Excel.png" alt="ExcelLens Logo" onerror="this.src='https://placehold.co/100x32/990000/fff?text=Logo';">
                <h3 class="logo-text">Chairperson Portal</h3>
            </div>
            <nav class="nav-menu">
                <div class="nav-section-title">GENERAL</div>
                <section class="nav-section">
                    <a href="#" class="nav-item" onclick="switchTab(event, 'dashboard')">
                        <i class="fas fa-tachometer-alt"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </section>
                
                <div class="nav-section-title">MANAGEMENT</div>
                <section class="nav-section">
                    <div class="nav-item" onclick="toggleSubmenu('program-submenu');">
                        <i class="fas fa-tasks"></i>
                        <span class="nav-text">Program Management</span>
                        <i class="fas fa-chevron-down toggle-arrow"></i>
                    </div>
                    <div id="program-submenu" class="submenu">
                        <a href="#" class="nav-item" onclick="switchTab(event, 'curriculum-management')">
                            <i class="fas fa-book"></i>
                            <span class="nav-text">Curriculum Management</span>
                        </a>
                        <a href="#" class="nav-item" onclick="switchTab(event, 'faculty-loading')">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span class="nav-text">Faculty Loading</span>
                        </a>
                    </div>
                </section>
                
                <div class="nav-section-title">UTILITIES</div>
                <section class="nav-section">
                    <a href="#" class="nav-item" onclick="switchTab(event, 'automated-alerts')">
                        <i class="fas fa-bell"></i>
                        <span class="nav-text">Alerts</span>
                    </a>
                    <a href="#" class="nav-item" onclick="switchTab(event, 'reports-section')">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-text">Reports</span>
                    </a>
                </section>
                
                <section class="nav-section">
                    <a href="#" class="nav-item" onclick="logout()">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="nav-text">Logout</span>
                    </a>
                </section>
            </nav>
        </div>
        <!-- Main Content Section -->
        <div class="main-content">
            <!-- Header Section -->
            <div class="header">
                <div class="header-right">
                    <button class="theme-toggle" onclick="toggleTheme()">
                        <i class="fas fa-moon"></i>
                    </button>
                    <div class="notification-icon">
                        <i class="fas fa-bell"></i>
                        <div class="notification-badge"></div>
                    </div>
                    <div class="user-info">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=990000&color=fff" alt="Admin Avatar">
                            <div class="user-details">
                            <div class="user-name">Loading...</div>
                            <div class="user-role">Loading...</div>
                            <div class="user-progrma">Loading...</div>
                        </div>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="content-area">
                
                <!-- Dashboard Tab Content -->
                <div id="dashboard" class="tab-content">
                    <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
                    <hr class="sub-tab-separator">
                    <div class="card">
                        <div class="card-header">Overview</div>
                        <p>Welcome to the Chairperson Portal Dashboard. Here you can get a quick overview of the department's status.</p>
                        <!-- Add more dashboard widgets here -->
                    </div>
                </div>

                <!-- Curriculum Management Tab Content -->
                <div id="curriculum-management" class="tab-content">
                    <!-- Curriculum Management - Import Tab -->
                    <h2><i class="fas fa-book"></i> Curriculum Management</h2>
                    <hr class="sub-tab-separator">
                    <div class="tabs sub-tabs">
                        <button class="tab-button" data-tab="curriculum-management-import">Import Curriculum</button>
                        <button class="tab-button" data-tab="curriculum-management-view">View/Edit Curriculum</button>
                    </div>

                    <div id="curriculum-management-import" class="sub-tab-content">
    <div class="card">
        <div class="card-header">Import Curriculum (PDF)</div>
        
        <!-- 📂 Upload Area -->
        <div class="pdf-upload-area" id="pdfUploadArea">
            <input type="file" id="pdfFileInput" accept=".pdf" style="display:none;">
            <p><i class="fas fa-cloud-upload-alt fa-3x" style="color: var(--primary);"></i></p>
            <p>Drag & Drop your PDF curriculum here, or click to browse.</p>
        </div>
        
        <!-- 📄 Embedded PDF Preview -->
        <div id="pdfEmbedContainer" style="display: none;">
            <iframe id="pdf-iframe" style="width: 100%; height: 700px; border: 1px solid var(--border-color); border-radius: 8px;"></iframe>
            <button id="replacePdfBtn" class="btn btn-secondary mt-3"><i class="fas fa-sync-alt"></i> Replace PDF</button>
            <button id="submitCurriculumBtn" class="btn btn-success mt-3">
    <i class="fas fa-database"></i> Submit Curriculum for Insertion
</button>
        </div>
    </div>
</div>


                    <!-- Curriculum Management - View/Edit Tab -->
                    <div id="curriculum-management-view" class="sub-tab-content">
                        <div class="card">
                            <div class="card-header">Current Curriculum</div>
                            <button class="btn btn-success mb-3" onclick="openModal('addCourseModal')"><i class="fas fa-plus"></i> Add New Course</button>
                            <div class="table-responsive">
                                <table class="data-table" id="curriculumTable">
                                    <thead>
                                        <tr>
                                            <th>Course Code</th>
                                            <th>Course Title</th>
                                            <th>Units</th>
                                            <th>Semester</th>
                                            <th>Year Level</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Default Placeholder Data -->
                                        <tr data-id="CS101">
                                            <td>CS101</td>
                                            <td>Introduction to Programming</td>
                                            <td>3</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>
                                                <!-- [MODIFIED] Action buttons are now icon-only -->
                                                <button class="btn btn-blue-outline btn-sm" onclick="editCourse('CS101')"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm" onclick="removeCourse('CS101')"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                        <tr data-id="MA102">
                                            <td>MA102</td>
                                            <td>Calculus I</td>
                                            <td>3</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>
                                                <button class="btn btn-blue-outline btn-sm" onclick="editCourse('MA102')"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm" onclick="removeCourse('MA102')"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                        <tr data-id="PH101">
                                            <td>PH101</td>
                                            <td>Physics for Engineers</td>
                                            <td>3</td>
                                            <td>2</td>
                                            <td>1</td>
                                            <td>
                                                <button class="btn btn-blue-outline btn-sm" onclick="editCourse('PH101')"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm" onclick="removeCourse('PH101')"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Faculty Loading Tab Content -->
                <div id="faculty-loading" class="tab-content">
                    <h2><i class="fas fa-chalkboard-teacher"></i> Faculty Loading</h2>
                    <hr class="sub-tab-separator">
                    
                    <div class="tabs sub-tabs">
                        <button class="tab-button" data-tab="assign-courses">Assign Courses</button>
                        <button class="tab-button" data-tab="current-assignments">Current Assignments</button>
                    </div>
                    
                    <!-- Assign Courses Tab -->
                    <div id="assign-courses" class="sub-tab-content">
                        <div class="card">
                            <div class="card-header">Assign Courses to Faculty</div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="yearLevelFilter">Year Level:</label>
                                    <select id="yearLevelFilter" class="form-control">
                                        <option value="">All Year Levels</option>
                                        <option value="1">1st Year</option>
                                        <option value="2">2nd Year</option>
                                        <option value="3">3rd Year</option>
                                        <option value="4">4th Year</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="sectionFilter">Section:</label>
                                    <select id="sectionFilter" class="form-control">
                                        <option value="">All Sections</option>
                                        <option value="A">Section A</option>
                                        <option value="B">Section B</option>
                                        <option value="C">Section C</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="courseSelect">Select Course:</label>
                                <select id="courseSelect" class="form-control">
                                    <option value="">-- Select a Course --</option>
                                    <option value="CS101">CS101 - Introduction to Programming</option>
                                    <option value="MA102">MA102 - Calculus I</option>
                                    <option value="PH101">PH101 - Physics for Engineers</option>
                                    <option value="DA201">DA201 - Data Structures</option>
                                    <option value="AL301">AL301 - Algorithms Design</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="facultySelect">Select Faculty:</label>
                                <select id="facultySelect" class="form-control">
                                    <option value="">-- Select a Faculty Member --</option>
                                    <option value="Dr. Smith">Dr. Smith (Available)</option>
                                    <option value="Prof. Johnson">Prof. Johnson (Available)</option>
                                    <option value="Ms. Davis">Ms. Davis (Partially Available)</option>
                                    <option value="Mr. Brown">Mr. Brown (Overloaded)</option>
                                </select>
                            </div>
                            <button class="btn btn-success" onclick="assignCourseToFaculty()"><i class="fas fa-plus"></i> Assign Course</button>
                            <button class="btn btn-blue-outline" onclick="openModal('autoAssignPreviewModal')"><i class="fas fa-magic"></i> Auto-Assign Preview</button>
                        </div>
                    </div>
                    
                    <!-- Current Assignments Tab -->
                    <div id="current-assignments" class="sub-tab-content">
                        <div class="card">
                            <div class="card-header">Current Faculty Assignments</div>
                            <div class="table-responsive">
                                <table class="data-table" id="facultyAssignmentsTable">
                                    <thead>
                                        <tr>
                                            <th>Faculty Name</th>
                                            <th>Assigned Course</th>
                                            <th>Units</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Placeholder assignments -->
                                        <tr>
                                            <td>Dr. Smith</td>
                                            <td>CS101 - Introduction to Programming</td>
                                            <td>3</td>
                                            <td style="color: var(--success);">Assigned</td>
                                            <td>
                                                <button class="btn btn-blue-outline btn-sm" onclick="editAssignment(this)"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm" onclick="removeAssignment(this)"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Prof. Johnson</td>
                                            <td>MA102 - Calculus I</td>
                                            <td>3</td>
                                            <td style="color: var(--success);">Assigned</td>
                                            <td>
                                                <button class="btn btn-blue-outline btn-sm" onclick="editAssignment(this)"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm" onclick="removeAssignment(this)"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-success mt-3" onclick="finalizeLoading()"><i class="fas fa-check-circle"></i> Finalize Faculty Loading</button>
                        </div>
                    </div>
                </div>

                <!-- Automated Alerts Tab Content -->
                <div id="automated-alerts" class="tab-content">
                     <h2><i class="fas fa-bell"></i> Automated Alerts</h2>
                     <hr class="sub-tab-separator">
                    <div class="card">
                        <div class="card-header">Recent Alerts</div>
                        <div id="alertsContainer">
                            <div class="alert-box warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                <div class="alert-content">
                                    <strong>Warning:</strong> Faculty member Mr. Brown is currently overloaded with 15 units.
                                </div>
                                <div class="alert-actions">
                                    <button class="btn btn-blue-outline btn-sm" onclick="viewAlertDetails('warning-brown')">View Details</button>
                                    <button class="alert-dismiss" onclick="dismissAlert(this)"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                            <div class="alert-box danger">
                                <i class="fas fa-exclamation-circle"></i>
                                <div class="alert-content">
                                    <strong>Critical:</strong> CS101 has no assigned faculty for next semester.
                                </div>
                                <div class="alert-actions">
                                    <button class="btn btn-blue-outline btn-sm" onclick="viewAlertDetails('danger-cs101')">View Details</button>
                                    <button class="alert-dismiss" onclick="dismissAlert(this)"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                            <div class="alert-box success">
                                <i class="fas fa-check-circle"></i>
                                <div class="alert-content">
                                    <strong>Success:</strong> All required courses for 1st year, 1st semester are assigned.
                                </div>
                                <div class="alert-actions">
                                    <button class="btn btn-blue-outline btn-sm" onclick="viewAlertDetails('success-1styear')">View Details</button>
                                    <button class="alert-dismiss" onclick="dismissAlert(this)"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-blue-outline mt-3" onclick="showToast('info', 'Simulating refresh of alerts...');"><i class="fas fa-sync-alt"></i> Refresh Alerts</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="toastContainer"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');

            // --- Sidebar Toggle Logic ---
            function toggleSidebar() {
                if (window.innerWidth <= 992) {
                    sidebar.classList.toggle('mobile-open');
                } else {
                    sidebar.classList.toggle('collapsed');
                }
            }
            sidebarToggle.addEventListener('click', toggleSidebar);

            // --- Submenu Toggle Logic ---
            window.toggleSubmenu = function(submenuId) {
                if (sidebar.classList.contains('collapsed')) return;
                const submenu = document.getElementById(submenuId);
                if (submenu) {
                    submenu.classList.toggle('show');
                }
            };

            // --- Sub-Tab Switching Logic ---
            function switchSubTab(targetId, parentContent) {
                if (!parentContent) return;

                const subTabContents = parentContent.querySelectorAll('.sub-tab-content');
                subTabContents.forEach(content => content.classList.remove('active'));

                const subTabButtons = parentContent.querySelectorAll('.sub-tabs .tab-button');
                subTabButtons.forEach(button => button.classList.remove('active'));

                const subTabButton = parentContent.querySelector(`.sub-tabs .tab-button[data-tab="${targetId}"]`);
                const subTabContent = document.getElementById(targetId);

                if (subTabButton) subTabButton.classList.add('active');
                if (subTabContent) subTabContent.classList.add('active');
            }
            
            // --- Main Tab Switching Logic ---
            window.switchTab = function(event, targetId) {
                if (event) event.preventDefault();

                document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
                document.querySelectorAll('.nav-item').forEach(item => item.classList.remove('active'));

                const targetTabContent = document.getElementById(targetId);
                const targetNavItem = event ? event.currentTarget : document.querySelector(`.nav-item[onclick*="${targetId}"]`);

                if (targetTabContent) targetTabContent.classList.add('active');
                if (targetNavItem) {
                    targetNavItem.classList.add('active');
                    const parentSubmenu = targetNavItem.closest('.submenu');
                    if (parentSubmenu && !parentSubmenu.classList.contains('show')) {
                        parentSubmenu.classList.add('show');
                    }
                }
                
                if (targetTabContent) {
                    const firstSubTabButton = targetTabContent.querySelector('.sub-tabs .tab-button');
                    if (firstSubTabButton) {
                        switchSubTab(firstSubTabButton.dataset.tab, targetTabContent);
                    }
                }
                
                if (window.innerWidth <= 992) {
                    sidebar.classList.remove('mobile-open');
                }
            };

            // --- Event Listeners ---
            document.querySelectorAll('.sub-tabs .tab-button').forEach(button => {
                button.addEventListener('click', (event) => {
                    const parentContent = event.currentTarget.closest('.tab-content');
                    if (parentContent) {
                        switchSubTab(event.currentTarget.dataset.tab, parentContent);
                    }
                });
            });

            // --- Initial State ---
            function initializeDashboard() {
                switchTab(null, 'dashboard');
            }
            
            initializeDashboard();

            // --- [MODIFIED] PDF Upload & Embed Logic ---
            const pdfUploadArea = document.getElementById('pdfUploadArea');
            const pdfFileInput = document.getElementById('pdfFileInput');
            const pdfEmbedContainer = document.getElementById('pdfEmbedContainer');
            const pdfIframe = document.getElementById('pdf-iframe');
            const replacePdfBtn = document.getElementById('replacePdfBtn');

            if (pdfUploadArea) {
                pdfUploadArea.addEventListener('click', () => pdfFileInput.click());
                pdfFileInput.addEventListener('change', function() {
                    if (this.files.length > 0) handleFiles(this.files);
                });

                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    pdfUploadArea.addEventListener(eventName, preventDefaults, false);
                });
                ['dragenter', 'dragover'].forEach(eventName => {
                    pdfUploadArea.addEventListener(eventName, () => pdfUploadArea.classList.add('drag-over'), false);
                });
                ['dragleave', 'drop'].forEach(eventName => {
                    pdfUploadArea.addEventListener(eventName, () => pdfUploadArea.classList.remove('drag-over'), false);
                });
                pdfUploadArea.addEventListener('drop', (e) => {
                    pdfFileInput.files = e.dataTransfer.files;
                    handleFiles(e.dataTransfer.files);
                }, false);

                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                function handleFiles(files) {
                    if (files.length > 0 && files[0].type === 'application/pdf') {
                        const file = files[0];
                        // Create a URL for the file
                        const fileURL = URL.createObjectURL(file);

                        // Set the iframe source to the file URL to embed it
                        pdfIframe.src = fileURL;
                        
                        // Show the container with the embedded PDF
                        pdfEmbedContainer.style.display = 'block';
                        
                        // Hide the original upload area
                        pdfUploadArea.style.display = 'none';
                    } else {
                        showToast('error', 'Please select a valid PDF file.');
                    }
                }
                
                // Event listener for the "Replace PDF" button
                if(replacePdfBtn) {
                    replacePdfBtn.addEventListener('click', () => {
                        // Hide the PDF embed container
                        pdfEmbedContainer.style.display = 'none';
                        // Important: Revoke the object URL to free up memory
                        URL.revokeObjectURL(pdfIframe.src);
                        // Clear the iframe source
                        pdfIframe.src = '';
                        // Show the upload area again
                        pdfUploadArea.style.display = 'block';
                        // Reset the file input so the user can select a new file
                        pdfFileInput.value = '';
                    });
                }
            }
            
            // --- Toast Notification Function ---
            window.showToast = function(type, message) {
                const toastContainer = document.getElementById('toastContainer');
                const toast = document.createElement('div');
                toast.className = `toast ${type}`;
                let icon = type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle';
                toast.innerHTML = `<i class="fas ${icon}"></i><span>${message}</span>`;
                toastContainer.appendChild(toast);
                setTimeout(() => toast.remove(), 5000);
            };
            
            // --- Modal Functions ---
            window.openModal = function(modalId) {
                const modal = document.createElement('div');
                modal.className = 'modal';
                modal.id = modalId;
                modal.style.display = 'flex';
                modal.innerHTML = `
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Sample Modal</h3>
                            <span class="close-button" onclick="closeModal('${modalId}')">&times;</span>
                        </div>
                        <div class="modal-body">
                            <p>This is a sample modal dialog. In a real implementation, you would customize this content.</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" onclick="closeModal('${modalId}')">Cancel</button>
                            <button class="btn btn-primary">Confirm</button>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);
            };
            
            window.closeModal = function(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) modal.remove();
            };
            
            // --- Utility Functions ---
            window.logout = () => showToast('info', 'Logging out...');
            window.editCourse = (courseId) => showToast('info', `Editing course ${courseId}`);
            window.removeCourse = (courseId) => {
                document.querySelector(`#curriculumTable tr[data-id="${courseId}"]`)?.remove();
                showToast('error', `Removed course ${courseId}`);
            };
            window.assignCourseToFaculty = () => {
                const course = document.getElementById('courseSelect').value;
                const faculty = document.getElementById('facultySelect').value;
                if (!course || !faculty) {
                    showToast('error', 'Please select both a course and faculty member');
                    return;
                }
                showToast('success', `Assigned ${course} to ${faculty}`);
            };
            window.editAssignment = (button) => {
                const row = button.closest('tr');
                const facultyName = row.cells[0].innerText;
                showToast('info', `Editing assignment for ${facultyName}`);
            };
            window.removeAssignment = (button) => {
                button.closest('tr')?.remove();
                showToast('info', 'Assignment removed');
            };
            window.finalizeLoading = () => showToast('success', 'Faculty loading finalized successfully');
            window.viewAlertDetails = (alertId) => showToast('info', `Showing details for alert: ${alertId}`);
            window.dismissAlert = (button) => button.closest('.alert-box')?.remove();
        });

document.addEventListener("DOMContentLoaded", function () {
    fetch('get_chair_info.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector('.user-name').textContent = data.name;
                document.querySelector('.user-role').textContent = data.role;
                document.querySelector('.user-progrma').textContent = data.program;
            } else {
                console.error("Error:", data.message);
            }
        })
        .catch(err => {
            console.error("Fetch failed:", err);
        });
});
let selectedPDF = null;

// DRAG & DROP SUPPORT
const uploadArea = document.getElementById('pdfUploadArea');
const fileInput = document.getElementById('pdfFileInput');
const pdfEmbedContainer = document.getElementById('pdfEmbedContainer');
const pdfFrame = document.getElementById('pdf-iframe');

// Allow click to trigger file input
uploadArea.addEventListener('click', () => {
    fileInput.click();
});

// Set file when selected via browse
fileInput.addEventListener('change', function () {
    if (this.files.length > 0) {
        handlePDFSelection(this.files[0]);
    }
});

// Handle drag events
uploadArea.addEventListener('dragover', function (e) {
    e.preventDefault();
    uploadArea.classList.add('drag-over');
});
uploadArea.addEventListener('dragleave', function () {
    uploadArea.classList.remove('drag-over');
});
uploadArea.addEventListener('drop', function (e) {
    e.preventDefault();
    uploadArea.classList.remove('drag-over');

    const file = e.dataTransfer.files[0];
    if (file && file.type === 'application/pdf') {
        handlePDFSelection(file);
    } else {
        alert("Only PDF files are allowed.");
    }
});

// Assign and preview PDF
function handlePDFSelection(file) {
    selectedPDF = file;

    const url = URL.createObjectURL(file);
    pdfEmbedContainer.style.display = 'block';
    pdfFrame.src = url;

    // Optional: show file name or enable button
}

// On submit, upload the selected PDF
document.getElementById('submitCurriculumBtn').addEventListener('click', function () {
    if (!selectedPDF) {
        alert("Please select or drop a PDF file first.");
        return;
    }

    const formData = new FormData();
    formData.append('pdf', selectedPDF);

    fetch('upload_curriculum.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        // Reset state
        selectedPDF = null;
        pdfEmbedContainer.style.display = 'none';
        pdfFrame.src = '';
        fileInput.value = '';
    })
    .catch(() => alert("Upload failed. Please try again."));
});

    </script>
</body>
</html>
