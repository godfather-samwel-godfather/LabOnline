<?php
$current_page = $_GET['page'] ?? 'home';

function active($p, $current){ 
    // Tunatumia 'active' class ya bootstrap na rangi ya bluu
    return ($p === $current) ? 'bg-primary shadow-sm' : ''; 
}
?>

<div class="sidebar d-none d-md-flex flex-column p-3 vh-100 position-fixed sidebar-bg text-white"
    style="width: 250px; top: 56px;">
    <div class="nav nav-pills flex-column mb-auto gap-1">
        <div class="sidebar d-flex flex-column p-3 vh-100 position-fixed text-white"
            style="width:250px; background:#1f2937; top:56px;">

            <!-- TITLE -->
            <div class="text-white p-2 fw-bold mb-3">
                <i class="bi bi-shield-lock"></i> ADMIN PANEL
            </div>


            <!-- DASHBOARD -->
            <a href="dashboard.php?page=home" class="menu-item <?= active('home', $current_page) ?>">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <hr class="text-white-50">

            <button class="btn menu-btn text-start w-100 d-flex align-items-center gap-2" data-bs-toggle="collapse"
                data-bs-target="#userMgmt">
                <i class="bi bi-people"></i>
                <span>User Management</span>
                <span class="ms-auto">▼</span>
            </button>

            <div class="collapse ps-4" id="userMgmt">

                <a href="dashboard.php?page=add_user" class="submenu-item <?= active('add_user', $current_page) ?>">
                    Add User
                </a>

                <a href="dashboard.php?page=view_users" class="submenu-item <?= active('view_users', $current_page) ?>">
                    View Users
                </a>

                <a href="dashboard.php?page=doctors" class="submenu-item <?= active('doctors', $current_page) ?>">
                    Doctors
                </a>

                <a href="dashboard.php?page=patients" class="submenu-item <?= active('patients', $current_page) ?>">
                    Patients
                </a>

                <a href="dashboard.php?page=lab_staff" class="submenu-item <?= active('lab_staff', $current_page) ?>">
                    Lab Staff
                </a>

            </div>

            <hr class="text-white-50">

            <button class="btn menu-btn text-start w-100 d-flex align-items-center gap-2" data-bs-toggle="collapse"
                data-bs-target="#userControl">
                <i class="bi bi-shield-lock"></i>
                <span>User Control</span>
                <span class="ms-auto">▼</span>
            </button>

            <div class="collapse ps-4" id="userControl">

                <a href="dashboard.php?page=suspend_users"
                    class="submenu-item <?= active('suspend_users', $current_page) ?>">
                    Suspend Users
                </a>

                <a href="dashboard.php?page=activate_users"
                    class="submenu-item <?= active('activate_users', $current_page) ?>">
                    Activate Users
                </a>

                <a href="dashboard.php?page=assign_roles"
                    class="submenu-item <?= active('assign_roles', $current_page) ?>">
                    Assign Roles
                </a>

            </div>

            <hr class="text-white-50">

            <button class="btn menu-btn text-start w-100 d-flex align-items-center gap-2" data-bs-toggle="collapse"
                data-bs-target="#system">
                <i class="bi bi-gear"></i>
                <span>System</span>
                <span class="ms-auto">▼</span>
            </button>

            <div class="collapse ps-4" id="system">

                <a href="dashboard.php?page=settings" class="submenu-item <?= active('settings', $current_page) ?>">
                    Settings
                </a>

                <a href="dashboard.php?page=notifications"
                    class="submenu-item <?= active('notifications', $current_page) ?>">
                    Notifications
                </a>

            </div>
            <div class="nav nav-pills flex-column mt-auto pb-5">
                <hr class="text-white-50">
                <a href="../auth/logout.php" class="nav-link text-white d-flex align-items-center gap-3">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>
</div>