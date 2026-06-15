<?php
$current_page = $_GET['page'] ?? 'home';
require_once __DIR__ . '/../includes/helpers.php';
?>

<div class="sidebar d-none d-md-flex flex-column p-3 vh-100 position-fixed sidebar-bg text-white"
    style="width: 250px; top: 56px;">
    <div class="nav nav-pills flex-column mb-auto gap-1">
        <a href="dashboard.php?page=home"
            class="nav-link d-flex align-items-center gap-2 p-2 text-white <?= sidebarActive('home', $current_page) ?>">
            <i class="bi bi-speedometer2"></i><span>Dashboard</span>
        </a>

        <a href="dashboard.php?page=view_appointments"
            class="nav-link d-flex align-items-center gap-2 p-2 text-white <?= sidebarActive('view_appointments', $current_page) ?>">
            <i class="bi bi-calendar-check"></i><span>View Appointments</span>
        </a>

        <a href="dashboard.php?page=view_labo_results"
            class="nav-link d-flex align-items-center gap-2 p-2 text-white <?= sidebarActive('view_labo_results', $current_page) ?>">
            <i class="bi bi-journal-text"></i><span>View Lab Results</span>
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
