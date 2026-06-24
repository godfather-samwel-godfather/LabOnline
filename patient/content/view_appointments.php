<?php
$appointmentRepo = new AppointmentRepository($conn);
$labTestRepo = new LabTestRepository($conn);
$paymentRepo = new PaymentRepository($conn);

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
            <h3>
                <i class="bi bi-calender-check me-2"></i>
                My Appointments
            </h3>
            <p class="text-muted text-white mb-0 ">
                Manage your laboratory appointments and
                track progress.

            </p>
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
                    <small class="text-muted">Waiting for payment/approval
                    </small>
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
                    <small class="text-muted">Laboratory accepted your appointment
                    </small>

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
                    <small class="text-muted">Appointments have been completed now you can view your results
                    </small>
                </div>
                <div class="icon-box bg-green">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Appointment Table -->
<div class="card table-card shadow-sm border-0 rounded-4 p-4">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

        <h5 class="mb-3 mb-md-0">
            Recent Appointments
        </h5>

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
                    <th>Payment</th>
                    <th>Action</th>
                </tr>

            </thead>


            <tbody>


                <?php if (empty($appointments)): ?>


                <tr>

                    <td colspan="8" class="text-center text-muted py-4">
                        <div class="py-5">

                            <i class="bi bi-calendar-x fs-1 text-muted"></i>

                            <h5 class="mt-3">
                                No appointments yet
                            </h5>

                            <p class="text-muted">
                                Book your first laboratory test.
                            </p>

                        </div>

                    </td>

                </tr>


                <?php else: ?>


                <?php foreach ($appointments as $i => $row): ?>


                <?php
                $payment = $paymentRepo->getByAppointmentId((int)$row['id']);

                $paymentPaid = $payment 
                    && $payment['payment_status'] === 'paid';
                ?>


                <tr>


                    <td>
                        <?= $i + 1 ?>
                    </td>


                    <td>

                        <?= e(formatDate($row['appointment_date'])) ?>

                        <br>

                        <small class="text-muted">

                            <?= e(formatTime($row['appointment_time'])) ?>

                        </small>

                    </td>


                    <td>
                        <?= e($row['doctor_name'] ?? 'Not assigned') ?>
                    </td>


                    <td>
                        <?= e($row['labo_name'] ?? '-') ?>
                    </td>


                    <td>

                        <span class="badge bg-light text-dark px-3 py-2">
                            <?= e($labTestRepo->getNamesByAppointmentId((int)$row['id'])) ?>
                        </span>

                    </td>


                    <!-- Appointment Status badge-->
                    <td>

                        <span class="badge <?= statusBadge($row['status']) ?>">
                            <i class="bi bi-circle-fill me-1 small"></i>
                            <?= e(ucfirst($row['status'])) ?>
                        </span>

                    </td>



                    <!-- Payment UI -->
                    <td>


                        <?php if($paymentPaid): ?>


                        <span class="badge bg-success px-3 py-2">
                            <i class="bi bi-check-circle me-1"></i>
                            </i>
                            ✓ Payment Paid
                        </span>


                        <?php else: ?>


                        <span class="badge bg-warning text-dark px-3 py-2">
                            <i class="bi bi-clock me-1"></i>
                            </i>


                            Payment Pending

                        </span>


                        <?php endif; ?>


                    </td>




                    <!-- Action -->

                    <td>


                        <?php if($row['status'] === 'pending' && !$paymentPaid): ?>


                        <a href="../actions/patient/process_payment.php?id=<?= $row['id'] ?>"
                            class="btn btn-success btn-sm">

                            <i class="bi bi-credit-card"></i>
                            Pay Now

                        </a>



                        <?php elseif($paymentPaid && $row['status'] === 'pending'): ?>


                        <span class="text-primary small">
                            <i class="bi bi-hourglass-split"></i>

                            Waiting for Laboratory Approval

                        </span>



                        <?php else: ?>


                        <span class="text-muted">
                            -
                        </span>


                        <?php endif; ?>


                    </td>



                </tr>


                <?php endforeach; ?>


                <?php endif; ?>


            </tbody>


        </table>


    </div>


</div>