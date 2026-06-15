<?php
$labRepo = new LaboratoryRepository($conn);
$appointmentRepo = new AppointmentRepository($conn);

$labId = $labRepo->getIdByUserId(getCurrentUserId());
$requests = $labId ? $appointmentRepo->getByLaboratoryId($labId, ['pending', 'approved']) : [];
?>

<h4 class="mb-3">Test Requests</h4>
<?php flashMessage(); ?>

<?php if (!$labId): ?>
<div class="alert alert-warning">No laboratory profile linked to your account.</div>
<?php else: ?>

<div class="card p-3 shadow-sm">
    <div class="table-responsive">
        <table class="table table-striped mt-2 align-middle">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($requests)): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">No test requests yet.</td>
                </tr>
                <?php else: ?>
                <?php foreach ($requests as $row): ?>
                <tr>
                    <td><?= e($row['patient_name']) ?></td>
                    <td><?= e(formatDate($row['appointment_date'])) ?></td>
                    <td><?= e(formatTime($row['appointment_time'])) ?></td>
                    <td>
                        <span class="badge <?= $row['priority'] === 'urgent' ? 'bg-danger' : 'bg-success' ?>">
                            <?= e(ucfirst($row['priority'])) ?>
                        </span>
                    </td>
                    <td>
                        <span class="badge <?= statusBadge($row['status']) ?>">
                            <?= e(ucfirst($row['status'])) ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($row['status'] === 'pending'): ?>
                        <form method="POST" action="../actions/labo/approve_appointment.php" class="d-inline">
                            <input type="hidden" name="appointment_id" value="<?= e((string) $row['id']) ?>">
                            <button type="submit" class="btn btn-sm btn-primary">Approve</button>
                        </form>
                        <?php else: ?>
                        <span class="text-muted small">Ready for upload</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php endif; ?>
