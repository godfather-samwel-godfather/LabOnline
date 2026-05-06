<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Our Services</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">


    <style>
    body {
        background: #f5f7fb;
    }

    /* HERO */
    .hero {
        background: linear-gradient(rgba(0, 0, 80, 0.7), rgba(0, 0, 80, 0.7)),
            url("images/labo.jpg");
        background-size: cover;
        background-position: center;
        color: white;
        padding: 80px 20px;
        text-align: center;
    }

    /* CARD */
    .service-card {
        background: #fff;
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
    }

    .service-card:hover {
        transform: translateY(-10px);
    }

    /* SEARCH */
    .search-box {
        max-width: 400px;
        margin: 0 auto;
        border-radius: 25px;
    }

    /* FILTER BUTTONS */
    .filter-btn {
        margin: 5px;
        border-radius: 20px;
    }

    /* ACTIVE BUTTON */
    .active-btn {
        background: #0d6efd !important;
        color: white !important;
    }

    /* SHOW */
    .show {
        opacity: 1;
        transform: scale(1);
        transition: all 0.4s ease;
        position: relative;
    }

    /* HIDE */
    .hide {
        opacity: 0;
        transform: scale(0.85);
        pointer-events: none;
        position: absolute;
    }
    </style>

</head>

<body>
    <?php include('shared/navbar.html'); ?>


    <!-- HERO -->
    <div class="hero">
        <h1>Our Services</h1>
        <p>Search and filter services easily</p>
    </div>

    <!-- SEARCH -->
    <div class="container my-4 text-center">

        <input type="text" id="searchInput" class="form-control search-box" placeholder="Search services..."
            onkeyup="searchService()">

    </div>

    <!-- FILTER BUTTONS -->
    <div class="container text-center">

        <button class="btn btn-primary filter-btn active-btn" onclick="filterService('all', this)">All</button>
        <button class="btn btn-outline-primary filter-btn" onclick="filterService('lab', this)">Lab</button>
        <button class="btn btn-outline-primary filter-btn" onclick="filterService('doctor', this)">Doctor</button>
        <button class="btn btn-outline-primary filter-btn" onclick="filterService('emergency', this)">Emergency</button>
        <button class="btn btn-outline-success filter-btn" onclick="filterService('patient', this)">Patient</button>
        <button class="btn btn-outline-warning filter-btn" onclick="filterService('pharmacy', this)">Pharmacy</button>

    </div>

    <!-- SERVICES -->
    <div class="container my-4">
        <div class="row g-4">

            <div class="col-lg-4 service-item lab">
                <div class="service-card">
                    <i class="bi bi-droplet-half fs-1 text-primary"></i>
                    <h5 class="mt-3">Blood Test</h5>
                    <p>Accurate lab testing services.</p>
                </div>
            </div>

            <div class="col-lg-4 service-item doctor">
                <div class="service-card">
                    <i class="bi bi-heart-pulse fs-1 text-primary"></i>
                    <h5 class="mt-3">Doctor Consultation</h5>
                    <p>Professional medical advice anytime.</p>
                </div>
            </div>

            <div class="col-lg-4 service-item emergency">
                <div class="service-card">
                    <i class="bi bi-hospital fs-1 text-danger"></i>
                    <h5 class="mt-3">Emergency Care</h5>
                    <p>24/7 emergency support services.</p>
                </div>
            </div>

            <div class="col-lg-4 service-item lab">
                <div class="service-card">
                    <i class="bi bi-file-medical fs-1 text-primary"></i>
                    <h5 class="mt-3">Medical Reports</h5>
                    <p>Secure patient records system.</p>
                </div>
            </div>

            <div class="col-lg-4 service-item doctor">
                <div class="service-card">
                    <i class="bi bi-calendar-check fs-1 text-primary"></i>
                    <h5 class="mt-3">Book Appointments</h5>
                    <p>Book doctors online easily.</p>
                </div>
            </div>

            <!-- NEW: PATIENT -->
            <div class="col-lg-4 service-item patient">
                <div class="service-card">
                    <i class="bi bi-person-heart fs-1 text-success"></i>
                    <h5 class="mt-3">Patient Care</h5>
                    <p>High quality care for patients.</p>
                </div>
            </div>

            <!-- NEW: PHARMACY -->
            <div class="col-lg-4 service-item pharmacy">
                <div class="service-card">
                    <i class="bi bi-capsule-pill fs-1 text-warning"></i>
                    <h5 class="mt-3">Pharmacy</h5>
                    <p>Safe and trusted medicines.</p>
                </div>
            </div>

        </div>
    </div>
    <?php include('shared/footer.html'); ?>


    <!-- JAVASCRIPT -->
    <script>
    let currentCategory = "all";
    let activeBtn = null;

    /* FILTER */
    function filterService(category, btn) {

        currentCategory = category;

        // ACTIVE BUTTON STYLE
        if (activeBtn) {
            activeBtn.classList.remove("active-btn");
            activeBtn.classList.add("btn-outline-primary");
        }

        if (btn) {
            btn.classList.add("active-btn");
            activeBtn = btn;
        }

        applyFilters();
    }

    /* SEARCH */
    function searchService() {
        applyFilters();
    }

    /* COMBINED FILTER */
    function applyFilters() {

        let input = document.getElementById("searchInput").value.toLowerCase();
        let items = document.querySelectorAll(".service-item");

        items.forEach(item => {

            let text = item.innerText.toLowerCase();
            let categoryMatch = currentCategory === "all" || item.classList.contains(currentCategory);
            let searchMatch = text.includes(input);

            if (categoryMatch && searchMatch) {
                item.classList.remove("hide");
                item.classList.add("show");
            } else {
                item.classList.remove("show");
                item.classList.add("hide");
            }
        });
    }
    </script>

</body>

</html>