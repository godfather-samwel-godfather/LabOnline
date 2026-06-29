<?php

$userRepo = new UserRepository($conn);
$appointmentRepo = new AppointmentRepository($conn);


// USERS
$totalUsers = $userRepo->countAll();
$totalPatients = $userRepo->countByRole('patient');
$totalLabo = $userRepo->countByRole('labo');

$activeUsers = $userRepo->countActive();
$blockedUsers = $userRepo->countBlocked();


// APPOINTMENTS
$totalAppointments = $appointmentRepo->countAll();

$pendingAppointments = $appointmentRepo->countByStatus('pending');
$approvedAppointments = $appointmentRepo->countByStatus('approved');
$completedAppointments = $appointmentRepo->countByStatus('completed');


// PAYMENTS
$paidPayments = $appointmentRepo->countPayments('paid');
$pendingPayments = $appointmentRepo->countPayments('pending');


// RECENT DATA
$recentAppointments = $appointmentRepo->getRecentAppointments(5);
$recentUsers = $userRepo->getRecentUsers(5);

?>

<?php flashMessage(); ?>


<!-- ================= WELCOME GLASS CARD ================= -->

<!-- ================= WELCOME CARD ================= -->
<div class="welcome-card shadow-lg rounded-4 mb-4  py-5">

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>

            <h2 class="fw-bold mb-2 text-white">

                <i class="bi bi-hospital me-2 "></i>

                Welcome Administrator

            </h2>


            <p class="mb-0 text-white text-muted">

                Monitor hospital users, laboratory services,
                appointments, payments and system activities.

            </p>


        </div>



        <div class="welcome-icon">

            <i class="bi bi-heart-pulse-fill"></i>

        </div>


    </div>

</div>





<!-- ================= KPI CARDS ================= -->


<div class="row g-4">



    <div class="col-md-3">

        <div class="card border-0 shadow rounded-4 p-3">

            <div class="d-flex justify-content-between">

                <div>

                    <h6 class="text-muted">
                        Users
                    </h6>

                    <h2 class="fw-bold">
                        <?= $totalUsers ?>
                    </h2>

                </div>


                <i class="bi bi-people fs-1 text-primary"></i>


            </div>

        </div>

    </div>





    <div class="col-md-3">

        <div class="card border-0 shadow rounded-4 p-3">


            <div class="d-flex justify-content-between">


                <div>

                    <h6 class="text-muted">
                        Patients
                    </h6>


                    <h2 class="fw-bold">
                        <?= $totalPatients ?>
                    </h2>


                </div>


                <i class="bi bi-person-heart fs-1 text-success"></i>


            </div>


        </div>

    </div>






    <div class="col-md-3">

        <div class="card border-0 shadow rounded-4 p-3">


            <div class="d-flex justify-content-between">


                <div>

                    <h6 class="text-muted">
                        Laboratories
                    </h6>


                    <h2 class="fw-bold">
                        <?= $totalLabo ?>
                    </h2>


                </div>


                <i class="bi bi-flask fs-1 text-danger"></i>


            </div>


        </div>

    </div>





    <div class="col-md-3">

        <div class="card border-0 shadow rounded-4 p-3">


            <div class="d-flex justify-content-between">


                <div>

                    <h6 class="text-muted">
                        Tota lAppointments
                    </h6>


                    <h2 class="fw-bold">
                        <?= $totalAppointments ?>
                    </h2>


                </div>


                <i class="bi bi-calendar-check fs-1 text-warning"></i>


            </div>


        </div>

    </div>


</div>






<!-- SECOND ROW -->


<div class="row g-4 mt-1">



    <div class="col-md-3">

        <div class="card border-0 shadow rounded-4 p-3 bg-light">

            <h6>
                Pending
            </h6>

            <h3>
                <?= $pendingAppointments ?>
            </h3>


        </div>

    </div>




    <div class="col-md-3">

        <div class="card border-0 shadow rounded-4 p-3 bg-light">

            <h6>
                Approved
            </h6>

            <h3>
                <?= $approvedAppointments ?>
            </h3>


        </div>

    </div>




    <div class="col-md-3">

        <div class="card border-0 shadow rounded-4 p-3 bg-light">

            <h6>
                Completed
            </h6>

            <h3>
                <?= $completedAppointments ?>
            </h3>


        </div>

    </div>




    <div class="col-md-3">

        <div class="card border-0 shadow rounded-4 p-3 bg-light">

            <h6>
                Payments Paid
            </h6>

            <h3>
                <?= $paidPayments ?>
            </h3>


        </div>

    </div>


</div>







<!-- QUICK ACTION -->

<div class="card border-0 shadow rounded-4 mt-4 p-4">


    <h5 class="fw-bold">

        <i class="bi bi-lightning-charge"></i>

        Quick Actions

    </h5>


    <div class="d-flex gap-3 flex-wrap mt-3">


        <a href="?page=users" class="btn btn-primary rounded-pill px-4">

            <i class="bi bi-people"></i>

            Manage Users

        </a>



        <a href="?page=lab_tests" class="btn btn-success rounded-pill px-4">

            <i class="bi bi-flask"></i>

            Manage Tests

        </a>



    </div>


</div>







<!-- LATEST APPOINTMENTS -->


<div class="card border-0 shadow rounded-4 mt-4 p-4">


    <h5 class="fw-bold">

        <i class="bi bi-calendar-event"></i>

        Latest Appointments

    </h5>



    <div class="table-responsive">


        <table class="table align-middle">


            <thead>

                <tr>

                    <th>Patient</th>
                    <th>Laboratory</th>
                    <th>Status</th>
                    <th>Payment</th>

                </tr>

            </thead>



            <tbody>


                <?php foreach($recentAppointments as $row): ?>


                <tr>


                    <td>

                        <?= e($row['patient_name']) ?>

                    </td>



                    <td>

                        <?= e($row['labo_name'] ?? '-') ?>

                    </td>



                    <td>

                        <span class="badge <?= statusBadge($row['status']) ?>">

                            <?= e($row['status']) ?>

                        </span>


                        <?php if($row['status']=='rejected'): ?>

                        <br>

                        <small class="text-danger">

                            <?= e($row['rejection_reason']) ?>

                        </small>

                        <?php endif; ?>


                    </td>



                    <td>

                        <?= e($row['payment_status'] ?? 'pending') ?>

                    </td>


                </tr>


                <?php endforeach; ?>


            </tbody>


        </table>


    </div>


</div>








<!-- RECENT USERS -->


<div class="card border-0 shadow rounded-4 mt-4 p-4">


    <h5 class="fw-bold">

        <i class="bi bi-person-plus"></i>

        Recently Registered Users

    </h5>



    <?php foreach($recentUsers as $user): ?>


    <div class="d-flex justify-content-between border-bottom py-2">


        <div>

            <strong>

                <?= e($user['full_name']) ?>

            </strong>


            <br>


            <small class="text-muted">

                <?= e($user['role']) ?>

            </small>


        </div>


        <span class="badge bg-success">

            <?= e($user['status']) ?>

        </span>


    </div>


    <?php endforeach; ?>


</div>







<!-- CHART -->

<div class="card border-0 shadow rounded-4 mt-4 p-4">


    <h5>

        System Analytics

    </h5>


    <canvas id="systemChart"></canvas>


</div>





<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
new Chart(document.getElementById('systemChart'), {

    type: 'bar',

    data: {

        labels: [
            'Users',
            'Patients',
            'Labs',
            'Appointments',
            'Paid'
        ],

        datasets: [{

            label: 'Hospital System',

            data: [

                <?= $totalUsers ?>,

                <?= $totalPatients ?>,

                <?= $totalLabo ?>,

                <?= $totalAppointments ?>,

                <?= $paidPayments ?>

            ]

        }]

    }


});
</script>