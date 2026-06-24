<?php
$labRepo = new LaboratoryRepository($conn);
$appointmentRepo = new AppointmentRepository($conn);

$labId = $labRepo->getIdByUserId(getCurrentUserId());
$appointments = $labId ? $appointmentRepo->getPendingUploadByLaboratoryId($labId) : [];
?>

<h4 class="mb-3">
    <i class="bi bi-cloud-upload me-2"></i>
    Upload Results
</h4>

<?php flashMessage(); ?>


<?php if (!$labId): ?>

<div class="alert alert-warning">
    No laboratory profile linked to your account.
</div>


<?php else: ?>


<?php if (empty($appointments)): ?>


<div class="text-center py-5">

    <i class="bi bi-file-earmark-x fs-1 text-muted"></i>

    <h5 class="mt-3">
        No approved appointments available
    </h5>

    <p class="text-muted">
        Complete testing before uploading results.
    </p>

</div>


<?php else: ?>


<div class="card p-4 shadow-sm border-0 rounded-4">

    <form method="POST" action="../actions/labo/upload_result_process.php" enctype="multipart/form-data">


        <div class="mb-3">

            <label class="form-label">

                <i class="bi bi-calendar-check me-1"></i>

                Select Appointment

            </label>


            <select name="appointment_id" class="form-select" required>


                <option value="">
                    -- Choose appointment --
                </option>


                <?php foreach ($appointments as $row): ?>


                <option value="<?= e((string) $row['id']) ?>">

                    #<?= e((string) $row['id']) ?>
                    —
                    <?= e($row['patient_name']) ?>

                    (<?= e(formatDate($row['appointment_date'])) ?>)

                </option>


                <?php endforeach; ?>


            </select>


        </div>



        <div class="mb-3">

            <label class="form-label">

                <i class="bi bi-file-earmark-arrow-up me-1"></i>

                Result File (PDF / JPG / PNG)

            </label>


            <input type="file" name="result_file" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>

        </div>



        <div class="mb-3">

            <label class="form-label">

                <i class="bi bi-chat-left-text me-1"></i>

                Remarks

            </label>


            <textarea name="remarks" class="form-control" rows="3" placeholder="Summary of test results..."></textarea>


        </div>



        <button type="submit" class="btn btn-success px-4">


            <i class="bi bi-cloud-upload me-1"></i>

            Upload Test Result


        </button>



    </form>


</div>


<?php endif; ?>


<?php endif; ?>