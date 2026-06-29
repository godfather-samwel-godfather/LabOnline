<?php
$rebookId = (int)($_GET['rebook'] ?? 0);

$oldAppointment = null;
$oldTests = [];

$appointmentRepo = new AppointmentRepository($conn);

if($rebookId > 0){
    $oldAppointment = $appointmentRepo->getById($rebookId);
    
    
    if($oldAppointment){
        $oldTests = $appointmentRepo->getTestsByAppointmentId($rebookId);
    }

}


$labRepo = new LaboratoryRepository($conn);
$labTestRepo = new LabTestRepository($conn);
$userRepo = new UserRepository($conn);

$laboratories = $labRepo->getAll();
$tests = $labTestRepo->getAllWithCategory();
$doctors = $userRepo->getActiveDoctors();
$patientName = $_SESSION['full_name'] ?? 'Patient';
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                <div class="card-header welcome-card bg-lab-gradient border-0 p-4 text-white text-center">
                    <h3 class="mb-1 fw-bold">Book Lab Appointment</h3>
                    <p class="mb-0 opacity-75">Fill in the details to schedule your test</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <?php flashMessage(); ?>

                    <form method="POST" action="../actions/patient/create_appointment_process.php">
                        <?php if($rebookId): ?>

                        <input type="hidden" name="rebook_id" value="<?= $rebookId ?>">

                        <?php endif; ?>

                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="icon-box rounded-3 d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <h5 class="mb-0 fw-bold text-info">Patient Information</h5>
                        </div>

                        <div class="alert alert-light border mb-4">
                            <strong>Logged in as:</strong> <?= e($patientName) ?>
                            <br><small class="text-muted">Your account details will be used automatically.</small>
                        </div>

                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="icon-box rounded-3 d-flex align-items-center justify-content-center">
                                <i class="bi bi-calendar2-check-fill"></i>
                            </div>
                            <h5 class="mb-0 fw-bold text-info">Appointment Details</h5>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="small text-muted mb-1">Preferred Date</label>
                                <input type="date" name="appointment_date" class="form-control rounded-3" required>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted mb-1">Preferred Time</label>
                                <input type="time" name="appointment_time" class="form-control rounded-3" required>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted mb-1">Select Laboratory</label>
                                <select name="laboratory_id" class="form-select rounded-3 py-2" required>
                                    <option value="">-- Choose Laboratory --</option>
                                    <?php foreach ($laboratories as $lab): ?>
                                    <option value="<?= e((string) $lab['id']) ?>"
                                        <?php if ($oldAppointment && $oldAppointment['laboratory_id'] == $lab['id']): ?>selected<?php endif; ?>>
                                        <?= e($lab['labo_name']) ?>
                                        (<?= e($lab['location']) ?>)
                                    </option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                            <div class=" col-md-6">
                                <label class="small text-muted mb-1">Doctor (Optional)</label>
                                <select name="doctor_id" class="form-select rounded-3 py-2">
                                    <option value="">-- No Doctor --</option>
                                    <?php foreach ($doctors as $doc): ?>
                                    <option value="<?= e((string) $doc['id']) ?>"><?= e($doc['full_name']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted mb-1">Collection Type</label>
                                <select class="form-select rounded-3 py-2" name="sample_collection" id="serviceType"
                                    required>
                                    <option value="lab">Walk-in Visit (Lab)</option>
                                    <option value="home">Home Collection</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted mb-1">Priority</label>
                                <select name="priority" class="form-select rounded-3 py-2">
                                    <option value="normal">Normal</option>
                                    <option value="urgent">Urgent</option>
                                </select>
                            </div>
                        </div>

                        <div id="homeFields" class="p-3 bg-light rounded-3 mb-4 border border-info border-opacity-25"
                            style="display:none;">
                            <label class="small text-muted mb-1">Home Address</label>
                            <textarea name="address" class="form-control bg-white" rows="2"
                                placeholder="Street / House Number / Landmarks"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="small text-muted mb-2 d-block">Select Lab Tests</label>
                            <div class="row g-2">
                                <?php foreach ($tests as $test): ?>

                                <div class="col-md-6">

                                    <div class="form-check border rounded p-2">

                                        <input class="form-check-input" type="checkbox" name="test_ids[]"
                                            value="<?= e((string)$test['id']) ?>" id="test<?= e((string)$test['id']) ?>"
                                            <?phpif($oldAppointment && in_array($test['id'],$oldTests)){ echo "checked";}?>>
                                        <label class="form-check-label" for="test<?= e((string)$test['id']) ?>">

                                            <?= e($test['test_name']) ?>

                                            <small class="text-muted">
                                                (<?= number_format((float)$test['price'],0) ?> TZS)
                                            </small>

                                        </label>


                                    </div>

                                </div>

                                <?php endforeach; ?>

                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="small text-muted mb-1">Notes (Optional)</label>
                            <textarea name="notes" class="form-control rounded-3" rows="2"
                                placeholder="Any special instructions..."></textarea>
                        </div>

                        <button type="submit"
                            class="btn btn-info welcome-card w-100 py-3 text-white fw-bold rounded-3 shadow-sm mt-3">
                            <i class="bi bi-check2-circle me-2"></i>Confirm Appointment
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.getElementById('serviceType').addEventListener('change', function() {
    document.getElementById('homeFields').style.display = (this.value === 'home') ? 'block' : 'none';
});
</script>