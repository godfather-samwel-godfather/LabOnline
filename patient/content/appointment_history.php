<?php

$appointmentRepo = new AppointmentRepository($conn);
$labTestRepo = new LabTestRepository($conn);

$patientId = getCurrentUserId();


// Get appointment history
$appointments = $appointmentRepo->getByPatientId($patientId);


// Statistics
$pendingCount = $appointmentRepo->countByPatientAndStatus($patientId, 'pending');

$approvedCount = $appointmentRepo->countByPatientAndStatus($patientId, 'approved');

$completedCount = $appointmentRepo->countByPatientAndStatus($patientId, 'completed');

?>


<div class="container mt-4">


    <!-- HEADER -->
    <div class="card shadow-sm border-0 mb-3">


        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">


            <h5 class="mb-0">

                <i class="bi bi-clock-history"></i>

                Appointment History

            </h5>


            <div class="d-flex gap-2">


                <button class="btn btn-sm btn-success" onclick="exportPDF(this)">

                    <i class="bi bi-file-earmark-pdf"></i>

                    Export PDF

                </button>


                <button class="btn btn-sm btn-primary" onclick="printPage()">

                    <i class="bi bi-printer"></i>

                    Print

                </button>


            </div>


        </div>




        <div class="card-body">



            <!-- STATISTICS -->

            <div class="row g-4 mb-4">


                <div class="col-md-4">

                    <div class="card shadow-sm p-3">


                        <h6 class="text-muted">
                            Pending
                        </h6>


                        <h2>
                            <?= $pendingCount ?>
                        </h2>


                    </div>


                </div>



                <div class="col-md-4">


                    <div class="card shadow-sm p-3">


                        <h6 class="text-muted">
                            Approved
                        </h6>


                        <h2>
                            <?= $approvedCount ?>
                        </h2>


                    </div>


                </div>



                <div class="col-md-4">


                    <div class="card shadow-sm p-3">


                        <h6 class="text-muted">
                            Completed
                        </h6>


                        <h2>
                            <?= $completedCount ?>
                        </h2>


                    </div>


                </div>


            </div>






            <!-- FILTERS -->

            <div class="row g-2 mb-3">


                <div class="col-md-5">


                    <input type="text" id="searchInput" class="form-control"
                        placeholder="Search doctor or laboratory...">


                </div>



                <div class="col-md-3">


                    <input type="date" id="dateFrom" class="form-control">


                </div>




                <div class="col-md-3">


                    <input type="date" id="dateTo" class="form-control">


                </div>




                <div class="col-md-1">


                    <button class="btn btn-secondary w-100" onclick="resetFilters()">


                        <i class="bi bi-arrow-clockwise"></i>


                    </button>


                </div>



            </div>





            <!-- TABLE -->


            <div id="printArea" class="table-responsive">


                <table class="table table-hover align-middle">



                    <thead class="table-light">


                        <tr>

                            <th>#</th>

                            <th>Date</th>

                            <th>Doctor</th>

                            <th>Laboratory</th>

                            <th>Tests</th>

                            <th>Status</th>



                        </tr>


                    </thead>





                    <tbody id="tableBody">



                        <?php if(empty($appointments)): ?>


                        <tr>


                            <td colspan="7" class="text-center text-muted py-4">


                                No appointment history found.


                            </td>


                        </tr>




                        <?php else: ?>




                        <?php foreach($appointments as $i => $row): ?>



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


                                <small>


                                    <?= e(

                                    $labTestRepo->getNamesByAppointmentId(

                                        (int)$row['id']

                                    )

                                ) ?>


                                </small>


                            </td>





                            <td>



                                <span class="badge <?= statusBadge($row['status']) ?>">


                                    <?= e(ucfirst($row['status'])) ?>


                                </span>



                            </td>




                        </tr>




                        <?php endforeach; ?>




                        <?php endif; ?>




                    </tbody>




                </table>




            </div>





            <nav class="mt-3">


                <ul class="pagination justify-content-end" id="pagination"></ul>


            </nav>





        </div>



    </div>



</div>