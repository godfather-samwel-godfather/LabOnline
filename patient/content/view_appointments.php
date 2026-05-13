<!-- Header -->
<div class="page-header shadow mb-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>
            <h3>My Appointments</h3>

            <p class="mb-0">
                Track all your appointments and their status.
            </p>
        </div>

        <!--<button class="btn btn-light px-4 py-2 mt-3 mt-md-0">
            <i class="bi bi-plus-circle"></i>
            New Appointment
            </button>-->
        <a href="?page=create_appointment"
            class="btn btn-light btn-lg px-4 py-2 shadow-sm fw-bold d-inline-flex align-items-center">
            <i class="bi bi-plus-circle-fill me-2" style="font-size: 1.2rem;"></i>
            New Appointment
        </a>

    </div>

</div>

<!-- Statistics -->
<div class="row g-4 mb-4">

    <!-- Pending -->
    <div class="col-md-4">

        <div class="card stats-card shadow-sm p-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h6 class="text-muted">Pending</h6>
                    <h2>4</h2>
                </div>

                <div class="icon-box bg-orange">
                    <i class="bi bi-hourglass-split"></i>
                </div>

            </div>

        </div>

    </div>

    <!-- Approved -->
    <div class="col-md-4">

        <div class="card stats-card shadow-sm p-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h6 class="text-muted">Approved</h6>
                    <h2>7</h2>
                </div>

                <div class="icon-box bg-blue">
                    <i class="bi bi-check2-circle"></i>
                </div>

            </div>

        </div>

    </div>

    <!-- Completed -->
    <div class="col-md-4">

        <div class="card stats-card shadow-sm p-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h6 class="text-muted">Completed</h6>
                    <h2>12</h2>
                </div>

                <div class="icon-box bg-green">
                    <i class="bi bi-check-circle-fill"></i>
                </div>

            </div>

        </div>

    </div>

</div>

<!-- Appointment Table -->
<div class="card table-card shadow-sm p-4">

    <!-- Top Bar -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

        <h5 class="mb-3 mb-md-0">
            Recent Appointments
        </h5>

        <div class="d-flex gap-2">

            <input type="text" class="form-control search-box" placeholder="Search appointment...">

            <button class="btn btn-primary">
                <i class="bi bi-search"></i>
            </button>

        </div>

    </div>

    <!-- Table -->
    <div class="table-responsive">

        <table class="table align-middle table-hover">

            <thead>

                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Doctor</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

            </thead>

            <tbody>

                <!-- Row -->
                <tr>

                    <td>1</td>

                    <td>
                        20 May 2026
                        <br>
                        <small class="text-muted">
                            10:00 AM
                        </small>
                    </td>

                    <td>Dr. Sarah</td>

                    <td>Pathology</td>

                    <td>
                        <span class="badge bg-warning text-dark">
                            Pending
                        </span>
                    </td>

                    <td>

                        <button class="btn btn-light action-btn">
                            <i class="bi bi-eye"></i>
                        </button>

                    </td>

                </tr>

                <!-- Row -->
                <tr>

                    <td>2</td>

                    <td>
                        21 May 2026
                        <br>
                        <small class="text-muted">
                            02:30 PM
                        </small>
                    </td>

                    <td>Dr. Alex</td>

                    <td>Radiology</td>

                    <td>
                        <span class="badge bg-primary">
                            Approved
                        </span>
                    </td>

                    <td>

                        <button class="btn btn-light action-btn">
                            <i class="bi bi-eye"></i>
                        </button>

                    </td>

                </tr>

                <!-- Row -->
                <tr>

                    <td>3</td>

                    <td>
                        18 May 2026
                        <br>
                        <small class="text-muted">
                            09:15 AM
                        </small>
                    </td>

                    <td>Dr. John</td>

                    <td>General Medicine</td>

                    <td>
                        <span class="badge bg-success">
                            Completed
                        </span>
                    </td>

                    <td>

                        <button class="btn btn-light action-btn">
                            <i class="bi bi-eye"></i>
                        </button>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>
<script>
document.getElementById('serviceType').addEventListener('change', function() {
    document.getElementById('homeFields').style.display = (this.value === 'home') ? 'block' : 'none';
});
</script>