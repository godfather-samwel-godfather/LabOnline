<!-- Welcome Card -->
<div class="card welcome-card border-0 shadow mb-4 text-white" style="">

    <div class="card-body p-5">

        <div class="row align-items-center">

            <div class="col-md-8">

                <span class="badge bg-light text-primary mb-3 px-3 py-2">
                    <i class="bi bi-flask"></i>
                    Laboratory Dashboard
                </span>

                <h2 class="fw-bold mb-3">
                    Welcome Back 👋
                </h2>

                <p class="mb-4 fs-5">
                    Manage laboratory requests, approve appointments, upload
                    patient test results and monitor daily laboratory activities.
                </p>

                <div class="d-flex flex-wrap gap-2">

                    <a href="?page=test_requests" class="btn btn-light rounded-pill px-4">

                        <i class="bi bi-clipboard-check"></i>
                        View Requests

                    </a>

                    <a href="?page=upload_results" class="btn btn-outline-light rounded-pill px-4">

                        <i class="bi bi-cloud-upload"></i>
                        Upload Results

                    </a>

                </div>

            </div>

            <div class="col-md-4 text-center d-none d-md-block">

                <i class="bi bi-hospital display-1 text-white opacity-75"></i>

            </div>

        </div>

    </div>

</div>


<?php

$labRepo = new LaboratoryRepository($conn);
$appointmentRepo = new AppointmentRepository($conn);


$labId = $labRepo->getIdByUserId(getCurrentUserId());



// Activities

$activityRepo = new ActivityLogRepository($conn);

$activities = $labId
? $activityRepo->getByLaboratoryId($labId)
: [];




// Counts

$pending =
$labId ?
$appointmentRepo->countByLaboratoryAndStatus($labId,'pending')
:0;


$approved =
$labId ?
$appointmentRepo->countByLaboratoryAndStatus($labId,'approved')
:0;


$completed =
$labId ?
$appointmentRepo->countByLaboratoryAndStatus($labId,'completed')
:0;


$rejected =
$labId ?
$appointmentRepo->countByLaboratoryAndStatus($labId,'rejected')
:0;



$total =
$pending+$approved+$completed+$rejected;



// Requests

$requests =$labId ?$appointmentRepo->getByLaboratoryId($labId,['pending','approved','completed','rejected']):[];



?>


<?php flashMessage(); ?>




<!-- CARDS -->

<div class="row g-3 mb-4">


    <?php

$cards=[

['Pending',$pending,'warning','bi-hourglass-split'],

['Approved',$approved,'primary','bi-check-circle'],

['Rejected',$rejected,'danger','bi-x-circle'],

['Completed',$completed,'success','bi-check-all'],

['Total',$total,'info','bi-clipboard-data']

];


foreach($cards as $c):

?>
    <div class="col-md-6 col-xl">


        <div class="card shadow-sm border-0">


            <div class="card-body">


                <div class="d-flex justify-content-between">


                    <div>

                        <small class="text-muted">
                            <?= $c[0] ?>
                        </small>


                        <h2 class="fw-bold">
                            <?= $c[1] ?>
                        </h2>


                    </div>


                    <div class="bg-<?= $c[2] ?> bg-opacity-10 rounded-circle p-3">


                        <i class="bi <?= $c[3] ?> fs-3 text-<?= $c[2] ?>"></i>


                    </div>


                </div>


            </div>


        </div>


    </div>


    <?php endforeach; ?>


</div>



<div class="row g-3">


    <!-- REQUESTS -->
    <div class="col-lg-8">

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5>
                    Recent Test Requests
                </h5>

                <div class="table-responsive mt-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Test</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach(array_slice($requests,0,6) as $row): ?>

                            <tr>
                                <td>
                                    <?= e($row['patient_name']); ?>
                                </td>

                                <td>
                                    <?= e($row['test_name'] ?? 'No test'); ?>
                                </td>

                                <td>
                                    <span class="badge <?= statusBadge($row['status']); ?>">

                                        <?= ucfirst($row['status']); ?>

                                    </span>
                                </td>

                                <td>

                                    <?= formatDate($row['appointment_date']); ?>

                                </td>
                            </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>

            </div>

        </div>

    </div>

    <!-- RIGHT -->
    <div class="col-lg-4">

        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <h5>
                    Notifications
                </h5>

                <hr>
                <p>
                    🔔 New Requests:
                    <b><?= $pending ?></b>
                </p>
                <p>
                    ⚠ Rejected:
                    <b><?= $rejected ?></b>
                </p>
                <p>
                    📄 Results Ready:
                    <b><?= $completed ?></b>
                </p>

            </div>
        </div>



        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5>
                    Recent Activity
                </h5>

                <ul class="list-group list-group-flush">


                    <?php foreach(array_slice($activities,0,5) as $a): ?>


                    <li class="list-group-item">


                        <i class="bi bi-clock"></i>

                        <?= e($a['action']); ?>


                        <small class="d-block text-muted">
                            <?= e($a['created_at']); ?>
                        </small>

                    </li>


                    <?php endforeach; ?>

                </ul>

            </div>

        </div>

    </div>


</div>


<!-- TODAY SCHEDULE -->


<div class="card shadow-sm border-0 mt-4">

    <div class="card-body">
        <h5>
            Today's Schedule
        </h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <!--loop to display today's appointments-->
                <?php 
                $today=date('Y-m-d');
                foreach($requests as $r):
                if($r['appointment_date']==$today):
                ?> <tr>
                    <td>
                        <?= e($r['patient_name']); ?>
                    </td>
                    <td>
                        <?= e($r['appointment_time']); ?>
                    </td>

                    <td>
                        <?= ucfirst($r['status']); ?>
                    </td>
                </tr>

                <?php endif; ?>

                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</div>

<!-- DYNAMIC CHART -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <h5 class="mb-3">
            Appointment Statistics
        </h5>
        <canvas id="appointmentChart"></canvas>
    </div>
</div>


<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('appointmentChart');
new Chart(ctx, {
    type: 'bar',
    //type ofdata to display
    data: {
        labels: [
            'Pending',
            'Approved',
            'Completed',
            'Rejected'
        ],

        datasets: [{
            label: 'Appointments',
            data: [
                <?= $pending ?>,

                <?= $approved ?>,

                <?= $completed ?>,

                <?= $rejected ?>
            ]
        }]
    },


    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>