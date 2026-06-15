<?php
$resultRepo = new TestResultRepository($conn);
$labTestRepo = new LabTestRepository($conn);
$results = $resultRepo->getByDoctorUserId(getCurrentUserId());
?>

<div class="page-header shadow-lg p-4 bg-primary text-white mb-4">
    <h2 class="fw-bold mb-2">Lab Results</h2>
    <p class="mb-0 opacity-75">View test results for your patients.</p>
</div>

<?php flashMessage(); ?>

<div class="card shadow-lg border-0 rounded-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Patient</th>
                    <th>Appointment</th>
                    <th>Tests</th>
                    <th>Uploaded</th>
                    <th>Status</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($results)): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">No lab results yet.</td>
                </tr>
                <?php else: ?>
                <?php foreach ($results as $row): ?>
                <tr>
                    <td class="fw-bold"><?= e($row['patient_name']) ?></td>
                    <td>#<?= e((string) $row['appointment_id']) ?></td>
                    <td><?= e($labTestRepo->getNamesByAppointmentId((int) $row['appointment_id'])) ?></td>
                    <td><?= e(formatDate($row['uploaded_at'])) ?></td>
                    <td>
                        <span class="badge <?= statusBadge($row['status']) ?>">
                            <?= e(ucfirst($row['status'])) ?>
                        </span>
                    </td>
                    <td>
                        <?php if (!empty($row['result_file'])): ?>
                        <a href="../<?= e($row['result_file']) ?>" target="_blank" class="btn btn-sm btn-primary">
                            <i class="bi bi-eye"></i> View
                        </a>
                        <?php else: ?>
                        -
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
