<?php

$labRepo = new LaboratoryRepository($conn);
$appointmentRepo = new AppointmentRepository($conn);


$labId = $labRepo->getIdByUserId(getCurrentUserId());


$requests = $labId
    ? $appointmentRepo->getByLaboratoryId(
        $labId,
        ['pending','paid','approved']
      )
    : [];

?>

<h4 class="mb-3">
    <i class="bi bi-clipboard2-pulse me-2"></i>
    Test Requests
</h4>


<?php flashMessage(); ?>


<?php if (!$labId): ?>


<div class="alert alert-warning">
    No laboratory profile linked to your account.
</div>


<?php else: ?>



<div class="card p-4 shadow-sm border-0 rounded-4">


    <div class="table-responsive">


        <table class="table table-striped mt-2 align-middle">


            <thead>

                <tr>

                    <th>Patient</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Action</th>

                </tr>

            </thead>



            <tbody>



                <?php if(empty($requests)): ?>


                <tr>

                    <td colspan="7" class="text-center text-muted py-5">

                        <i class="bi bi-inbox fs-1"></i>

                        <h5 class="mt-3">
                            No test requests yet
                        </h5>

                        <p>
                            New laboratory requests will appear here.
                        </p>

                    </td>

                </tr>



                <?php else: ?>



                <?php foreach($requests as $row): ?>


                <tr>


                    <td>
                        <?= e($row['patient_name']) ?>
                    </td>



                    <td>
                        <?= e(formatDate($row['appointment_date'])) ?>
                    </td>



                    <td>
                        <?= e(formatTime($row['appointment_time'])) ?>
                    </td>




                    <td>

                        <span class="badge <?= $row['priority']==='urgent'
? 'bg-danger'
: 'bg-success' ?> px-3 py-2">

                            <?= e(ucfirst($row['priority'])) ?>

                        </span>

                    </td>




                    <td>

                        <span class="badge <?= statusBadge($row['status']) ?> px-3 py-2">

                            <?= e(ucfirst($row['status'])) ?>

                        </span>

                    </td>




                    <td>


                        <?php if(($row['payment_status'] ?? '') === 'paid'): ?>


                        <span class="badge bg-success">

                            <i class="bi bi-check-circle"></i>
                            Paid

                        </span>


                        <?php else: ?>


                        <span class="badge bg-warning text-dark">

                            Pending

                        </span>


                        <?php endif; ?>


                    </td>





                    <td>


                        <?php if(
$row['status']==='pending'
||
$row['status']==='paid'
): ?>


                        <div class="d-flex gap-2">



                            <form method="POST" action="../actions/labo/approve_appointment.php">


                                <input type="hidden" name="appointment_id" value="<?= e((string)$row['id']) ?>">



                                <button class="btn btn-sm btn-primary">

                                    <i class="bi bi-check-circle me-1"></i>

                                    Approve

                                </button>


                            </form>






                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#rejectModal<?= $row['id'] ?>">


                                <i class="bi bi-x-circle me-1"></i>

                                Reject


                            </button>




                        </div>





                        <?php elseif($row['status']==='approved'): ?>


                        <span class="text-success small">

                            <i class="bi bi-upload me-1"></i>

                            Ready for upload

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






<!-- MODALS OUTSIDE TABLE -->

<?php foreach($requests as $row): ?>


<div class="modal fade" id="rejectModal<?= $row['id'] ?>" tabindex="-1">


    <div class="modal-dialog">


        <div class="modal-content">


            <form method="POST" action="../actions/labo/reject_appointment.php">



                <div class="modal-header">


                    <h5 class="modal-title">

                        Reject Appointment

                    </h5>



                    <button type="button" class="btn-close" data-bs-dismiss="modal">

                    </button>


                </div>




                <div class="modal-body">


                    <input type="hidden" name="appointment_id" value="<?= e((string)$row['id']) ?>">



                    <label class="form-label">

                        Reason for rejection

                    </label>



                    <textarea name="reason" class="form-control" rows="4" placeholder="Write rejection reason..."
                        required></textarea>



                </div>





                <div class="modal-footer">


                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                        Cancel

                    </button>



                    <button type="submit" class="btn btn-danger">


                        <i class="bi bi-x-circle me-1"></i>

                        Submit Reject


                    </button>


                </div>



            </form>


        </div>


    </div>


</div>



<?php endforeach; ?>



<?php endif; ?>