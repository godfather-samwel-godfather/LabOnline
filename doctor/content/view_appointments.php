<!-- =====================================
   HEADER
===================================== -->

<div class="page-header shadow-lg p-4 bg-primary text-white mb-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>

            <h2 class="fw-bold mb-2">
                Doctor Appointments
            </h2>

            <p class="mb-0 opacity-75">
                Manage patient bookings, approvals and schedules.
            </p>

        </div>

        <button class="btn btn-light rounded-pill px-4">

            <i class="bi bi-calendar-plus me-2"></i>
            Add Time Slots

        </button>

    </div>

</div>

<!-- =====================================
   STATISTICS CARDS
===================================== -->

<div class="row g-4 mb-4">

    <!-- CARD 1 -->

    <div class="col-xl-3 col-md-6">

        <div class="card stats-card shadow-sm p-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <small class="text-muted text-uppercase fw-bold">
                        Today's Appointments
                    </small>

                    <h2 class="fw-bold mt-2 mb-0">
                        12
                    </h2>

                </div>

                <div class="icon-box bg-primary-subtle text-primary rounded-4 d-flex align-items-center justify-content-center"
                    style="width:70px;height:70px;">

                    <i class="bi bi-calendar-check fs-1"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- CARD 2 -->

    <div class="col-xl-3 col-md-6">

        <div class="card stats-card shadow-sm p-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <small class="text-muted text-uppercase fw-bold">
                        Pending Requests
                    </small>

                    <h2 class="fw-bold mt-2 mb-0">
                        5
                    </h2>

                </div>

                <div class="icon-box bg-warning-subtle text-warning rounded-4 d-flex align-items-center justify-content-center"
                    style="width:70px;height:70px;">

                    <i class="bi bi-hourglass-split fs-1"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- CARD 3 -->

    <div class="col-xl-3 col-md-6">

        <div class="card stats-card shadow-sm p-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <small class="text-muted text-uppercase fw-bold">
                        Approved
                    </small>

                    <h2 class="fw-bold mt-2 mb-0">
                        24
                    </h2>

                </div>

                <div class="icon-box bg-success-subtle text-success rounded-4 d-flex align-items-center justify-content-center"
                    style="width:70px;height:70px;">

                    <i class="bi bi-check-circle fs-1"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- CARD 4 -->

    <div class="col-xl-3 col-md-6">

        <div class="card stats-card shadow-sm p-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <small class="text-muted text-uppercase fw-bold">
                        Completed
                    </small>

                    <h2 class="fw-bold mt-2 mb-0">
                        40
                    </h2>

                </div>

                <div class="icon-box bg-info-subtle text-info rounded-4 d-flex align-items-center justify-content-center"
                    style="width:70px;height:70px;">

                    <i class="bi bi-clipboard2-pulse fs-1"></i>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- =====================================
   SEARCH + FILTER (UI ONLY)
===================================== -->

<div class="card shadow-sm border-0 p-3 mb-4">

    <div class="d-flex flex-wrap gap-2">

        <!-- SEARCH -->

        <div class="input-group">

            <span class="input-group-text bg-light border-0">
                <i class="bi bi-search"></i>
            </span>

            <input type="text" class="form-control border-0 bg-light shadow-none search-box"
                placeholder="Search patient...">

        </div>

        <!-- STATUS -->

        <select class="form-select bg-light border-0 shadow-none">

            <option>All Status</option>
            <option>Pending</option>
            <option>Approved</option>
            <option>Rejected</option>
            <option>Completed</option>

        </select>

        <button class="btn btn-primary rounded-pill px-4">

            <i class="bi bi-funnel me-1"></i>
            Filter

        </button>

    </div>

</div>

<!-- =====================================
   TABLE (STATIC UI ONLY)
===================================== -->

<div class="card shadow-lg border-0 rounded-4">

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">

                <tr>
                    <th>Patient</th>
                    <th>Date & Time</th>
                    <th>Service</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>

            </thead>

            <tbody>

                <!-- ROW 1 -->

                <tr>

                    <td>
                        <div class="fw-bold">Samwel Mganga</div>
                        <small class="text-muted">PT-1024</small>
                    </td>

                    <td>
                        20 May 2026 <br>
                        <small class="text-muted">10:00 AM</small>
                    </td>

                    <td>
                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                            Malaria Check
                        </span>
                    </td>

                    <td>
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                            Pending
                        </span>
                    </td>

                    <td class="text-center">

                        <button class="btn btn-success btn-sm rounded-pill">
                            <i class="bi bi-check-lg"></i>
                        </button>

                        <button class="btn btn-danger btn-sm rounded-pill">
                            <i class="bi bi-x-lg"></i>
                        </button>

                        <button class="btn btn-primary btn-sm rounded-pill">
                            <i class="bi bi-eye"></i>
                        </button>

                    </td>

                </tr>

                <!-- ROW 2 -->

                <tr>
                    <td>
                        <div class="fw-bold">Neema Boaz</div>
                        <small class="text-muted">PT-1024</small>
                    </td>

                    <td>
                        21 May 2026 <br>
                        <small class="text-muted">10:00 AM</small>
                    </td>

                    <td>
                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                            Typhoid Check
                        </span>
                    </td>

                    <td>
                        <span class="badge bg-success text-dark px-3 py-2 rounded-pill">
                            Approved
                        </span>
                    </td>

                    <td class="text-center">

                        <button class="btn btn-success btn-sm rounded-pill">
                            <i class="bi bi-check-lg"></i>
                        </button>

                        <button class="btn btn-danger btn-sm rounded-pill">
                            <i class="bi bi-x-lg"></i>
                        </button>

                        <button class="btn btn-primary btn-sm rounded-pill">
                            <i class="bi bi-eye"></i>
                        </button>

                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

</div>