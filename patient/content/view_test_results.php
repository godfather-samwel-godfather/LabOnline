</head>

<body class="bg-light">

    <div class="container mt-4">

        <!-- CARD -->
        <div class="card shadow border-0">

            <!-- HEADER -->
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">My Test Results</h5>
            </div>

            <!-- BODY -->
            <div class="card-body">

                <!-- TABLE -->
                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Test</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>Blood Test</td>
                            <td>10 May 2026</td>
                            <td><span class="badge bg-success">Completed</span></td>

                            <td class="d-flex gap-1">

                                <!-- VIEW -->
                                <button class="btn btn-sm btn-info"
                                    onclick="openView('Blood Test','Normal Hemoglobin level detected','10 May 2026')">
                                    <i class="bi bi-eye"></i>
                                </button>

                                <!-- PDF -->
                                <button class="btn btn-sm btn-success"
                                    onclick="downloadPDF('Blood Test','Normal Hemoglobin level detected','10 May 2026')">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                </button>

                                <!-- WHATSAPP -->
                                <button class="btn btn-sm btn-primary"
                                    onclick="shareWhatsApp('Blood Test result is ready. Check your report.')">
                                    <i class="bi bi-whatsapp"></i>
                                </button>

                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>
        </div>

    </div>

    <!-- ================= VIEW MODAL ================= -->
    <div class="modal fade" id="viewModal" tabindex="-1">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <!-- HEADER -->
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">Test Report</h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <!-- BODY -->
                <div class="modal-body" id="reportArea">

                    <h5 id="testName"></h5>

                    <p><b>Date:</b> <span id="testDate"></span></p>

                    <p><b>Result:</b></p>

                    <div class="p-3 border rounded bg-light" id="testResult"></div>

                </div>

                <!-- FOOTER -->
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

    <!-- ================= LIBRARIES ================= -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <!-- ================= JS LOGIC ================= -->
    <script>
    // ===== VIEW FUNCTION =====
    function openView(name, result, date) {

        document.getElementById("testName").innerText = name;
        document.getElementById("testResult").innerText = result;
        document.getElementById("testDate").innerText = date;

        new bootstrap.Modal(document.getElementById("viewModal")).show();
    }

    // ===== PDF FROM MODAL =====
    function downloadPDFModal() {

        let element = document.getElementById("reportArea");

        html2pdf().set({
            margin: 0.5,
            filename: 'test-report.pdf',
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'a4',
                orientation: 'portrait'
            }
        }).from(element).save();

    }

    // ===== PDF DIRECT =====
    function downloadPDF(name, result, date) {

        let temp = document.createElement("div");

        temp.innerHTML = `
        <h2>${name}</h2>
        <p><b>Date:</b> ${date}</p>
        <p>${result}</p>
    `;

        html2pdf().from(temp).save("test-report.pdf");
    }

    // ===== WHATSAPP SHARE =====
    function shareWhatsApp(message) {

        let url = "https://wa.me/?text=" + encodeURIComponent(message);
        window.open(url, "_blank");

    }

    // ===== WHATSAPP FROM MODAL =====
    function shareWhatsAppFromModal() {

        let name = document.getElementById("testName").innerText;
        let result = document.getElementById("testResult").innerText;

        let msg = `${name} Result:\n${result}`;

        let url = "https://wa.me/?text=" + encodeURIComponent(msg);
        window.open(url, "_blank");

    }

    // ===== SMS HOOK (BACKEND LATER) =====
    function sendSMS() {

        console.log("SMS sent (backend required like Twilio / Africa's Talking)");

    }
    </script>