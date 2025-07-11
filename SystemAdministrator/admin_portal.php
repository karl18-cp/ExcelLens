<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExcelLens - Admin Portal</title>
    <style>
         #editCollegeModal input[type="text"] {
        background-color: white !important;
        color: black;
    }
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

        [data-theme="dark"] {
            --primary: #cc0000;
            --secondary: #2d1b1b;
            --light-gray: #1a1a1a;
            --dark-gray: #f5f5f5;
            --white: #2d2d2d;
            --border-color: #404040;
            --text-muted: #adb5bd;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light-gray);
            color: var(--dark-gray);
            transition: all 0.3s ease;
        }
        
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Navigation */
        .sidebar {
            width: 280px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 0;
            position: fixed;
            height: 100vh;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: 70px;
        }
        
        .logo {
            text-align: center;
            padding: 30px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            position: relative;
        }

        .logo-toggle {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255,255,255,0.1);
            border: none;
            color: white;
            padding: 8px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logo-toggle:hover {
            background: rgba(255,255,255,0.2);
        }
        
        .logo img {
            max-width: 60px;
            margin-bottom: 10px;
        }

        .logo h3 {
            font-size: 1.2rem;
            font-weight: 600;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .logo h3 {
            opacity: 0;
        }
        
        .nav-menu {
            margin-top: 20px;
            padding: 0 10px;
        }

        .nav-section {
            margin-bottom: 30px;
        }

        .nav-section-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: rgba(255,255,255,0.6);
            padding: 0 15px 10px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .nav-section-title {
            opacity: 0;
        }
        
        .nav-item {
            padding: 12px 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            border-radius: 8px;
            margin-bottom: 5px;
            position: relative;
        }
        
        .nav-item:hover {
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }

        .nav-item.active {
            background: rgba(255,255,255,0.15);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: white;
            border-radius: 0 4px 4px 0;
        }
        
        .nav-item i {
            margin-right: 15px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .nav-item span {
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .nav-item span {
            opacity: 0;
        }

        .nav-item .badge {
            margin-left: auto;
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        /* Main Content Area */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 0;
            transition: margin-left 0.3s ease;
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: 70px;
        }
        
        .header {
            background: var(--white);
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-gray);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
        }

        .breadcrumb-item:not(:last-child)::after {
            content: '/';
            margin: 0 8px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .theme-toggle {
            background: var(--light-gray);
            border: 1px solid var(--border-color);
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .notification-icon {
            position: relative;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .notification-icon:hover {
            background: var(--light-gray);
        }

        .notification-badge {
            position: absolute;
            top: 5px;
            right: 5px;
            background: var(--danger);
            color: white;
            border-radius: 50%;
            width: 8px;
            height: 8px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .user-info:hover {
            background: var(--light-gray);
        }
        
        .user-info img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: 2px solid var(--primary);
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        /* Content Area */
        .content-area {
            padding: 30px;
        }
        
        /* Cards and Widgets */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--white);
            padding: 25px;
            border-radius: 12px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stat-icon.primary { background: var(--primary); }
        .stat-icon.success { background: var(--success); }
        .stat-icon.warning { background: var(--warning); }
        .stat-icon.info { background: var(--info); }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .stat-trend {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 10px;
            font-size: 0.8rem;
        }

        .trend-up { color: var(--success); }
        .trend-down { color: var(--danger); }
        
        /* Module Containers */
        .module-container {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .module-header {
            padding: 25px 30px;
            border-bottom: 1px solid var(--border-color);
            background: linear-gradient(135deg, var(--white) 0%, var(--secondary) 100%);
        }
        
        .module-title {
            font-size: 1.5rem;
            color: var(--primary);
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .module-body {
            padding: 30px;
        }

        /* Enhanced Tabs */
        .nav-tabs {
            display: flex;
            border-bottom: 1px solid var(--border-color);
            background: var(--light-gray);
            border-radius: 8px 8px 0 0;
            padding: 5px;
            margin: -5px -5px 25px -5px;
        }
        
        .nav-tab {
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
        }
        
        .nav-tab.active {
            background: var(--primary);
            color: white;
            box-shadow: var(--shadow);
        }
        
        .nav-tab:hover:not(.active) {
            background: var(--white);
            color: var(--primary);
        }

        /* Enhanced Tables */
        .table-container {
            background: var(--white);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .table-header {
            padding: 20px;
            background: var(--light-gray);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: between;
            align-items: center;
        }

        .table-title {
            font-weight: 600;
            color: var(--dark-gray);
        }

        .table-actions {
            display: flex;
            gap: 10px;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .data-table th {
            padding: 15px 20px;
            text-align: left;
            background: var(--light-gray);
            font-weight: 600;
            color: var(--dark-gray);
            border-bottom: 1px solid var(--border-color);
        }

        .data-table td {
            padding: 15px 20px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .data-table tr:hover {
            background: var(--secondary);
        }

        /* Status Badges */
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge.active {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }

        .status-badge.pending {
            background: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }

        .status-badge.inactive {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }

        /* Enhanced Buttons */
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-warning {
            background: var(--warning);
            color: white;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.8rem;
        }

        /* Enhanced Forms */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-gray);
        }
        
        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: var(--white);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(153, 0, 0, 0.1);
        }

        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
            padding-right: 40px;
            appearance: none;
        }

        /* Charts Container */
        .chart-container {
            background: var(--white);
            padding: 25px;
            border-radius: 12px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-gray);
        }

        .chart-wrapper {
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--light-gray);
            border-radius: 8px;
            color: var(--text-muted);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                transform: translateX(-100%);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block;
                background: var(--primary);
                color: white;
                border: none;
                padding: 10px;
                border-radius: 8px;
                margin-bottom: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .header {
                padding: 15px;
            }

            .content-area {
                padding: 15px;
            }
        }

        .mobile-toggle {
            display: none;
        }

        /* Animation keyframes */
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .slide-in {
            animation: slideInRight 0.3s ease-out;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar Navigation -->
        <div class="sidebar" id="sidebar">
            <div class="logo">
                <button class="logo-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' fill='%23fff'/%3E%3Cpath d='M20 30h60v8H20zm0 16h60v8H20zm0 16h40v8H20z' fill='%23990000'/%3E%3C/svg%3E" alt="ExcelLens Logo">
                <h3>Admin Portal</h3>
            </div>
            
            <div class="nav-menu">
                <div class="nav-section">
                    <div class="nav-section-title">Dashboard</div>
                    <div class="nav-item active" onclick="showModule('dashboard')">
                        <i class="fas fa-chart-pie"></i>
                        <span>Overview</span>
                    </div>
                    <div class="nav-item" onclick="showModule('analytics')">
                        <i class="fas fa-chart-line"></i>
                        <span>Analytics</span>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Management</div>
                    <div class="nav-item" onclick="showModule('account-management')">
                        <i class="fas fa-users-cog"></i>
                        <span>Account Management</span>
                        <span class="badge">5</span>
                    </div>
                    <div class="nav-item" onclick="showModule('system-configuration')">
                        <i class="fas fa-cog"></i>
                        <span>System Configuration</span>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">System</div>
                    <div class="nav-item" onclick="showModule('reports')">
                        <i class="fas fa-file-alt"></i>
                        <span>Reports</span>
                    </div>
                    <div class="nav-item" onclick="showModule('settings')">
                        <i class="fas fa-sliders-h"></i>
                        <span>Settings</span>
                    </div>
                    <div class="nav-item">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content Area -->
        <div class="main-content">
            <div class="header">
                <div class="header-left">
                    <button class="mobile-toggle" onclick="toggleMobileSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div>
                        <h1 class="header-title">Admin Dashboard</h1>
                        <div class="breadcrumb">
                            <div class="breadcrumb-item">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </div>
                            <div class="breadcrumb-item">Overview</div>
                        </div>
                    </div>
                </div>
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
                            <div class="user-name">System Administrator</div>
                            <div class="user-role">Super Admin</div>
                        </div>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <div class="content-area">
                <!-- Dashboard Module -->
                <div id="dashboard" class="module-container">
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-card-header">
                                <div class="stat-icon primary">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="stat-value">1,247</div>
                            <div class="stat-label">Total Users</div>
                            <div class="stat-trend trend-up">
                                <i class="fas fa-arrow-up"></i>
                                <span>+12% from last month</span>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-card-header">
                                <div class="stat-icon success">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>
                            <div class="stat-value">1,156</div>
                            <div class="stat-label">Active Users</div>
                            <div class="stat-trend trend-up">
                                <i class="fas fa-arrow-up"></i>
                                <span>+8% from last month</span>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-card-header">
                                <div class="stat-icon warning">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <div class="stat-value">23</div>
                            <div class="stat-label">Pending Approvals</div>
                            <div class="stat-trend trend-down">
                                <i class="fas fa-arrow-down"></i>
                                <span>-5% from last week</span>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-card-header">
                                <div class="stat-icon info">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                            </div>
                            <div class="stat-value">15</div>
                            <div class="stat-label">Academic Programs</div>
                            <div class="stat-trend trend-up">
                                <i class="fas fa-arrow-up"></i>
                                <span>+2 new programs</span>
                            </div>
                        </div>
                    </div>

                    <div class="chart-container">
                        <div class="chart-header">
                            <h3 class="chart-title">User Registration Trends</h3>
                            <select class="form-control" style="width: auto;">
                                <option>Last 30 days</option>
                                <option>Last 90 days</option>
                                <option>Last year</option>
                            </select>
                        </div>
                        <div class="chart-wrapper">
                            <i class="fas fa-chart-area fa-3x"></i>
                            <span style="margin-left: 15px;">Chart visualization would be displayed here</span>
                        </div>
                    </div>
                </div>

                <!-- Account Management Module -->
                <div id="account-management" class="module-container" style="display: none;">
                    <div class="module-header">
                        <h2 class="module-title">
                            <i class="fas fa-users-cog"></i>
                            Account Management
                        </h2>
                    </div>
                    <div class="module-body">
                        <div class="nav-tabs">
                            <div class="nav-tab active" onclick="showUserType('vcaa')">
                                <i class="fas fa-user-tie"></i>
                                VCAA
                            </div>
                            <div class="nav-tab" onclick="showUserType('deans')">
                                <i class="fas fa-user-graduate"></i>
                                College Deans
                            </div>
                            <div class="nav-tab" onclick="showUserType('chairs')">
                                <i class="fas fa-user-cog"></i>
                                Department Chairs
                            </div>
                            <div class="nav-tab" onclick="showUserType('faculty')">
                                <i class="fas fa-chalkboard-teacher"></i>
                                Faculty
                                <span class="badge">5</span>
                            </div>
                            <div class="nav-tab" onclick="showUserType('students')">
                                <i class="fas fa-user-graduate"></i>
                                Students
                            </div>
                        </div>
                        
                        <!-- VCAA Accounts -->
                        <div id="vcaa-accounts" class="user-accounts">
                            <div class="table-container">
                                <div class="table-header">
                                    <h3 class="table-title">Vice Chancellor of Academic Affairs Accounts</h3>
                                    <div class="table-actions">
                                        <button class="btn btn-primary">
                                            <i class="fas fa-plus"></i>
                                            Create VCAA Account
                                        </button>
                                    </div>
                                </div>
                                
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Date Created</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 10px;">
                                                    <img src="https://ui-avatars.com/api/?name=Maria+Santos&background=990000&color=fff" alt="Avatar" style="width: 32px; height: 32px; border-radius: 50%;">
                                                    <strong>Dr. Maria Santos</strong>
                                                </div>
                                            </td>
                                            <td>vc.academic@batstate-u.edu.ph</td>
                                            <td>May 15, 2023</td>
                                            <td><span class="status-badge active">Active</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- College Deans Accounts -->
                        <div id="deans-accounts" class="user-accounts" style="display: none;">
                            <div class="table-container">
                                <div class="table-header">
                                    <h3 class="table-title">College Dean Accounts</h3>
                                    <div class="table-actions">
                                        <button class="btn btn-primary">
                                            <i class="fas fa-plus"></i>
                                            Create Dean Account
                                        </button>
                                        <button class="btn btn-outline">
                                            <i class="fas fa-download"></i>
                                            Export
                                        </button>
                                    </div>
                                </div>
                                
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>College</th>
                                            <th>Email</th>
                                            <th>Date Created</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 10px;">
                                                    <img src="https://ui-avatars.com/api/?name=Juan+Dela+Cruz&background=990000&color=fff" alt="Avatar" style="width: 32px; height: 32px; border-radius: 50%;">
                                                    <strong>Dr. Juan Dela Cruz</strong>
                                                </div>
                                            </td>
                                            <td>College of Engineering</td>
                                            <td>eng.dean@batstate-u.edu.ph</td>
                                            <td>June 20, 2023</td>
                                            <td><span class="status-badge active">Active</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 10px;">
                                                    <img src="https://ui-avatars.com/api/?name=Rosa+Martinez&background=990000&color=fff" alt="Avatar" style="width: 32px; height: 32px; border-radius: 50%;">
                                                    <strong>Dr. Rosa Martinez</strong>
                                                </div>
                                            </td>
                                            <td>College of Business</td>
                                            <td>bus.dean@batstate-u.edu.ph</td>
                                            <td>July 8, 2023</td>
                                            <td><span class="status-badge active">Active</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Department Chairs Accounts -->
                        <div id="chairs-accounts" class="user-accounts" style="display: none;">
                            <div class="table-container">
                                <div class="table-header">
                                    <h3 class="table-title">Department Chair Accounts</h3>
                                    <div class="table-actions">
                                        <button class="btn btn-primary">
                                            <i class="fas fa-plus"></i>
                                            Create Chair Account
                                        </button>
                                    </div>
                                </div>
                                
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>College</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 10px;">
                                                    <img src="https://ui-avatars.com/api/?name=Carlos+Rivera&background=990000&color=fff" alt="Avatar" style="width: 32px; height: 32px; border-radius: 50%;">
                                                    <strong>Dr. Carlos Rivera</strong>
                                                </div>
                                            </td>
                                            <td>Computer Science</td>
                                            <td>College of Engineering</td>
                                            <td>cs.chair@batstate-u.edu.ph</td>
                                            <td><span class="status-badge active">Active</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Faculty Approval Section -->
                        <div id="faculty-accounts" class="user-accounts" style="display: none;">
                            <div class="table-container">
                                <div class="table-header">
                                    <h3 class="table-title">Faculty Registration Requests</h3>
                                    <div class="table-actions">
                                        <button class="btn btn-success">
                                            <i class="fas fa-check-double"></i>
                                            Approve All
                                        </button>
                                    </div>
                                </div>
                                
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Email</th>
                                            <th>Date Registered</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 10px;">
                                                    <img src="https://ui-avatars.com/api/?name=Anna+Reyes&background=990000&color=fff" alt="Avatar" style="width: 32px; height: 32px; border-radius: 50%;">
                                                    <strong>Prof. Anna Reyes</strong>
                                                </div>
                                            </td>
                                            <td>Computer Science</td>
                                            <td>areyes@g.batstate-u.edu.ph</td>
                                            <td>July 10, 2023</td>
                                            <td><span class="status-badge pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-success">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 10px;">
                                                    <img src="https://ui-avatars.com/api/?name=Miguel+Torres&background=990000&color=fff" alt="Avatar" style="width: 32px; height: 32px; border-radius: 50%;">
                                                    <strong>Prof. Miguel Torres</strong>
                                                </div>
                                            </td>
                                            <td>Mathematics</td>
                                            <td>mtorres@g.batstate-u.edu.ph</td>
                                            <td>July 12, 2023</td>
                                            <td><span class="status-badge pending">Pending</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-success">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Students Section -->
                        <div id="students-accounts" class="user-accounts" style="display: none;">
                            <div class="table-container">
                                <div class="table-header">
                                    <h3 class="table-title">Student Accounts</h3>
                                    <div class="table-actions">
                                        <input type="search" class="form-control" placeholder="Search students..." style="width: 250px;">
                                        <button class="btn btn-outline">
                                            <i class="fas fa-filter"></i>
                                            Filter
                                        </button>
                                    </div>
                                </div>
                                
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Name</th>
                                            <th>Program</th>
                                            <th>Year Level</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>2023-0001</strong></td>
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 10px;">
                                                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=990000&color=fff" alt="Avatar" style="width: 32px; height: 32px; border-radius: 50%;">
                                                    <strong>John Doe</strong>
                                                </div>
                                            </td>
                                            <td>Computer Science</td>
                                            <td>4th Year</td>
                                            <td><span class="status-badge active">Active</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Configuration Module -->
                <div id="system-configuration" class="module-container" style="display: none;">
                    <div class="module-header">
                        <h2 class="module-title">
                            <i class="fas fa-cog"></i>
                            System Configuration
                        </h2>
                    </div>
                    <div class="module-body">
                        <div class="nav-tabs">
                            <div class="nav-tab active" onclick="showConfigTab('academic-structure')">
                                <i class="fas fa-university"></i>
                                Academic Structure
                            </div>
                            <div class="nav-tab" onclick="showConfigTab('view-structure')">
                                <i class="fas fa-eye"></i>
                                View Structure
                            </div>
                            <div class="nav-tab" onclick="showConfigTab('email-templates')">
                                <i class="fas fa-envelope"></i>
                                Email Templates
                            </div>
                        </div>

                        <!-- Academic Structure Tab -->
                        <div id="academic-structure-tab" class="config-content">
                            <div class="nav-tabs" style="margin-top: 0;">
                                <div class="nav-tab active" onclick="showSubTab('colleges')">
                                    <i class="fas fa-building"></i>
                                    Department
                                </div>
                                <div class="nav-tab" onclick="showSubTab('programs')">
                                    <i class="fas fa-graduation-cap"></i>
                                    Programs
                                </div>
                                <div class="nav-tab" onclick="showSubTab('majors')">
                                    <i class="fas fa-book"></i>
                                    Majors
                                </div>
                                <div class="nav-tab" onclick="showSubTab('year-levels')">
                                    <i class="fas fa-layer-group"></i>
                                    Year Levels
                                </div>
                                <div class="nav-tab" onclick="showSubTab('sections')">
                                    <i class="fas fa-users"></i>
                                    Sections
                                </div>
                            </div>

                           <div id="subtab-colleges" class="subtab-content">
    <div class="form-grid">
        <div class="form-group">
            <label class="form-label">College Name</label>
            <input type="text" id="college-name" class="form-control" placeholder="e.g. College of Engineering" required>
        </div>
        <div class="form-group">
            <label class="form-label">Nickname</label>
            <input type="text" id="college-code" class="form-control" placeholder="e.g. COE" required>
        </div>
    </div>
    <button class="btn btn-primary" onclick="addCollege()">
        <i class="fas fa-plus"></i> Add College
    </button>

    <div style="margin-top: 30px;">
        <h4>Existing Colleges</h4>
        <div class="table-container" style="margin-top: 15px;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>College Name</th>
                        <th>Nickname</th>
                        <th>Programs</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="collegeTableBody">
                    <?php include 'fetch_colleges.php'; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


                            <div id="subtab-programs" class="subtab-content" style="display: none;">
    <div class="form-grid">
        <div class="form-group">
            <label class="form-label">Program Name</label>
            <input type="text" id="program-name" class="form-control" placeholder="e.g. Computer Science">
        </div>
        <div class="form-group">
            <label class="form-label">Select College</label>
            <select id="program-college" class="form-control form-select" required>
                <option value="">Select College</option>
                <?php include 'fetch_colleges.php?mode=select'; ?>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Program Duration (Years)</label>
            <input type="number" id="program-duration" class="form-control" placeholder="4">
        </div>
    </div>
    <button class="btn btn-primary" onclick="addProgram()">
        <i class="fas fa-plus"></i>
        Add Program
    </button>

    <!-- PROGRAM TABLE -->
    <div style="margin-top: 30px;">
        <h4>Existing Programs</h4>
        <div class="table-container" style="margin-top: 15px;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Program Name</th>
                        <th>College</th>
                        <th>Duration (Years)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="programTableBody">
                    <?php include 'fetch_programs.php'; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


                            <div id="subtab-majors" class="subtab-content" style="display: none;">
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">Major Name (Optional)</label>
                                        <input type="text" id="major-name" class="form-control" placeholder="e.g. Data Science">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Select Program</label>
                                        <select id="major-program" class="form-control form-select">
                                            <option>Select Program</option>
                                            <option>Computer Science</option>
                                            <option>Information Technology</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary" onclick="addMajor()">
                                    <i class="fas fa-plus"></i>
                                    Add Major
                                </button>
                            </div>

                            <div id="subtab-year-levels" class="subtab-content" style="display: none;">
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
                                <button class="btn btn-primary" onclick="addYearLevel()">
                                    <i class="fas fa-plus"></i>
                                    Add Year Level
                                </button>
                            </div>

                            <div id="subtab-sections" class="subtab-content" style="display: none;">
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">Section Name</label>
                                        <input type="text" id="section" class="form-control" placeholder="e.g. CS-401">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Select Program</label>
                                        <select id="section-program" class="form-control form-select">
                                            <option>Select Program</option>
                                            <option>Computer Science</option>
                                            <option>Information Technology</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Select Year Level</label>
                                        <select id="section-year" class="form-control form-select">
                                            <option>Select Year Level</option>
                                            <option>1st Year</option>
                                            <option>2nd Year</option>
                                            <option>3rd Year</option>
                                            <option>4th Year</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary" onclick="addSection()">
                                    <i class="fas fa-plus"></i>
                                    Add Section
                                </button>
                            </div>
                        </div>

                        <!-- View Structure Tab -->
                        <div id="view-structure-tab" class="config-content" style="display: none;">
                            <div class="chart-container">
                                <div class="chart-header">
                                    <h3 class="chart-title">Academic Structure Overview</h3>
                                    <button class="btn btn-outline">
                                        <i class="fas fa-download"></i>
                                        Export Structure
                                    </button>
                                </div>
                                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                                    <div class="stat-card">
                                        <div class="stat-card-header">
                                            <div class="stat-icon primary">
                                                <i class="fas fa-building"></i>
                                            </div>
                                        </div>
                                        <div class="stat-value">8</div>
                                        <div class="stat-label">Total Colleges</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="stat-card-header">
                                            <div class="stat-icon success">
                                                <i class="fas fa-graduation-cap"></i>
                                            </div>
                                        </div>
                                        <div class="stat-value">45</div>
                                        <div class="stat-label">Academic Programs</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="stat-card-header">
                                            <div class="stat-icon info">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="stat-value">234</div>
                                        <div class="stat-label">Total Sections</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Email Templates Tab -->
                        <div id="email-templates-tab" class="config-content" style="display: none;">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Template Name</label>
                                    <input type="text" class="form-control" placeholder="e.g. Welcome Email">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Template Type</label>
                                    <select class="form-control form-select">
                                        <option>User Registration</option>
                                        <option>Account Approval</option>
                                        <option>Password Reset</option>
                                        <option>System Notification</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email Subject</label>
                                <input type="text" class="form-control" placeholder="Welcome to ExcelLens">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email Content</label>
                                <textarea class="form-control" rows="10" placeholder="Email template content..."></textarea>
                            </div>
                            <button class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Save Template
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Analytics Module -->
                <div id="analytics" class="module-container" style="display: none;">
                    <div class="module-header">
                        <h2 class="module-title">
                            <i class="fas fa-chart-line"></i>
                            Analytics & Reports
                        </h2>
                    </div>
                    <div class="module-body">
                        <div class="stats-grid">
                            <div class="chart-container">
                                <div class="chart-header">
                                    <h3 class="chart-title">User Growth</h3>
                                    <select class="form-control" style="width: auto;">
                                        <option>Last 6 months</option>
                                        <option>Last year</option>
                                    </select>
                                </div>
                                <div class="chart-wrapper">
                                    <i class="fas fa-chart-line fa-3x"></i>
                                    <span style="margin-left: 15px;">Line chart visualization</span>
                                </div>
                            </div>

                            <div class="chart-container">
                                <div class="chart-header">
                                    <h3 class="chart-title">User Distribution by Role</h3>
                                </div>
                                <div class="chart-wrapper">
                                    <i class="fas fa-chart-pie fa-3x"></i>
                                    <span style="margin-left: 15px;">Pie chart visualization</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reports Module -->
                <div id="reports" class="module-container" style="display: none;">
                    <div class="module-header">
                        <h2 class="module-title">
                            <i class="fas fa-file-alt"></i>
                            System Reports
                        </h2>
                    </div>
                    <div class="module-body">
                        <div class="stats-grid">
                            <div class="stat-card" style="cursor: pointer;" onclick="generateReport('users')">
                                <div class="stat-card-header">
                                    <div class="stat-icon primary">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="stat-label">User Activity Report</div>
                                <p style="margin-top: 10px; color: var(--text-muted); font-size: 0.9rem;">Generate comprehensive user activity and engagement reports</p>
                            </div>

                            <div class="stat-card" style="cursor: pointer;" onclick="generateReport('academic')">
                                <div class="stat-card-header">
                                    <div class="stat-icon success">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                </div>
                                <div class="stat-label">Academic Structure Report</div>
                                <p style="margin-top: 10px; color: var(--text-muted); font-size: 0.9rem;">Export academic programs, colleges, and enrollment data</p>
                            </div>

                            <div class="stat-card" style="cursor: pointer;" onclick="generateReport('system')">
                                <div class="stat-card-header">
                                    <div class="stat-icon info">
                                        <i class="fas fa-cogs"></i>
                                    </div>
                                </div>
                                <div class="stat-label">System Performance Report</div>
                                <p style="margin-top: 10px; color: var(--text-muted); font-size: 0.9rem;">Monitor system performance and usage statistics</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Module -->
                <div id="settings" class="module-container" style="display: none;">
                    <div class="module-header">
                        <h2 class="module-title">
                            <i class="fas fa-sliders-h"></i>
                            System Settings
                        </h2>
                    </div>
                    <div class="module-body">
                        <div class="nav-tabs">
                            <div class="nav-tab active" onclick="showSettingsTab('general')">
                                <i class="fas fa-cog"></i>
                                General
                            </div>
                            <div class="nav-tab" onclick="showSettingsTab('security')">
                                <i class="fas fa-shield-alt"></i>
                                Security
                            </div>
                            <div class="nav-tab" onclick="showSettingsTab('notifications')">
                                                                <i class="fas fa-bell"></i>
                                Notifications
                            </div>
                            <div class="nav-tab" onclick="showSettingsTab('backup')">
                                <i class="fas fa-database"></i>
                                Backup
                            </div>
                        </div>

                        <!-- General Settings Tab -->
                        <div id="general-settings-tab" class="settings-content">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">System Name</label>
                                    <input type="text" class="form-control" value="ExcelLens">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Default Theme</label>
                                    <select class="form-control form-select">
                                        <option>Light</option>
                                        <option>Dark</option>
                                        <option>System Preference</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Timezone</label>
                                    <select class="form-control form-select">
                                        <option>Asia/Manila (UTC+8)</option>
                                        <option>UTC</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Date Format</label>
                                    <select class="form-control form-select">
                                        <option>MM/DD/YYYY</option>
                                        <option>DD/MM/YYYY</option>
                                        <option>YYYY-MM-DD</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Save Settings
                            </button>
                        </div>

                        <!-- Security Settings Tab -->
                        <div id="security-settings-tab" class="settings-content" style="display: none;">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Password Policy</label>
                                    <select class="form-control form-select">
                                        <option>Medium (8+ characters)</option>
                                        <option>Strong (12+ characters with complexity)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Session Timeout</label>
                                    <select class="form-control form-select">
                                        <option>30 minutes</option>
                                        <option>1 hour</option>
                                        <option>2 hours</option>
                                        <option>4 hours</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Failed Login Attempts</label>
                                    <select class="form-control form-select">
                                        <option>5 attempts</option>
                                        <option>10 attempts</option>
                                        <option>No limit</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Two-Factor Authentication</label>
                                    <select class="form-control form-select">
                                        <option>Disabled</option>
                                        <option>Optional</option>
                                        <option>Required for Admins</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Update Security Settings
                            </button>
                        </div>

                        <!-- Notification Settings Tab -->
                        <div id="notification-settings-tab" class="settings-content" style="display: none;">
                            <div class="form-group">
                                <label class="form-label">Email Notifications</label>
                                <div style="margin-top: 10px;">
                                    <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                        <input type="checkbox" checked>
                                        System alerts and notifications
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                        <input type="checkbox" checked>
                                        User registration approvals
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                        <input type="checkbox">
                                        Weekly summary reports
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Notification Email Address</label>
                                <input type="email" class="form-control" value="admin@batstate-u.edu.ph">
                            </div>
                            <button class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Update Notification Settings
                            </button>
                        </div>

                        <!-- Backup Settings Tab -->
                        <div id="backup-settings-tab" class="settings-content" style="display: none;">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Backup Frequency</label>
                                    <select class="form-control form-select">
                                        <option>Daily</option>
                                        <option>Weekly</option>
                                        <option>Monthly</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Backup Storage</label>
                                    <select class="form-control form-select">
                                        <option>Local Server</option>
                                        <option>Cloud Storage</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Last Backup</label>
                                    <input type="text" class="form-control" value="July 15, 2023 03:45 AM" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Backup Status</label>
                                    <input type="text" class="form-control" value="Completed successfully" readonly>
                                </div>
                            </div>
                            <div style="margin-top: 20px; display: flex; gap: 15px;">
                                <button class="btn btn-primary">
                                    <i class="fas fa-download"></i>
                                    Create Backup Now
                                </button>
                                <button class="btn btn-outline">
                                    <i class="fas fa-history"></i>
                                    Restore from Backup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentDeleteId = null;
        // Toggle sidebar collapse/expand
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
        }

        // Toggle mobile sidebar
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('mobile-open');
        }

        // Toggle dark/light theme
        function toggleTheme() {
            document.body.setAttribute('data-theme', 
                document.body.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
            
            // Update theme toggle icon
            const themeToggle = document.querySelector('.theme-toggle i');
            themeToggle.classList.toggle('fa-moon');
            themeToggle.classList.toggle('fa-sun');
        }

        // Show/hide modules
        function showModule(moduleId) {
            // Hide all modules
            document.querySelectorAll('.module-container').forEach(module => {
                module.style.display = 'none';
            });
            
            // Show selected module
            document.getElementById(moduleId).style.display = 'block';
            
            // Update active nav item
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
            });
            event.currentTarget.classList.add('active');
            
            // Add slide-in animation
            document.getElementById(moduleId).classList.add('slide-in');
            setTimeout(() => {
                document.getElementById(moduleId).classList.remove('slide-in');
            }, 300);
        }

        // Show/hide user account types
        function showUserType(type) {
            // Hide all account types
            document.querySelectorAll('.user-accounts').forEach(account => {
                account.style.display = 'none';
            });
            
            // Show selected account type
            document.getElementById(`${type}-accounts`).style.display = 'block';
            
            // Update active tab
            document.querySelectorAll('.nav-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.currentTarget.classList.add('active');
        }

        // Show/hide configuration tabs
        function showConfigTab(tab) {
            // Hide all tabs
            document.querySelectorAll('.config-content').forEach(content => {
                content.style.display = 'none';
            });
            
            // Show selected tab
            document.getElementById(`${tab}-tab`).style.display = 'block';
            
            // Update active tab
            document.querySelectorAll('.nav-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.currentTarget.classList.add('active');
        }

        // Show/hide subtabs
        function showSubTab(subtab) {
            // Hide all subtabs
            document.querySelectorAll('.subtab-content').forEach(content => {
                content.style.display = 'none';
            });
            
            // Show selected subtab
            document.getElementById(`subtab-${subtab}`).style.display = 'block';
            
            // Update active subtab
            const subtabNavs = event.currentTarget.parentElement.querySelectorAll('.nav-tab');
            subtabNavs.forEach(tab => {
                tab.classList.remove('active');
            });
            event.currentTarget.classList.add('active');
        }

        // Show/hide settings tabs
        function showSettingsTab(tab) {
            // Hide all tabs
            document.querySelectorAll('.settings-content').forEach(content => {
                content.style.display = 'none';
            });
            
            // Show selected tab
            document.getElementById(`${tab}-settings-tab`).style.display = 'block';
            
            // Update active tab
            document.querySelectorAll('.nav-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.currentTarget.classList.add('active');
        }

        // Generate report
        function generateReport(type) {
            alert(`Generating ${type} report...`);
            // In a real application, this would trigger an API call to generate the report
        }

        // Add college
        function addCollege() {
    const name = document.getElementById("college-name").value.trim();
    const nick = document.getElementById("college-code").value.trim();

    if (name === "" || nick === "") {
        alert("Please fill in both fields.");
        return;
    }

    const formData = new FormData();
    formData.append("deptname", name);
    formData.append("deptnick", nick);

    fetch("add_college.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert("College added successfully!");
            location.reload();
        } else {
            alert("Error: " + data.error);
        }
    })
    .catch(err => alert("Request failed: " + err));
}

function submitEditCollege() {
    const deptid = document.getElementById("edit-deptid").value;
    const name = document.getElementById("edit-college-name").value;
    const nick = document.getElementById("edit-college-nick").value;

    const formData = new FormData();
    formData.append("deptid", deptid);
    formData.append("deptname", name);
    formData.append("deptnick", nick);

    fetch("update_college.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert("College updated successfully!");
            location.reload();
        } else {
            alert("Update failed: " + data.error);
        }
    });
}

function confirmDeleteCollege(deptid) {
    currentDeleteId = deptid;
    document.getElementById("delete-deptid").value = deptid;
    document.getElementById("deleteCollegeModal").style.display = "block";
    document.getElementById("modalOverlay").style.display = "block";
}

function closeDeleteModal() {
    document.getElementById("deleteCollegeModal").style.display = "none";
    document.getElementById("modalOverlay").style.display = "none";
    currentDeleteId = null;
}

function deleteCollege() {
    const deptid = document.getElementById("delete-deptid").value;

    const formData = new FormData();
    formData.append("deptid", deptid);

    fetch("delete_college.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert("College deleted successfully.");
            location.reload();
        } else {
            alert("Error deleting college: " + data.error);
        }
    });

    closeDeleteModal();
}

        // Add program
        function addProgram() {
    const progname = document.getElementById("program-name").value.trim();
    const deptid = document.getElementById("program-college").value;
    const progyear = document.getElementById("program-duration").value.trim();

    if (progname === "" || deptid === "" || progyear === "") {
        alert("Please fill out all fields.");
        return;
    }

    const formData = new FormData();
    formData.append("progname", progname);
    formData.append("deptid", deptid);
    formData.append("progyear", progyear);

    fetch("add_program.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert("Program added successfully!");
            // Optionally reload or reset form
            document.getElementById("program-name").value = "";
            document.getElementById("program-college").value = "";
            document.getElementById("program-duration").value = "";
        } else {
            alert("Error: " + data.error);
        }
    })
    .catch(err => alert("Request failed: " + err));
}

        // Add major
        function addMajor() {
            const name = document.getElementById('major-name').value;
            const program = document.getElementById('major-program').value;
            
            if (program !== 'Select Program') {
                alert(`Adding major: ${name || 'No major name'} to ${program}`);
            } else {
                alert('Please select a program');
            }
        }

        // Add year level
        function addYearLevel() {
            const program = document.getElementById('year-program').value;
            
            if (program !== 'Select Program') {
                alert(`Adding year level to ${program}`);
            } else {
                alert('Please select a program');
            }
        }

        // Add section
        function addSection() {
            const name = document.getElementById('section').value;
            const program = document.getElementById('section-program').value;
            const year = document.getElementById('section-year').value;
            
            if (name && program !== 'Select Program' && year !== 'Select Year Level') {
                alert(`Adding section: ${name} to ${program} (${year})`);
            } else {
                alert('Please fill all section details');
            }
        }

        // Initialize the dashboard
        document.addEventListener('DOMContentLoaded', function() {
            // Set dashboard as active module
            document.getElementById('dashboard').style.display = 'block';
            
            // Check for prefers-color-scheme and set theme accordingly
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.body.setAttribute('data-theme', 'dark');
                const themeToggle = document.querySelector('.theme-toggle i');
                themeToggle.classList.remove('fa-moon');
                themeToggle.classList.add('fa-sun');
            }
        });

        function openEditModal(deptid, name, nick) {
    document.getElementById("edit-deptid").value = deptid;
    document.getElementById("edit-college-name").value = name;
    document.getElementById("edit-college-nick").value = nick;
    document.getElementById("editCollegeModal").style.display = "block";
    document.getElementById("modalOverlay").style.display = "block";
}

function closeEditModal() {
    document.getElementById("editCollegeModal").style.display = "none";
    document.getElementById("modalOverlay").style.display = "none";
}


    </script>

    <!-- Edit College Modal -->
<div id="editCollegeModal" style="display: none; position: fixed; top: 20%; left: 30%; width: 40%; background: white; border: 1px solid #ccc; padding: 20px; z-index: 1000;">
    <h3>Edit College</h3>
    <input type="hidden" id="edit-deptid">
    <div class="form-group">
        <label>College Name</label>
        <input type="text" id="edit-college-name" class="form-control">
    </div>
    <div class="form-group">
        <label>Nickname</label>
        <input type="text" id="edit-college-nick" class="form-control">
    </div>
    <button class="btn btn-primary" onclick="submitEditCollege()">Save Changes</button>
    <button class="btn btn-secondary" onclick="closeEditModal()">Cancel</button>
</div>

<!-- Background Overlay -->
<div id="modalOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999;" onclick="closeEditModal()"></div>

<div id="deleteCollegeModal" style="display: none; position: fixed; top: 25%; left: 35%; width: 30%; background: white; border: 1px solid #ccc; padding: 20px; z-index: 1000;">
    <h3>Confirm Deletion</h3>
    <p>Are you sure you want to delete this college?</p>
    <input type="hidden" id="delete-deptid">
    <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
        <button class="btn btn-secondary" onclick="closeDeleteModal()">Cancel</button>
        <button class="btn btn-danger" onclick="deleteCollege()">Delete</button>
    </div>
</div>
</body>
</html>