<?php
$resultRepo = new TestResultRepository($conn);
$labTestRepo = new LabTestRepository($conn);
$results = $resultRepo->getByPatientUserId(getCurrentUserId());
?>

<div class="container-fluid py-2">
    <?php flashMessage(); ?>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-file-earmark-medical"></i>
                My Test Results
            </h5>
        </div>
        <div class="card-body bg-primary text-dark rounded-top-4">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Appointment</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($results)): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <div class="py-5">

                                <i class="bi bi-file-earmark-x fs-1 text-muted"></i>

                                <h5 class="mt-3">
                                    No test results yet
                                </h5>

                                <p class="text-muted">
                                    Your laboratory results will appear here.
                                </p>

                            </div>
                        </td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($results as $i => $row): ?>
                    <?php
                        $testNames = $labTestRepo->getNamesByAppointmentId((int) $row['appointment_id']);
                        $remarks = $row['remarks'] ?: 'See attached report file.';
                        $dateLabel = formatDate($row['uploaded_at']);
                    ?>
                    <tr>
                        <td><?= $i + 1 ?></td>

                        <td>#<?= e((string) $row['appointment_id']) ?> — <?= e($testNames) ?></td>

                        <td><?= e($dateLabel) ?></td>

                        <td>
                            <span class="badge <?= statusBadge($row['status']) ?> text-dark px-3 py-2 ">
                                <i class="bi bi-circle-fill me-1 small"></i>
                                <?= e(ucfirst($row['status'])) ?>
                            </span>
                        </td>

                        <td class="d-flex gap-1 flex-wrap">
                            <button class="btn btn-sm btn-info" onclick='openView(
                                <?= json_encode($testNames) ?>,
                                <?= json_encode($remarks) ?>,
                                <?= json_encode($dateLabel) ?>
                                )'>
                                <i class="bi bi-eye"></i>
                                view
                            </button>

                            <?php if (!empty($row['result_file'])): ?>
                            <a href="../<?= e($row['result_file']) ?>" target="_blank" class="btn btn-sm btn-success">
                                <i class="bi bi-file-earmark-pdf"></i>
                                PDF
                            </a>

                            <?php endif; ?>
                            <button class="btn btn-sm btn-primary" onclick="shareWhatsApp('
                                <?= e($testNames.'result is ready.') ?> 
                                )">
                                <i class="bi bi-whatsapp"></i>
                                Share

                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- VIEW MODAL -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Test Report</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="reportArea">
                <h5 id="testName"></h5>
                <p><b>Date:</b> <span id="testDate"></span></p>
                <p><b>Result:</b></p>
                <div class="p-3 border rounded bg-light" id="testResult"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="downloadPDFModal()">
                    <i class="bi bi-download"></i> PDF
                </button>
                <button class="btn btn-primary" onclick="shareWhatsAppFromModal()">
                    <i class="bi bi-whatsapp"></i> Share
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function openView(name, result, date) {
    document.getElementById('testName').innerText = name;
    document.getElementById('testResult').innerText = result;
    document.getElementById('testDate').innerText = date;
    new bootstrap.Modal(document.getElementById('viewModal')).show();
}

function downloadPDFModal() {
    html2pdf().from(document.getElementById('reportArea')).save('test-report.pdf');
}

function shareWhatsApp(message) {
    window.open('https://wa.me/?text=' + encodeURIComponent(message), '_blank');
}

function shareWhatsAppFromModal() {
    const name = document.getElementById('testName').innerText;
    const result = document.getElementById('testResult').innerText;
    shareWhatsApp(name + ' Result:\n' + result);
}
</script>