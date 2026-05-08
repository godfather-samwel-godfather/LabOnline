<?php
$current = basename($_SERVER['PHP_SELF']);

function active($p){
    return basename($_SERVER['PHP_SELF']) == $p ? 'bg-primary rounded' : '';
}
?>

<div class="text-white p-2 fw-bold mb-3">
    <i class="bi bi-shield-lock"></i> ADMIN PANEL
</div>

<a href="dashboard.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('dashboard.php') ?>">
    <i class="bi bi-speedometer2"></i><span>Dashboard</span>
</a>

<a href="users.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('manage_users.php') ?>">
    <i class="bi bi-people"></i><span>Users</span>
</a>

<a href="doctors_list.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('doctors_list.php') ?>">
    <i class="bi bi-heart-pulse"></i><span>Doctors</span>
</a>

<a href="patients_list.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('patients_list.php') ?>">
    <i class="bi bi-person"></i><span>Patients</span>
</a>

<a href="labo.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('labo.php') ?>">
    <i class="bi bi-person-vcard"></i><span>Labo Staff</span>
</a>

<a href="appointments.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('appointments.php') ?>">
    <i class="bi bi-calendar-check"></i><span>Appointments</span>
</a>

<a href="reports.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('reports.php') ?>">
    <i class="bi bi-bar-chart"></i><span>Reports</span>
</a>

<a href="settings.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('settings.php') ?>">
    <i class="bi bi-gear"></i><span>Settings</span>
</a>

<a href="../auth/logout.php" class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none">
    <i class="bi bi-box-arrow-right"></i><span>Logout</span>
</a>