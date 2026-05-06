<?php
$current = basename($_SERVER['PHP_SELF']);
function active($p){ return basename($_SERVER['PHP_SELF'])==$p ? 'bg-primary rounded' : ''; }
?>

<a href="dashboard.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('dashboard.php') ?>">
    <i class="bi bi-speedometer2"></i><span>Dashboard</span>
</a>

<a href="appointments.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('appointments.php') ?>">
    <i class="bi bi-calendar-check"></i><span>My Appointments</span>
</a>

<a href="results.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('results.php') ?>">
    <i class="bi bi-journal-text"></i><span>Test Results</span>
</a>

<a href="prescriptions.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('prescriptions.php') ?>">
    <i class="bi bi-capsule-pill"></i><span>Prescriptions</span>
</a>

<a href="book.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('book.php') ?>">
    <i class="bi bi-plus-circle"></i><span>Book Appointment</span>
</a>

<a href="messages.php"
    class="d-flex align-items-center gap-2 p-2 text-white text-decoration-none <?= active('messages.php') ?>">
    <i class="bi bi-chat-dots"></i><span>Messages</span>
</a>