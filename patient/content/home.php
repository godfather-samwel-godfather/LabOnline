<?php

$appointmentRepo = new AppointmentRepository($conn);
$resultRepo = new TestResultRepository($conn);


$patientId = getCurrentUserId();


// Counts

$appointmentCount =
$appointmentRepo->countByPatientAndStatus(
    $patientId,
    'pending'
)
+
$appointmentRepo->countByPatientAndStatus(
    $patientId,
    'approved'
)
+
$appointmentRepo->countByPatientAndStatus(
    $patientId,
    'completed'
);



$resultCount =
count(
$resultRepo->getByPatientUserId($patientId)
);



$historyCount =
count(
$appointmentRepo->getByPatientId($patientId)
);




// Recent appointments

$recentAppointments =
$appointmentRepo->getByPatientId($patientId);


?>


<div class="container-fluid">


    <!-- Welcome Card -->
    <div class="card welcome-card text-white shadow border-0 mb-4">

        <div class="card-body p-5">

            <div class="row align-items-center">

                <div class="col-md-8">


                    <h2 class="fw-bold">
                        Welcome Back 👋
                    </h2>


                    <p class="mb-4">
                        Book laboratory tests, manage your appointments, make payments, and access your medical
                        results easily.
                    </p>


                    <a href="?page=create_appointment" class="btn btn-light rounded-4 px-4 py-2 fw-semibold">


                        <i class="bi bi-plus-circle"></i>
                        Create Appointment


                    </a>


                </div>


            </div>

        </div>

    </div>





    <!-- Statistics Cards -->

    <div class="row g-4">


        <!-- Appointments -->

        <div class="col-md-4">

            <div class="card glass-card shadow-sm h-100">

                <div class="card-body">


                    <div class="icon-box bg-primary mb-3">

                        <i class="bi bi-calendar-check"></i>

                    </div>


                    <h3 class="fw-bold">
                        <?= $appointmentCount ?? 0 ?>
                    </h3>


                    <p class="text-muted">
                        Total Appointments
                    </p>

                </div>

            </div>

        </div>





        <!-- Results -->

        <div class="col-md-4">

            <div class="card glass-card shadow-sm h-100">


                <div class="card-body">


                    <div class="icon-box bg-success mb-3">

                        <i class="bi bi-file-earmark-medical"></i>

                    </div>


                    <h3 class="fw-bold">

                        <?= $resultCount ?? 0 ?>

                    </h3>


                    <p class="text-muted">

                        Total Results

                    </p>

                </div>

            </div>

        </div>



        <!-- History -->

        <div class="col-md-4">

            <div class="card glass-card shadow-sm h-100">


                <div class="card-body">


                    <div class="icon-box bg-dark mb-3">

                        <i class="bi bi-clock-history"></i>

                    </div>


                    <h3 class="fw-bold">

                        <?= $historyCount ?? 0 ?>

                    </h3>


                    <p class="text-muted">

                        Appointments history

                    </p>
                </div>

            </div>
        </div>



        <!-- Quick Links -->

        <div class="d-flex justify-content-between align-items-center mt-4 mb-3">

            <h5 class="fw-bold mb-0">

                Quick Links

            </h5>


        </div>





        <div class="row g-4">



            <!-- Create -->

            <div class="col-md-3">


                <a href="?page=create_appointment"
                    class="card quick-link shadow-sm border-0 text-decoration-none text-dark">


                    <div class="card-body d-flex align-items-center gap-3">


                        <div class="icon-box bg-primary">

                            <i class="bi bi-plus-circle"></i>

                        </div>


                        <div>


                            <h6 class="fw-bold mb-1">

                                Create Appointment

                            </h6>


                            <small class="text-muted">

                                Book laboratory services

                            </small>


                        </div>


                    </div>


                </a>


            </div>







            <!-- History -->


            <div class="col-md-3">


                <a href="?page=appointment_history"
                    class="card quick-link shadow-sm border-0 text-decoration-none text-dark">


                    <div class="card-body d-flex align-items-center gap-3">


                        <div class="icon-box bg-dark">


                            <i class="bi bi-clock-history"></i>


                        </div>



                        <div>


                            <h6 class="fw-bold mb-1">

                                My Appointments

                            </h6>


                            <small class="text-muted">

                                View appointment history

                            </small>


                        </div>



                    </div>


                </a>


            </div>

            <!--view appointment-->
            <div class="col-md-3">


                <a href="?page=view_appointments"
                    class="card quick-link shadow-sm border-0 text-decoration-none text-dark">


                    <div class="card-body d-flex align-items-center gap-3">


                        <div class="icon-box bg-primary">


                            <i class="bi bi-eye"></i>


                        </div>



                        <div>


                            <h6 class="fw-bold mb-1">

                                view Appointments

                            </h6>


                            <small class="text-muted">

                                see appointment

                            </small>


                        </div>



                    </div>


                </a>


            </div>









            <!-- Results -->


            <div class="col-md-3">


                <a href="?page=view_test_results"
                    class="card quick-link shadow-sm border-0 text-decoration-none text-dark">


                    <div class="card-body d-flex align-items-center gap-3">


                        <div class="icon-box bg-success">


                            <i class="bi bi-file-earmark-medical"></i>


                        </div>



                        <div>


                            <h6 class="fw-bold mb-1">

                                View Results

                            </h6>


                            <small class="text-muted">

                                Download laboratory reports

                            </small>


                        </div>


                    </div>


                </a>


            </div>


        </div>






        <!-- Recent Appointments -->


        <div class="card glass-card shadow-sm mt-4 border-0">


            <div class="card-body">


                <div class="d-flex justify-content-between align-items-center mb-4">


                    <h5 class="fw-bold">

                        Recent Appointments

                    </h5>


                    <a href="?page=view_appointments" class="btn btn-primary rounded-4">


                        View All


                    </a>


                </div>


                <div class="table-responsive">


                    <table class="table align-middle">


                        <thead class="table-light">

                            <tr>

                                <th>Date</th>

                                <th>Laboratory</th>

                                <th>Time</th>

                                <th>Payment</th>

                                <th>Status</th>

                            </tr>

                        </thead>



                        <tbody>


                            <?php if(empty($recentAppointments)): ?>


                            <tr>

                                <td colspan="5" class="text-center text-muted py-4">


                                    <i class="bi bi-calendar-x fs-3 d-block mb-2"></i>


                                    No appointments found


                                </td>


                            </tr>



                            <?php else: ?>



                            <?php foreach(array_slice($recentAppointments,0,5 )as $row): ?>


                            <tr>


                                <td>

                                    <?= formatDate($row['appointment_date']); ?>

                                </td>



                                <td>

                                    <?= e($row['labo_name'] ?? 'Laboratory'); ?>

                                </td>



                                <td>

                                    <?= e($row['appointment_time']); ?>

                                </td>



                                <td>


                                    <?php if(($row['payment_status'] ?? '') == 'paid'): ?>


                                    <span class="badge bg-success rounded-pill px-3 py-2">

                                        Paid

                                    </span>



                                    <?php else: ?>


                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2">

                                        Pending

                                    </span>


                                    <?php endif; ?>


                                </td>




                                <td>


                                    <?php
                                $status = $row['status'];
                                $badge = match($status){
                                    'completed' => 'success',
                                    'approved' => 'primary',
                                    'pending' => 'warning',
                                    'rejected' => 'danger',
                                    default => 'secondary'};
                                    ?>


                                    <span class="badge bg-<?= $badge ?> rounded-pill px-3 py-2">


                                        <?= ucfirst($status); ?>


                                    </span>



                                </td>



                            </tr>



                            <?php endforeach; ?>



                            <?php endif; ?>


                        </tbody>


                    </table>


                </div>




            </div>


        </div>



    </div>