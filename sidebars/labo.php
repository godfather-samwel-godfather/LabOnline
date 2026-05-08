<?php
$current = basename($_SERVER['PHP_SELF']);

function active($p){
    return basename($_SERVER['PHP_SELF']) == $p ? 'bg-primary rounded' : '';
}
?>

<div class="text-white p-2 fw-bold mb-3">
    <i class="bi bi-flask"></i> LAB PANEL
</div>

<a href="dashboard.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('dashboard.php') ?>">
    <i class="bi bi-speedometer2"></i><span>Dashboard</span>
</a>

<a href="test_requests.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('test_requests.php') ?>">
    <i class="bi bi-journal-text"></i><span>Test Requests</span>
</a>

<a href="upload_results.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('upload_results.php') ?>">
    <i class="bi bi-upload"></i><span>Upload Results</span>
</a>

<a href="patients.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('patients.php') ?>">
    <i class="bi bi-people"></i><span>Patients</span>
</a>

<a href="reports.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('reports.php') ?>">
    <i class="bi bi-file-earmark-bar-graph"></i><span>Reports</span>
</a>

<a href="notifications.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('notifications.php') ?>">
    <i class="bi bi-bell"></i><span>Notifications</span>
</a>

<a href="../auth/logout.php" class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none">
    <i class="bi bi-box-arrow-right"></i><span>Logout</span>
</a>