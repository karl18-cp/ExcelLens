<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExcelLens - Admin Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
    background-color: rgba(220, 53, 69, 0.05);  /* 5% opacity of your --danger color */
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
            margin-left: auto; /* Key line */
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
        
        /* Centered modules */
        .centered-module .module-body {
            max-width: 1200px;
            margin: 0 auto;
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

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 2000;
            justify-content: center;
            align-items: center;
        }
        
        .modal-content {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            width: 500px;
            max-width: 90%;
            padding: 30px;
            position: relative;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .modal-title {
            font-size: 1.5rem;
            color: var(--primary);
            margin: 0;
        }
        
        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-muted);
        }
        
        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
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
        .btn-blue-outline {
            color: #007bff;
            border: 1px solid #007bff;
            background-color: transparent;
            transition: 0.3s ease;
        }

        .btn-blue-outline:hover {
            background-color: #007bff;
            color: #fff;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .data-table th,
        .data-table td {
            text-align: left;
            padding: 10px 12px;
            border-bottom: 1px solid #ccc;
        }
        .data-table th {
            background-color: #f5f5f5;
        }
        .section-info {
    font-size: 0.95rem;
    color: #444;
    margin: 1rem 0 0.5rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar Navigation -->
        <?php include 'sidebar.php'; ?>
        
        <!-- Main Content Area -->
        <div class="main-content">
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
                            <div class="user-name">System Administrator</div>
                            <div class="user-role">Super Admin</div>
                        </div>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <div class="content-area">
               
            <!-- Account Management Module -->          
            <?php include 'account_management.php'; ?>

            <!-- System Configuration -->
            <?php include 'system_config.php'; ?>

            <!-- Admin Settings -->
            <?php include 'admin_settings.php'; ?>

                

                


            </div>
        </div>
    </div>

    <!-- Modals -->
    <div class="modal" id="editCollegeModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit College</h3>
                <button class="close-modal" onclick="closeModal('editCollegeModal')">&times;</button>
            </div>
            <form method="POST">
                <input type="hidden" name="action" value="update_college">
                <input type="hidden" name="id" id="edit-college-id">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Abbreviation</label>
                        <input type="text" name="code" id="edit-college-code" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">College Name</label>
                        <input type="text" name="name" id="edit-college-name" class="form-control" required>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('editCollegeModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
       
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
            const userTypeTabs = event.currentTarget.parentElement.querySelectorAll('.nav-tab');
            userTypeTabs.forEach(tab => tab.classList.remove('active'));
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
            const configTabs = event.currentTarget.parentElement.querySelectorAll('.nav-tab');
            configTabs.forEach(tab => tab.classList.remove('active'));
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
            const settingsTabs = event.currentTarget.parentElement.querySelectorAll('.nav-tab');
            settingsTabs.forEach(tab => tab.classList.remove('active'));
            event.currentTarget.classList.add('active');
        }
        
        function openEditModal(id, name, code) {
            document.getElementById('edit-college-id').value = id;
            document.getElementById('edit-college-name').value = name;
            document.getElementById('edit-college-code').value = code;
            document.getElementById('editCollegeModal').style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }


        // Initialize the dashboard
        document.addEventListener('DOMContentLoaded', function() {
            // Set dashboard as active module
            document.getElementById('dashboard').style.display = 'block';
            document.querySelector('.nav-item').classList.add('active'); // Activate dashboard nav item
            
            // Check for prefers-color-scheme and set theme accordingly
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.body.setAttribute('data-theme', 'dark');
                const themeToggle = document.querySelector('.theme-toggle i');
                if(themeToggle) {
                    themeToggle.classList.remove('fa-moon');
                    themeToggle.classList.add('fa-sun');
                }
            }
        });

//javscript for handling the tab switching of Academic Structure
function showCampusTab(tabName) {
    const tabs = document.querySelectorAll('.campus-tab-content');
    tabs.forEach(tab => tab.style.display = 'none');
    document.getElementById(tabName + '-tab').style.display = 'block';

    const navTabs = document.querySelectorAll('.nav-tabs .nav-tab');
    navTabs.forEach(tab => tab.classList.remove('active'));
    event.currentTarget.classList.add('active');
}

// Show/hide college tabs
function showCollegeTab(tab) {
    // Hide all college tabs
    document.querySelectorAll('.college-tab-content').forEach(content => {
        content.style.display = 'none';
    });
    
    // Show selected college tab
    document.getElementById(`${tab}-tab`).style.display = 'block';
    
    // Update active tab
    const collegeNavs = event.currentTarget.parentElement.querySelectorAll('.nav-tab');
    collegeNavs.forEach(tab => {
        tab.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
}

// Show/hide program tabs
function showProgramTab(tab) {
    // Hide all program tabs
    document.querySelectorAll('.program-tab-content').forEach(content => {
        content.style.display = 'none';
    });
    
    // Show selected program tab
    document.getElementById(`${tab}-tab`).style.display = 'block';
    
    // Update active tab
    const programNavs = event.currentTarget.parentElement.querySelectorAll('.nav-tab');
    programNavs.forEach(tab => {
        tab.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
}

// Show/hide major tabs
function showMajorTab(tab) {
    // Hide all major tabs
    document.querySelectorAll('.major-tab-content').forEach(content => {
        content.style.display = 'none';
    });
    
    // Show selected major tab
    document.getElementById(`${tab}-tab`).style.display = 'block';
    
    // Update active tab
    const majorNavs = event.currentTarget.parentElement.querySelectorAll('.nav-tab');
    majorNavs.forEach(tab => {
        tab.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
}

// Show/hide year level tabs
function showYearLevelTab(tab) {
    // Hide all year level tabs
    document.querySelectorAll('.year-level-tab-content').forEach(content => {
        content.style.display = 'none';
    });
    
    // Show selected year level tab
    document.getElementById(`${tab}-tab`).style.display = 'block';
    
    // Update active tab
    const yearLevelNavs = event.currentTarget.parentElement.querySelectorAll('.nav-tab');
    yearLevelNavs.forEach(tab => {
        tab.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
}

// Show/hide section tabs
function showSectionTab(tab) {
    // Hide all section tabs
    document.querySelectorAll('.section-tab-content').forEach(content => {
        content.style.display = 'none';
    });
    
    // Show selected section tab
    document.getElementById(`${tab}-tab`).style.display = 'block';
    
    // Update active tab
    const sectionNavs = event.currentTarget.parentElement.querySelectorAll('.nav-tab');
    sectionNavs.forEach(tab => {
        tab.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
}



//Javascript for the Account management module

// Show/hide VCAA tabs
function showVCAATab(tab) {
    // Hide all VCAA tabs
    document.querySelectorAll('.vcaa-tab-content').forEach(content => {
        content.style.display = 'none';
    });
    
    // Show selected VCAA tab
    document.getElementById(`${tab}-tab`).style.display = 'block';
    
    // Update active tab
    const vcaaNavs = event.currentTarget.parentElement.querySelectorAll('.nav-tab');
    vcaaNavs.forEach(tab => {
        tab.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
}

// Show/hide Dean tabs
function showDeanTab(tab) {
    // Hide all Dean tabs
    document.querySelectorAll('.dean-tab-content').forEach(content => {
        content.style.display = 'none';
    });
    
    // Show selected Dean tab
    document.getElementById(`${tab}-tab`).style.display = 'block';
    
    // Update active tab
    const deanNavs = event.currentTarget.parentElement.querySelectorAll('.nav-tab');
    deanNavs.forEach(tab => {
        tab.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
}

// Show/hide Chair tabs
function showChairTab(tab) {
    // Hide all Chair tabs
    document.querySelectorAll('.chair-tab-content').forEach(content => {
        content.style.display = 'none';
    });
    
    // Show selected Chair tab
    document.getElementById(`${tab}-tab`).style.display = 'block';
    
    // Update active tab
    const chairNavs = event.currentTarget.parentElement.querySelectorAll('.nav-tab');
    chairNavs.forEach(tab => {
        tab.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
}
function searchTable(tableId, query) {
    const table = document.getElementById(tableId);
    const rows = table.querySelectorAll("tbody tr");
    rows.forEach(row => {
        const nameCell = row.cells[0]?.textContent.toLowerCase();
        row.style.display = nameCell.includes(query.toLowerCase()) ? "" : "none";
    });
}

    </script>
</body>
</html>
