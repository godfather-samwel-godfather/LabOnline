<div class="container mt-4">

    <!-- HEADER -->
    <div class="card shadow-sm border-0 mb-3">

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

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

        <!-- FILTERS -->
        <div class="card-body">

            <div class="row g-2 mb-3">

                <!-- SEARCH -->
                <div class="col-md-5">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search patient name...">
                </div>

                <!-- DATE FROM -->
                <div class="col-md-3">
                    <input type="date" id="dateFrom" class="form-control">
                </div>

                <!-- DATE TO -->
                <div class="col-md-3">
                    <input type="date" id="dateTo" class="form-control">
                </div>

                <!-- RESET -->
                <div class="col-md-1">
                    <button class="btn btn-secondary w-100" onclick="resetFilters()">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                </div>

            </div>

            <!-- TABLE AREA -->
            <div id="printArea" class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Test</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="tableBody">

                        <tr>
                            <td>1</td>
                            <td>
                                <div class="fw-bold">John Deo</div>
                                <small class="text-muted">+255 712 000 111</small>
                            </td>
                            <td>Dr. Sarah</td>
                            <td>Blood Test</td>
                            <td>10 May 2026</td>
                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                            <td class="d-flex gap-1">
                                <button class="btn btn-sm btn-info"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>
                                <div class="fw-bold">Anna Smith</div>
                                <small class="text-muted">+255 784 222 333</small>
                            </td>
                            <td>Dr. John</td>
                            <td>Urine Test</td>
                            <td>12 May 2026</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td class="d-flex gap-1">
                                <button class="btn btn-sm btn-info"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>
                                <div class="fw-bold">Michael Lee</div>
                                <small class="text-muted">+255 700 123 456</small>
                            </td>
                            <td>Dr. Michael</td>
                            <td>DNA Test</td>
                            <td>15 May 2026</td>
                            <td><span class="badge bg-danger">Cancelled</span></td>
                            <td class="d-flex gap-1">
                                <button class="btn btn-sm btn-info"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

            <!-- PAGINATION -->
            <nav class="mt-3">
                <ul class="pagination justify-content-end" id="pagination"></ul>
            </nav>

        </div>

    </div>

</div>

<!-- PDF LIBRARY -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
// ================= PAGINATION =================
let rowsPerPage = 2;
let currentPage = 1;

let table = document.getElementById("tableBody");
let allRows = Array.from(table.getElementsByTagName("tr"));
let filteredRows = [...allRows];

let pagination = document.getElementById("pagination");

function displayRows() {

    let start = (currentPage - 1) * rowsPerPage;
    let end = start + rowsPerPage;

    allRows.forEach(row => row.style.display = "none");

    filteredRows.slice(start, end).forEach(row => {
        row.style.display = "";
    });

}

function setupPagination() {

    let pageCount = Math.ceil(filteredRows.length / rowsPerPage);
    pagination.innerHTML = "";

    pagination.innerHTML += `
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" onclick="prevPage()">Previous</a>
        </li>
    `;

    for (let i = 1; i <= pageCount; i++) {
        pagination.innerHTML += `
            <li class="page-item ${currentPage === i ? 'active' : ''}">
                <a class="page-link" onclick="goToPage(${i})">${i}</a>
            </li>
        `;
    }

    pagination.innerHTML += `
        <li class="page-item ${currentPage === pageCount ? 'disabled' : ''}">
            <a class="page-link" onclick="nextPage()">Next</a>
        </li>
    `;

}

function goToPage(page) {
    currentPage = page;
    displayRows();
    setupPagination();
}

function nextPage() {
    let pageCount = Math.ceil(filteredRows.length / rowsPerPage);
    if (currentPage < pageCount) {
        currentPage++;
        displayRows();
        setupPagination();
    }
}

function prevPage() {
    if (currentPage > 1) {
        currentPage--;
        displayRows();
        setupPagination();
    }
}

// ================= LIVE SEARCH + DATE FILTER =================
document.getElementById("searchInput").addEventListener("input", filterTable);
document.getElementById("dateFrom").addEventListener("change", filterTable);
document.getElementById("dateTo").addEventListener("change", filterTable);

function filterTable() {

    let search = document.getElementById("searchInput").value.toLowerCase();
    let from = document.getElementById("dateFrom").value;
    let to = document.getElementById("dateTo").value;

    filteredRows = allRows.filter(row => {

        let patient = row.cells[1].innerText.toLowerCase();
        let dateText = row.cells[4].innerText;

        let rowDate = new Date(dateText);
        let fromDate = from ? new Date(from) : null;
        let toDate = to ? new Date(to) : null;

        let matchSearch = patient.includes(search);

        let matchDate = true;

        if (fromDate && rowDate < fromDate) matchDate = false;
        if (toDate && rowDate > toDate) matchDate = false;

        return matchSearch && matchDate;

    });

    currentPage = 1;
    displayRows();
    setupPagination();

}

function resetFilters() {
    document.getElementById("searchInput").value = "";
    document.getElementById("dateFrom").value = "";
    document.getElementById("dateTo").value = "";
    filterTable();
}

// ================= PDF =================
function exportPDF(btn) {

    btn.innerHTML = "Exporting...";
    btn.disabled = true;

    let element = document.getElementById("printArea");

    html2pdf().set({
        margin: 0.5,
        filename: 'appointment-history.pdf',
        html2canvas: {
            scale: 2
        },
        jsPDF: {
            unit: 'in',
            format: 'a4',
            orientation: 'landscape'
        }
    }).from(element).save().then(() => {

        btn.innerHTML = `<i class="bi bi-file-earmark-pdf"></i> Export PDF`;
        btn.disabled = false;

    });

}

// ================= PRINT =================
function printPage() {

    let content = document.getElementById("printArea").innerHTML;
    let original = document.body.innerHTML;

    document.body.innerHTML = content;

    window.print();

    document.body.innerHTML = original;

    location.reload();

}

// INIT
displayRows();
setupPagination();
</script>