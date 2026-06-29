<?php
$userRepo = new UserRepository($conn);
$appointmentRepo = new AppointmentRepository($conn);

$totalUsers = $userRepo->countAll();
$totalDoctors = $userRepo->countByRole('doctor');
$totalPatients = $userRepo->countByRole('patient');
$totalLabo = $userRepo->countByRole('labo');
$pendingUsers = $userRepo->countByStatus('pending');
$totalAppointments = $appointmentRepo->countAll();
?>

<h4 class="mb-4">Admin Dashboard</h4>
<?php flashMessage(); ?>

<!-- ================= STATS CARDS ================= -->
<div class="row g-3">

    <!-- USERS -->
    <div class="col-md-3">
        <div class="card p-3 shadow-sm text-white bg-primary">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>Total Users</h6>
                    <h3><?= $totalUsers ?></h3>
                </div>
                <i class="bi bi-people fs-2"></i>
            </div>
        </div>
    </div>

    <!-- DOCTORS -->
    <div class="col-md-3">
        <div class="card p-3 shadow-sm text-white bg-success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>Doctors</h6>
                    <h3><?= $totalDoctors ?></h3>
                </div>
                <i class="bi bi-heart-pulse fs-2"></i>
            </div>
        </div>
    </div>

    <!-- PATIENTS -->
    <div class="col-md-3">
        <div class="card p-3 shadow-sm text-white bg-warning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>Patients</h6>
                    <h3><?= $totalPatients ?></h3>
                </div>
                <i class="bi bi-person fs-2"></i>
            </div>
        </div>
    </div>

    <!-- LAB STAFF -->
    <div class="col-md-3">
        <div class="card p-3 shadow-sm text-white bg-dark">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>Labo Staff</h6>
                    <h3><?= $totalLabo ?></h3>
                </div>
                <i class="bi bi-flask fs-2"></i>
            </div>
        </div>
    </div>

</div>

<!-- ================= QUICK ACTIONS ================= -->
<div class="card mt-4 p-3 shadow-sm">
    <h5>Quick Actions</h5>

    <div class="d-flex gap-3 flex-wrap mt-2">

        <button class="btn btn-primary" onclick="location.href='dashboard.php?page=users'">
            <i class="bi bi-people"></i> Manage Users
        </button>

        <button class="btn btn-warning" onclick="location.href='dashboard.php?page=lab_tests'">
            <i class="bi bi-flask"></i> View Lab Tests
        </button>

    </div>
</div>

<!-- ================= RECENT ACTIVITY ================= -->
<div class="card mt-4 p-3 shadow-sm">
    <h5>Recent Activity</h5>

    <ul class="list-group list-group-flush mt-2">

        <li class="list-group-item">Pending user approvals: <strong><?= $pendingUsers ?></strong></li>
        <li class="list-group-item">Total appointments in system: <strong><?= $totalAppointments ?></strong></li>
        <li class="list-group-item">Active doctors: <strong><?= $totalDoctors ?></strong></li>
        <li class="list-group-item">Registered patients: <strong><?= $totalPatients ?></strong></li>

    </ul>
</div>
<div class="card mt-4 p-3 shadow-sm">
    <h5>System Analytics</h5>
    <canvas id="adminChart"></canvas>
</div>

<script>
const ctx = document.getElementById('adminChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Doctors', 'Patients', 'Lab', 'Appointments', 'Users'],
        datasets: [{
            label: 'System Overview',
            data: [<?= $totalDoctors ?>, <?= $totalPatients ?>, <?= $totalLabo ?>, <?= $totalAppointments ?>, <?= $totalUsers ?>],
            backgroundColor: [
                '#28a745',
                '#ffc107',
                '#343a40',
                '#0d6efd',
                '#6f42c1'
            ]
        }]
    }
});
</script>



<!--📁 Ongeza hii kwenye admin/content.php 🔗 Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js">
</script>