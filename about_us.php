<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">


    <style>
    /* HERO SECTION */
    .hero {
        background: linear-gradient(rgba(0, 31, 63, 0.7), rgba(0, 31, 63, 0.7)),
            url('images/about.jpg');
        background-size: cover;
        background-position: center;
        color: white;
        min-height: 450px;
        display: flex;
        align-items: center;
    }

    /* OVERLAP CARDS */
    .overlap-section {
        margin-top: 10px;
        /* Hii
        inapandisha kadi juu ya hero kama kwenye picha */
    }

    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card img {
        height: 180px;
        object-fit: cover;
    }

    .icon-circle {
        width: 50px;
        height: 50px;
        background-color:
            #0d6efd;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin:
            -25px auto 15px;
        /* Hii inaweka icon katikati ya picha na maandishi */
        position: relative;
        border: 3px solid white;
    }

    .social-icons a {
        color: #6c757d;
        font-size: 1.1rem;
        transition: 0.3s;
    }

    .social-icons a:hover {
        color:
            #0d6efd;
    }

    .bg-light-blue {
        background-color: #f0f7ff;
    }
    </style>
</head>

<body>

    <?php include('shared/navbar.html'); ?>

    <section class="hero">
        <div class="container text-start">
            <div class="row">
                <div class="col-md-7">
                    <span class="badge bg-primary px-3 mb-3 text-uppercase">About Us</span>
                    <h1 class="display-4 fw-bold">We Care For Your Health</h1>
                    <p class="lead">We are a modern healthcare platform focused on improving access to laboratory
                        services, Book tests, schedule home collections and access your results using smart digital
                        systems.
                    </p>
                    <a href="#" class="btn btn-primary btn-lg mt-3 shadow">Learn More ➔</a>
                </div>
            </div>
        </div>
    </section>

    <section class="overlap-section pb-5">
        <div class="container">
            <div class="row g-4 justify-content-center text-center">

                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="images/edit1.jpg" class="card-img-top" alt="Patients">
                        <div class="card-body">
                            <div class="icon-circle shadow"><i class="bi bi-people-fill"></i></div>
                            <h5 class="fw-bold">Patients</h5>
                            <p class="small text-muted">Easy appointment booking, access to medical records and test
                                results anytime, anywhere.</p>
                            <a href="#" class="text-primary text-decoration-none fw-bold small">Learn more ➔</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="images/edit4.jpg" class="card-img-top" alt="Doctors">
                        <div class="card-body">
                            <div class="icon-circle shadow"><i class="bi bi-person-badge-fill"></i></div>
                            <h5 class="fw-bold">Doctors</h5>
                            <p class="small text-muted">Efficient tools for managing patients, schedules, prescriptions
                                and medical history.</p>
                            <a href="#" class="text-primary text-decoration-none fw-bold small">Learn more ➔</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="images/edit3.jpg" class="card-img-top" alt="Labs">
                        <div class="card-body">
                            <div class="icon-circle shadow"><i class="bi bi-microscope"></i></div>
                            <h5 class="fw-bold">Laboratories</h5>
                            <p class="small text-muted">Advanced laboratory systems for fast results, data tracking and
                                report management.</p>
                            <a href="#" class="text-primary text-decoration-none fw-bold small">Learn more ➔</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-light-blue py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-5">Why Choose Us</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-primary mb-3"><i class="bi bi-lightning-charge-fill fs-1"></i></div>
                    <h6 class="fw-bold">Fast & Reliable</h6>
                    <p class="small text-muted px-lg-5">Quick access to services and real-time updates.</p>
                </div>
                <div class="col-md-4">
                    <div class="text-primary mb-3"><i class="bi bi-shield-lock-fill fs-1"></i></div>
                    <h6 class="fw-bold">Secure & Private</h6>
                    <p class="small text-muted px-lg-5">Your health information is safe with us.</p>
                </div>
                <div class="col-md-4">
                    <div class="text-primary mb-3"><i class="bi bi-globe fs-1"></i></div>
                    <h6 class="fw-bold">Anywhere Access</h6>
                    <p class="small text-muted px-lg-5">Use the system anytime, anywhere with any device.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-5">Our Team</h2>
            <div class="row g-4">

                <div class="col-md-3 ">
                    <img src="images/card1.jpg" class="rounded-circle mb-3 shadow-sm" width="100" height="100"
                        style="object-fit: cover;">
                    <h6 class="fw-bold mb-0">System Developer</h6>
                    <p class="small text-muted">Full Stack Developer</p>
                    <div class="d-flex justify-content-center gap-3 social-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>

                <div class="col-md-3 ">
                    <img src="images/abdu.jpg" class="rounded-circle mb-3 shadow-sm" width="100" height="100"
                        style="object-fit: cover;">
                    <h6 class="fw-bold mb-0">Doctor</h6>
                    <p class="small text-muted">Medical Officer</p>
                    <div class="d-flex justify-content-center gap-3 social-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>

                <div class="col-md-3 ">
                    <img src="images/dorine.jpg" class="rounded-circle mb-3 shadow-sm" width="100" height="100"
                        style="object-fit: cover;">
                    <h6 class="fw-bold mb-0">Lab Specialist</h6>
                    <p class="small text-muted">Laboratory Expert</p>
                    <div class="d-flex justify-content-center gap-3 social-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>

                <div class="col-md-3 ">
                    <img src="images/card2.jpg" class="rounded-circle mb-3 shadow-sm" width="100" height="100"
                        style="object-fit: cover;">
                    <h6 class="fw-bold mb-0">Support</h6>
                    <p class="small text-muted">Customer Support</p>
                    <div class="d-flex justify-content-center gap-3 social-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php include 'shared/footer.html'; ?>

</body>

</html>