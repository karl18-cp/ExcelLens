<?php
// sidebar.php – white sidebar, red active accent, DARK-GRAY text for everything
?>
<aside id="sidebar" class="sidebar">
    <div class="logo">
        <button class="logo-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' fill='%23fff'/%3E%3Cpath d='M20 30h60v8H20zm0 16h60v8H20zm0 16h40v8H20z' fill='%23990000'/%3E%3C/svg%3E" alt="ExcelLens Logo">
        <h3 class="logo-text">Admin Portal</h3>
    </div>

    <nav class="nav-menu">
        <!-- Management Section -->
        <section class="nav-section">
            <h4 class="nav-section-title">Management</h4>

            <div class="nav-item" onclick="toggleSubmenu('account-submenu')">
                <i class="fas fa-users-cog"></i>
                <span class="nav-text">Account Management</span>
                <i class="fas fa-chevron-down toggle-arrow"></i>
            </div>

            <div id="account-submenu" class="submenu">
                <a class="nav-item" onclick="showModule('account-management'); showUserType('vcaa')">
                    <i class="fas fa-user-tie"></i>
                    <span class="nav-text">VCAA</span>
                </a>
                <a class="nav-item" onclick="showModule('account-management'); showUserType('deans')">
                    <i class="fas fa-user-graduate"></i>
                    <span class="nav-text">College Deans</span>
                </a>
                <a class="nav-item" onclick="showModule('account-management'); showUserType('chairs')">
                    <i class="fas fa-user-cog"></i>
                    <span class="nav-text">Chairpersons</span>
                </a>
        
            </div>
        </section>

        <!-- System Configuration -->
        <section class="nav-section">
            <h4 class="nav-section-title">System Configuration</h4>

            <div class="nav-item" onclick="toggleSubmenu('config-submenu')">
                <i class="fas fa-cog"></i>
                <span class="nav-text">System Configuration</span>
                <i class="fas fa-chevron-down toggle-arrow"></i>
            </div>

            <div id="config-submenu" class="submenu">
                <a class="nav-item" onclick="showModule('campus-module')">
                    <i class="fas fa-map-marker-alt"></i>
                    <span class="nav-text">Campus</span>
                </a>
                <a class="nav-item" onclick="showModule('colleges-module')">
                    <i class="fas fa-building"></i>
                    <span class="nav-text">Colleges</span>
                </a>
                <a class="nav-item" onclick="showModule('programs-module')">
                    <i class="fas fa-graduation-cap"></i>
                    <span class="nav-text">Programs</span>
                </a>
                <a class="nav-item" onclick="showModule('majors-module')">
                    <i class="fas fa-book"></i>
                    <span class="nav-text">Majors</span>
                </a>
            </div>
        </section>

        <!-- System -->
        <section class="nav-section">
            <h4 class="nav-section-title">System</h4>
            <a class="nav-item" onclick="showModule('settings')">
                <i class="fas fa-sliders-h"></i>
                <span class="nav-text">Admin Settings</span>
            </a>
            <a class="nav-item" href="logout.php">
                <i class="fas fa-sign-out-alt"></i>
                <span class="nav-text">Logout</span>
            </a>
        </section>
    </nav>
</aside>

<style>
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 260px;
    height: 100vh;
    background: #fff;
    color: #333;
    box-shadow: 2px 0 6px rgba(0, 0, 0, 0.1);
    transition: width 0.3s ease;
    overflow-y: auto;
    z-index: 1000;
}

.sidebar.collapsed {
    width: 70px;
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

.sidebar.collapsed ~ .main-content {
    margin-left: 70px;
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
    color: #333;
    font-size: 1.25rem;
    cursor: pointer;
}
.logo img {
    height: 32px;
}
.logo-text {
    font-size: 1.1rem;
    font-weight: 700;
    transition: opacity 0.2s ease;
}

.nav-menu {
    padding: 1rem 0.5rem;
}

.nav-section + .nav-section {
    margin-top: 1.5rem;
}
.nav-section-title {
    margin: 0.75rem 1rem;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #333;
    transition: opacity 0.2s ease;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.65rem 1rem;
    border-radius: 0.35rem 0 0 0.35rem;
    text-decoration: none;
    color: #333;
    font-weight: 500;
    transition: background 0.15s ease, color 0.15s ease;
    cursor: pointer;
}
.nav-item i {
    color: #333;
}
.nav-item:hover {
    background: rgba(0, 0, 0, 0.05);
}
.nav-item.active {
    background: rgba(153, 0, 0, 0.08);
    border-left: 4px solid #990000;
}
.nav-item.active i {
    color: #990000;
}

.nav-text {
    transition: opacity 0.2s ease;
}

.toggle-arrow {
    margin-left: auto;
    transition: opacity 0.2s ease;
}

/* Submenu */
.submenu {
    display: none;
    margin-left: 1rem;
    border-left: 2px solid rgba(153, 0, 0, 0.1);
}
.submenu .nav-item {
    padding-left: 1.5rem;
    font-size: 0.9rem;
}
.submenu.show {
    display: block;
}

/* Scrollbar */
.sidebar::-webkit-scrollbar {
    width: 6px;
}
.sidebar::-webkit-scrollbar-thumb {
    background-color: rgba(72, 71, 71, 0.4);
    border-radius: 3px;
}
.sidebar::-webkit-scrollbar-track {
    background: transparent;
}

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
}
</style>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const submenus = sidebar.querySelectorAll('.submenu');
    sidebar.classList.toggle('collapsed');

    if (sidebar.classList.contains('collapsed')) {
        submenus.forEach(sub => sub.classList.remove('show'));
    }
}

function toggleSubmenu(id) {
    const submenu = document.getElementById(id);
    submenu.classList.toggle('show');
}
</script>
