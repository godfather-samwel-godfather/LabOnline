<?php
$labRepo = new LaboratoryRepository($conn);
$appointmentRepo = new AppointmentRepository($conn);

$labId = $labRepo->getIdByUserId(getCurrentUserId());
$appointments = $labId ? $appointmentRepo->getPendingUploadByLaboratoryId($labId) : [];
?>

<h4 class="mb-3">Upload Results</h4>
<?php flashMessage(); ?>

<?php if (!$labId): ?>
<div class="alert alert-warning">No laboratory profile linked to your account.</div>
<?php else: ?>

<div class="card p-4 shadow-sm">
    <form method="POST" action="../actions/labo/upload_result_process.php" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label">Select Appointment</label>
            <select name="appointment_id" class="form-select" required>
                <option value="">-- Choose appointment --</option>
                <?php foreach ($appointments as $row): ?>
                <option value="<?= e((string) $row['id']) ?>">
                    #<?= e((string) $row['id']) ?> — <?= e($row['patient_name']) ?>
                    (<?= e(formatDate($row['appointment_date'])) ?>)
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Result File (PDF / JPG / PNG)</label>
            <input type="file" name="result_file" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Remarks</label>
            <textarea name="remarks" class="form-control" rows="3"
                placeholder="Summary of test results..."></textarea>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-upload"></i> Upload Result
        </button>
    </form>
</div>

<?php endif; ?>
