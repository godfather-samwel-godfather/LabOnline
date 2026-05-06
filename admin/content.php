<h4 class="mb-4">Admin Dashboard</h4>

<!-- ================= STATS CARDS ================= -->
<div class="row g-3">

    <!-- USERS -->
    <div class="col-md-3">
        <div class="card p-3 shadow-sm text-white bg-primary">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>Total Users</h6>
                    <h3>120</h3>
                </div>
                <i class="bi bi-people fs-2"></i>
            </div>
        </div>
    </div>

    <!-- DOCTORS -->
    <div class="col-md-3">
        <div class="card p-3 shadow-sm text-white bg-success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>Doctors</h6>
                    <h3>25</h3>
                </div>
                <i class="bi bi-heart-pulse fs-2"></i>
            </div>
        </div>
    </div>

    <!-- PATIENTS -->
    <div class="col-md-3">
        <div class="card p-3 shadow-sm text-white bg-warning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>Patients</h6>
                    <h3>80</h3>
                </div>
                <i class="bi bi-person fs-2"></i>
            </div>
        </div>
    </div>

    <!-- LAB STAFF -->
    <div class="col-md-3">
        <div class="card p-3 shadow-sm text-white bg-dark">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>Lab Staff</h6>
                    <h3>15</h3>
                </div>
                <i class="bi bi-flask fs-2"></i>
            </div>
        </div>
    </div>

</div>

<!-- ================= QUICK ACTIONS ================= -->
<div class="card mt-4 p-3 shadow-sm">
    <h5>Quick Actions</h5>

    <div class="d-flex gap-3 flex-wrap mt-2">

        <button class="btn btn-primary">
            <i class="bi bi-person-plus"></i> Add Doctor
        </button>

        <button class="btn btn-success">
            <i class="bi bi-person-plus-fill"></i> Add Patient
        </button>

        <button class="btn btn-warning">
            <i class="bi bi-flask"></i> Assign Lab Test
        </button>

        <button class="btn btn-dark">
            <i class="bi bi-bar-chart"></i> View Reports
        </button>

    </div>
</div>

<!-- ================= RECENT ACTIVITY ================= -->
<div class="card mt-4 p-3 shadow-sm">
    <h5>Recent Activity</h5>

    <ul class="list-group list-group-flush mt-2">

        <li class="list-group-item">✔ New Doctor registered (Dr. John)</li>
        <li class="list-group-item">✔ Patient Asha booked appointment</li>
        <li class="list-group-item">✔ Lab results uploaded for Ali</li>
        <li class="list-group-item">✔ System backup completed</li>

    </ul>
</div>
<div class="card mt-4 p-3 shadow-sm">
    <h5>System Analytics</h5>
    <canvas id="adminChart"></canvas>
</div>

<script>
const ctx = document.getElementById('adminChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Doctors', 'Patients', 'Lab', 'Appointments', 'Users'],
        datasets: [{
            label: 'System Overview',
            data: [25, 80, 15, 40, 120],
            backgroundColor: [
                '#28a745',
                '#ffc107',
                '#343a40',
                '#0d6efd',
                '#6f42c1'
            ]
        }]
    }
});
</script>



<!--📁 Ongeza hii kwenye admin/content.php 🔗 Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js">
</script>