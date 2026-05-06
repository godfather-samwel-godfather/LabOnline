<h4 class="mb-4">Laboratory Dashboard</h4>

<div class="row g-3">

    <div class="col-md-3">
        <div class="card shadow-sm p-3 border-0 bg-warning text-white">
            <h6>Pending Tests</h6>
            <h3>12</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm p-3 border-0 bg-success text-white">
            <h6>Completed</h6>
            <h3>30</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm p-3 border-0 bg-danger text-white">
            <h6>Rejected Samples</h6>
            <h3>4</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm p-3 border-0 bg-primary text-white">
            <h6>Total Requests</h6>
            <h3>46</h3>
        </div>
    </div>

</div>

<!-- TABLE -->
<div class="card mt-4 p-3 shadow-sm">
    <h5>Recent Test Requests</h5>

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Patient</th>
                <th>Test</th>
                <th>Priority</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>John Doe</td>
                <td>Blood Test</td>
                <td><span class="badge bg-danger">Urgent</span></td>
                <td><span class="badge bg-warning">Pending</span></td>
            </tr>

            <tr>
                <td>Asha Mohamed</td>
                <td>Malaria Test</td>
                <td><span class="badge bg-success">Normal</span></td>
                <td><span class="badge bg-success">Completed</span></td>
            </tr>

            <tr>
                <td>Ali Hassan</td>
                <td>Urine Test</td>
                <td><span class="badge bg-danger">Urgent</span></td>
                <td><span class="badge bg-warning">Pending</span></td>
            </tr>
        </tbody>
    </table>
</div>