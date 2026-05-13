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
        <div class="text-white p-2 fw-bold mb-3">
            <i class="bi bi-shield-lock"></i> ADMIN PANEL
        </div>

        <a href="dashboard.php?page=home"
            class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('home', $current_page) ?>">
            <i class="bi bi-speedometer2"></i><span>Dashboard</span>
        </a>

        <a href="dashboard.php?page=manage_users"
            class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('manage_users', $current_page) ?>">
            <i class="bi bi-people"></i><span>Manage Users</span>
        </a>

        <a href="dashboard.php?page=doctors_list"
            class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('doctors_list', $current_page) ?>">
            <i class="bi bi-heart-pulse"></i><span>Doctors</span>
        </a>

        <a href="dashboard.php?page=patients_list"
            class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('patients_list', $current_page) ?>">
            <i class="bi bi-person"></i><span>Patients</span>
        </a>

        <a href="dashboard.php?page=labo_tests"
            class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('labo_tests', $current_page) ?>">
            <i class="bi bi-person-vcard"></i><span>Labo Tests</span>
        </a>

        <a href="dashboard.php?page=appointments"
            class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('appointments', $current_page) ?>">
            <i class="bi bi-calendar-check"></i><span>Appointments</span>
        </a>

        <a href="dashboard.php?page=reports"
            class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('reports', $current_page) ?>">
            <i class="bi bi-bar-chart"></i><span>Reports</span>
        </a>

        <a href="dashboard.php?page=settings"
            class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('settings', $current_page) ?>">
            <i class="bi bi-gear"></i><span>Settings</span>
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