<?php
$current_page = $_GET['page'] ?? 'home';
require_once __DIR__ . '/../includes/helpers.php';
?>

<div class="sidebar d-none d-md-flex flex-column p-3 vh-100 position-fixed sidebar-bg text-white"
    style="width: 250px; top: 56px;">
    <div class="nav nav-pills flex-column mb-auto gap-1">
        <div class="sidebar d-flex flex-column p-3 vh-100 position-fixed text-white"
            style="width:250px; background:#1f2937; top:56px;">

            <div class="text-white p-2 fw-bold mb-3">
                <i class="bi bi-shield-lock"></i> ADMIN PANEL
            </div>

            <a href="dashboard.php?page=home" class="menu-item <?= sidebarActive('home', $current_page) ?>">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <hr class="text-white-50">

            <a href="dashboard.php?page=users" class="menu-item <?= sidebarActive('users', $current_page) ?>">
                <i class="bi bi-people"></i>
                <span>Manage Users</span>
            </a>

            <a href="dashboard.php?page=lab_tests" class="menu-item <?= sidebarActive('lab_tests', $current_page) ?>">
                <i class="bi bi-eyedropper"></i>
                <span>Lab Tests</span>
            </a>

            <a href="dashboard.php?page=add_new_tests"
                class="menu-item <?= sidebarActive('add_new_tests', $current_page) ?>">
                <i class="bi bi-plus-circle"></i>
                <span>Add New Tests</span>
            </a>


            <a href="dashboard.php?page=contact_messages"
                class="menu-item <?= sidebarActive('contact_messages', $current_page) ?>">
                <i class="bi bi-chat-text"></i>
                <span>Messages</span>
            </a>

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