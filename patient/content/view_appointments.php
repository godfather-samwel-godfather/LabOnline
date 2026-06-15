<?php
$appointmentRepo = new AppointmentRepository($conn);
$labTestRepo = new LabTestRepository($conn);
$patientId = getCurrentUserId();

$appointments = $appointmentRepo->getByPatientId($patientId);
$pendingCount = $appointmentRepo->countByPatientAndStatus($patientId, 'pending');
$approvedCount = $appointmentRepo->countByPatientAndStatus($patientId, 'approved');
$completedCount = $appointmentRepo->countByPatientAndStatus($patientId, 'completed');
?>

<!-- Header -->
<div class="page-header shadow mb-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>
            <h3>My Appointments</h3>
            <p class="mb-0">Track all your appointments and their status.</p>
        </div>

        <a href="?page=create_appointment"
            class="btn btn-light btn-lg px-4 py-2 shadow-sm fw-bold d-inline-flex align-items-center">
            <i class="bi bi-plus-circle-fill me-2" style="font-size: 1.2rem;"></i>
            New Appointment
        </a>

    </div>

</div>

<?php flashMessage(); ?>

<!-- Statistics -->
<div class="row g-4 mb-4">

    <div class="col-md-4">
        <div class="card stats-card shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Pending</h6>
                    <h2><?= $pendingCount ?></h2>
                </div>
                <div class="icon-box bg-orange">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stats-card shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Approved</h6>
                    <h2><?= $approvedCount ?></h2>
                </div>
                <div class="icon-box bg-blue">
                    <i class="bi bi-check2-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stats-card shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Completed</h6>
                    <h2><?= $completedCount ?></h2>
                </div>
                <div class="icon-box bg-green">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Appointment Table -->
<div class="card table-card shadow-sm p-4">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h5 class="mb-3 mb-md-0">Recent Appointments</h5>
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Doctor</th>
                    <th>Laboratory</th>
                    <th>Tests</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($appointments)): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">No appointments yet.</td>
                </tr>
                <?php else: ?>
                <?php foreach ($appointments as $i => $row): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td>
                        <?= e(formatDate($row['appointment_date'])) ?>
                        <br>
                        <small class="text-muted"><?= e(formatTime($row['appointment_time'])) ?></small>
                    </td>
                    <td><?= e($row['doctor_name'] ?? 'Not assigned') ?></td>
                    <td><?= e($row['labo_name'] ?? '-') ?></td>
                    <td><small><?= e($labTestRepo->getNamesByAppointmentId((int) $row['id'])) ?></small></td>
                    <td>
                        <span class="badge <?= statusBadge($row['status']) ?>">
                            <?= e(ucfirst($row['status'])) ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
