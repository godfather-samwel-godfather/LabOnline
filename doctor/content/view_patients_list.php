</head>

<body>

    <div class="container-fluid p-4">

        <!-- =========================
   HEADER
========================= -->

        <div class="page-header p-4 shadow mb-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>

                    <h2 class="fw-bold mb-1">
                        Patients Queue
                    </h2>

                    <p class="mb-0 opacity-75">
                        Manage all patients, filter by time and status.
                    </p>

                </div>

            </div>

        </div>

        <!-- =========================
   FILTER SECTION
========================= -->

        <div class="card p-3 shadow-sm mb-4">

            <div class="d-flex flex-wrap gap-2 align-items-center">

                <!-- FILTER BUTTONS -->

                <button class="filter-btn active">
                    All
                </button>

                <button class="filter-btn">
                    Today
                </button>

                <button class="filter-btn">
                    This Week
                </button>

                <button class="filter-btn">
                    This Month
                </button>

                <!-- SEARCH -->

                <div class="ms-auto d-flex gap-2">

                    <input type="text" class="form-control search-box" placeholder="Search patient...">

                    <button class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-search"></i>
                    </button>

                </div>

            </div>

        </div>

        <!-- =========================
   PATIENT TABLE
========================= -->

        <div class="card shadow-lg p-3">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>
                            <th>Patient</th>
                            <th>Visit Date</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <!-- ROW 1 -->

                        <tr>

                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div class="avatar">S</div>

                                    <div>
                                        <div class="fw-bold">Samwel Mganga</div>
                                        <small class="text-muted">PT-1024</small>
                                    </div>

                                </div>

                            </td>

                            <td>
                                Today <br>
                                <small class="text-muted">10:00 AM</small>
                            </td>

                            <td>General Medicine</td>

                            <td>
                                <span class="badge bg-warning text-dark">
                                    Pending
                                </span>
                            </td>

                            <td class="text-center">

                                <a href="view_patient_details.php?id=1" class="btn btn-primary btn-sm rounded-pill">
                                    <i class="bi bi-eye"></i> View
                                </a>

                            </td>

                        </tr>

                        <!-- ROW 2 -->

                        <tr>

                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div class="avatar bg-success">N</div>

                                    <div>
                                        <div class="fw-bold">Neema Joseph</div>
                                        <small class="text-muted">PT-2010</small>
                                    </div>

                                </div>

                            </td>

                            <td>
                                This Week <br>
                                <small class="text-muted">02:30 PM</small>
                            </td>

                            <td>Radiology</td>

                            <td>
                                <span class="badge bg-success">
                                    Approved
                                </span>
                            </td>

                            <td class="text-center">

                                <a href="view_patient_details.php?id=2"
                                    class="btn btn-outline-primary btn-sm rounded-pill">
                                    <i class="bi bi-eye"></i> View
                                </a>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>