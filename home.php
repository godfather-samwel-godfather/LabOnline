<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE - Labo Care Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">


    <style>
    .hero-bg {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
            url('assets/images/hospital.jpg');
        background-size: cover;
        background-position: center;
        min-height: 70vh;
    }

    .bg-cyan {
        background-color: #00bcd4 !important;
        color: white !important;
    }

    .text-cyan {
        color: #00bcd4 !important;
    }

    footer ul li {
        margin-bottom: 8px;
    }

    /*smooth animation of nvbar-brand*/
    .navbar-brand {
        transition: 0.3s ease;
    }

    /*nav brand */
    .navbar-brand:hover {
        color: #00bcd4 !important;
        transform: translateY(-5px);
    }

    /*color during hover */
    .hover-text:hover {
        color: #00bcd4 !important;
    }

    .hover-text {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    /*buid line */
    .hover-text::after {
        content: "";
        position: absolute;
        width: 100%;
        height: 2px;
        background-color: #00bcd4;
        left: 0;
        bottom: -3px;
        /*line start as hidden*/
        transform: scaleX(0);
        transform-origin: bottom right;
        transition: transform 0.3s ease-out;
    }

    /*line side of start appear */
    .hover-text:hover::after {
        transform: scaleX(1);
        transform-origin: bottom left;
    }

    /*smooth image animation */
    .img-fluid {
        transition: 0.3s ease;
    }

    /*when hover scale 1.05 img inlarge kidogo -10px juu idogo kidogo scale 0.05*/
    .img-fluid:hover {
        transform: scale(1.1);
    }

    /*nav link hover*/
    footer a:hover {
        color: #00bcd4 !important;
        transform: translateY(5px);
    }

    /*nav links base style*/
    footer a {
        color: inherit;
        text-decoration: none;
        display: inline-block;
        transition: 0.3s ease;
    }

    /*smooth animation for login btn */
    .navbar-nav .btn {
        transition: 0.3s ease;
    }

    /*navbar hover effect login btn */
    .navbar-nav .btn:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    /* NAV LINKS */
    .navbar-nav .nav-link {
        position: relative;
        display: inline-block;
        color: #555;
        transition: color 0.3s ease;
    }

    /* Hover: text iwe black */
    .navbar-nav .nav-link:hover {
        color: #000;
    }

    /* Underline (hidden mwanzo) */
    .navbar-nav .nav-link::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -4px;
        width: 0%;
        height: 2px;
        background-color: #00bcd4;
        transition: width 0.3s ease;
    }

    /* Hover: underline ionekane */
    .navbar-nav .nav-link:hover::after {
        width: 100%;
    }

    /* HOW IT WORKS MODERN CARDS */
    .how-card {
        border: none;
        border-radius: 18px;
        transition: all 0.35s ease;
        overflow: hidden;
        position: relative;
        background: #fff;
    }

    /* hover lift + shadow + glow */
    .how-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(0, 188, 212, 0.25);
    }

    /* icon circle animation */
    .how-card i {
        transition: all 0.35s ease;
        display: inline-block;
    }

    .how-card:hover i {
        transform: scale(1.2) rotate(5deg);
        color: #00bcd4;
    }

    /* subtle top glow line */
    .how-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: #00bcd4;
        transition: 0.4s ease;
    }

    .how-card:hover::before {
        width: 100%;
    }

    /* text smooth effect */
    .how-card h5 {
        transition: 0.3s ease;
    }

    .how-card:hover h5 {
        color: #00bcd4;
    }
    </style>
</head>

<body class="bg-light">

    <!-- INCLUDE NAVBAR -->
    <?php include('shared/navbar.html'); ?>

    <main>

        <!-- HERO -->
        <section class="hero-bg d-flex align-items-center text-white">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-8">
                        <p class="text-cyan fw-bold">WELCOME TO ONLINE-LCP</p>
                        <h1 class=" hover-text display-3 fw-bold mb-4">
                            Meet Super Specialized <br> Medical Care Service
                        </h1>

                        <div class="d-flex gap-3 mt-4">
                            <button class="btn bg-cyan btn-lg rounded-pill px-4">Check Appointment</button>
                            <button class="btn btn-outline-light btn-lg rounded-pill px-4">Appointment</button>
                        </div>
                    </div>

                    <div class="col-lg-4 d-none d-lg-block text-end">
                        <img src="assets/images/doctor1.jpg" class="img-fluid rounded-4 shadow" alt="Doctor">
                    </div>

                </div>
            </div>
        </section>

        <!-- ABOUT -->
        <section class="py-5 bg-info">
            <div class="container py-5">
                <div class="row align-items-center g-5">

                    <div class="col-md-6">
                        <img src="assets/images/test.jpg" class="img-fluid rounded-4 shadow" alt="Service">
                    </div>

                    <div class="col-md-6">
                        <span class="text-dark fw-bold">ABOUT US</span>
                        <h2 class=" falling-text display-6 fw-bold my-3">
                            Best Medical Care For Yourself and Your Family
                        </h2>
                        <p class="text-muted fs-5">
                            We provide excellent healthcare services using modern technology.
                        </p>
                    </div>

                </div>
            </div>
        </section><!-- HOW IT WORKS -->
        <section class="py-5 bg-light">
            <div class="container text-center">

                <!-- Header -->
                <span class="text-cyan fw-bold">HOW IT WORKS</span>
                <h2 class="fw-bold mb-4">Simple Steps to Get Your Medical Services Online</h2>

                <!-- Process line -->
                <div class="d-flex justify-content-center align-items-center mb-5">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-cyan text-white d-flex align-items-center justify-content-center"
                            style="width:30px; height:30px;">1</div>

                        <div style="width:80px; height:2px; background:#00bcd4;"></div>

                        <div class="rounded-circle bg-cyan text-white d-flex align-items-center justify-content-center"
                            style="width:30px; height:30px;">2</div>

                        <div style="width:80px; height:2px; background:#00bcd4;"></div>

                        <div class="rounded-circle bg-cyan text-white d-flex align-items-center justify-content-center"
                            style="width:30px; height:30px;">3</div>

                        <div style="width:80px; height:2px; background:#00bcd4;"></div>

                        <div class="rounded-circle bg-cyan text-white d-flex align-items-center justify-content-center"
                            style="width:30px; height:30px;">4</div>
                    </div>
                </div>

                <!-- Cards -->
                <div class="row g-4">

                    <!-- Step 1 -->
                    <div class="col-md-3">
                        <div class="card h-100 shadow how-card">
                            <div class="card-body">
                                <i class="bi bi-calendar-check text-cyan fs-1 mb-3"></i>
                                <h5 class="fw-bold">Book Appointment</h5>
                                <p class="text-muted">Patients book appointments online easily through the platform.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="col-md-3">
                        <div class="card h-100 shadow how-card">
                            <div class="card-body">
                                <i class="bi bi-house-heart text-cyan fs-1 mb-3"></i>
                                <h5 class="fw-bold">Home Sample Collection</h5>
                                <p class="text-muted">Our lab team visits your home to collect samples safely.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="col-md-3">
                        <div class="card h-100 shadow how-card">
                            <div class="card-body">
                                <i class="bi bi-cpu text-cyan fs-1 mb-3"></i>
                                <h5 class="fw-bold">Lab Processing</h5>
                                <p class="text-muted">Samples are analyzed in our modern laboratory systems.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="col-md-3">
                        <div class="card h-100 shadow how-card">
                            <div class="card-body">
                                <i class="bi bi-file-earmark-medical text-cyan fs-1 mb-3"></i>
                                <h5 class="fw-bold">Get Results Online</h5>
                                <p class="text-muted">Patients access results instantly through digital platform.</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

    </main>

    <!-- INCLUDE FOOTER -->
    <?php include('shared/footer.html'); ?>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Tafuta element yenye maneno
        const textElement = document.querySelector('.falling-text');

        if (textElement) {
            const originalText = textElement.textContent.trim();
            textElement.innerHTML = ''; // Futa text ya zamani

            // Vunja sentensi na weka kila herufi kwenye span
            [...originalText].forEach((letter, i) => {
                const span = document.createElement('span');

                // Shughulikia nafasi (space) kati ya maneno
                span.innerHTML = letter === ' ' ? '&nbsp;' : letter;

                // Ongeza delay ya 0.05s kwa kila herufi inayofuata
                span.style.animationDelay = `${i * 0.05}s`;

                textElement.appendChild(span);
            });
        }
    });
    </script>

</body>

</html>