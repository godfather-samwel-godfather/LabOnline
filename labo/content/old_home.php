<h4 class="mb-4">Laboratory Dashboard</h4>
<?php
$labRepo = new LaboratoryRepository($conn);
$appointmentRepo = new AppointmentRepository($conn);
$labId = $labRepo->getIdByUserId(getCurrentUserId());

$pendingCount = $labId ? $appointmentRepo->countByLaboratoryAndStatus($labId, 'pending') : 0;
$completedCount = $labId ? $appointmentRepo->countByLaboratoryAndStatus($labId, 'completed') : 0;
$approvedCount = $labId ? $appointmentRepo->countByLaboratoryAndStatus($labId, 'approved') : 0;
$totalRequests = $pendingCount + $approvedCount + $completedCount;
$requests = $labId ? $appointmentRepo->getByLaboratoryId($labId, ['pending', 'approved']) : [];
?>

<?php flashMessage(); ?>

<!-- TOP CARDS -->
<div class="row g-3">

    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card shadow-sm p-3 border-0 bg-warning text-white">
            <h6>Pending Tests</h6>
            <h3><?= $pendingCount ?></h3>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card shadow-sm p-3 border-0 bg-success text-white">
            <h6>Completed</h6>
            <h3><?= $completedCount ?></h3>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card shadow-sm p-3 border-0 bg-primary text-white">
            <h6>Approved</h6>
            <h3><?= $approvedCount ?></h3>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card shadow-sm p-3 border-0 bg-dark text-white">
            <h6>Total Requests</h6>
            <h3><?= $totalRequests ?></h3>
        </div>
    </div>

</div>

<!-- MAIN DASHBOARD LAYOUT -->
<div class="row g-3 mt-1">

    <!-- LEFT SIDE (MAIN CONTENT) -->
    <div class="col-lg-8">

        <!-- RECENT TEST REQUESTS -->
        <div class="card p-3 shadow-sm">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h5>Recent Test Requests</h5>

                <input type="text" class="form-control w-auto" placeholder="Search patient...">
            </div>

            <div class="table-responsive">

                <table class="table table-striped mt-3">

                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Test</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (empty($requests)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No recent requests.</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach (array_slice($requests, 0, 5) as $row): ?>
                        <tr>
                            <td><?= e($row['patient_name']) ?></td>
                            <td>Lab Test</td>
                            <td>
                                <span class="badge <?= $row['priority'] === 'urgent' ? 'bg-danger' : 'bg-success' ?>">
                                    <?= e(ucfirst($row['priority'])) ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge <?= statusBadge($row['status']) ?>">
                                    <?= e(ucfirst($row['status'])) ?>
                                </span>
                            </td>
                            <td><?= e(formatDate($row['appointment_date'])) ?></td>
                            <td>
                                <a href="?page=test_requests" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

        <!-- SAMPLE PROGRESS -->
        <div class="card mt-3 p-3 shadow-sm">

            <h5>Sample Processing</h5>

            <div class="mt-3">

                <label>Blood Tests</label>
                <div class="progress mb-3">
                    <div class="progress-bar bg-success" style="width:80%">80%</div>
                </div>

                <label>Urine Tests</label>
                <div class="progress">
                    <div class="progress-bar bg-warning" style="width:45%">45%</div>
                </div>

            </div>

        </div>

    </div>

    <!-- RIGHT SIDE (SIDEBAR WIDGETS) -->
    <div class="col-lg-4">

        <!-- RECENT ACTIVITY -->
        <div class="card p-3 shadow-sm">

            <h5>Recent Activity</h5>

            <ul class="list-group list-group-flush mt-2">

                <li class="list-group-item">Blood Test completed for John Doe</li>
                <li class="list-group-item">New Urgent Sample received</li>
                <li class="list-group-item">Report uploaded successfully</li>
                <li class="list-group-item">Malaria Test approved</li>

            </ul>

        </div>

        <!-- TODAY SCHEDULE -->
        <div class="card mt-3 p-3 shadow-sm">

            <h5>Today's Schedule</h5>

            <div class="table-responsive">

                <table class="table mt-3">

                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Patient</th>
                            <th>Test</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>09:00 AM</td>
                            <td>John Doe</td>
                            <td>Blood Test</td>
                        </tr>

                        <tr>
                            <td>11:00 AM</td>
                            <td>Asha Mohamed</td>
                            <td>Malaria Test</td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- QUICK ACTIONS -->
<div class="card mt-4 p-3 shadow-sm">

    <h5>Quick Actions</h5>

    <div class="d-flex flex-wrap gap-2 mt-3">

        <button class="btn btn-primary">+ Add Test Result</button>
        <button class="btn btn-success">Upload Report</button>
        <button class="btn btn-warning text-white">Pending Samples</button>
        <button class="btn btn-danger">Rejected Samples</button>

    </div>

</div>

<!-- ALERTS -->
<div class="alert alert-danger mt-4">
    2 urgent samples require immediate attention.
</div>

<div class="alert alert-success">
    All completed reports uploaded successfully.
</div>