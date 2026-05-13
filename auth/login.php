<?php
require_once '../config/db.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Panel | Online Lab Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
            url('../assets/images/hospital.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 20px;
    }

    .login-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .left-panel {
        min-height: 450px;
        background-image: url('../assets/images/service.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        transition: 0.4s ease-in-out;
    }

    .left-panel::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.55);
    }

    .left-panel * {
        position: relative;
        z-index: 2;
    }

    @media(max-width:768px) {
        .left-panel {
            min-height: 220px;
        }
    }
    </style>
</head>

<body>
    <header class="bg-white shadow-sm sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light container py-3">
            <a class="navbar-brand fw-bold text-cyan" href="#">
                <i class="bi bi-hospital"></i> ONLINE LABO CARE PORTAL
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-3  fw-semibold">
                    <li class="nav-item"><a class="nav-link" href="../home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../about_us.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="../our_services.php">Our Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="../contact_us.php">Contact </a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Register </a></li>
                    <li>
                        <a class="btn bg-cyan rounded-pill px-4 shadow-sm" href="login.php">Login Panel</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>



    <div class="container login-wrapper">
        <div class="row justify-content-center w-100">
            <div class="col-12 col-lg-10">

                <div class="card login-card">
                    <div class="row g-0">

                        <div id="leftPanel"
                            class="col-12 col-md-5 left-panel d-flex flex-column justify-content-center align-items-center text-white text-center p-4">
                            <h3 class="fw-bold">Online Lab Portal</h3>
                            <p class="text-info">Login to continue</p>
                        </div>

                        <div class="col-12 col-md-7 bg-white p-4">

                            <?php if(isset($_GET['msg'])): ?>
                            <div class="alert alert-success py-2 small alert-dismissible fade show">
                                <i class="bi bi-check-circle me-1"></i>
                                <?php echo htmlspecialchars($_GET['msg']); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php endif; ?>

                            <?php if(isset($_GET['error'])): ?>
                            <div class="alert alert-danger py-2 small alert-dismissible fade show">
                                <i class="bi bi-exclamation-circle me-1"></i>
                                <?php echo htmlspecialchars($_GET['error']); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php endif; ?>

                            <h4 class="fw-bold mb-3">Login</h4>

                            <form method="POST" action="login_process.php" id="loginForm">
                                <div class="mb-3">
                                    <label class="form-label small">Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password"
                                        required>
                                </div>

                                <button type="submit" class="btn btn-success w-100 py-2">
                                    Login
                                </button>

                                <div class="text-center mt-3">
                                    <small class="text-muted">
                                        Don't have an account?
                                        <a href="register.php" class="fw-bold text-primary text-decoration-none">
                                            Register
                                        </a>
                                    </small>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer class="bg-dark text-white-50 py-5">
        <div class="container">
            <div class="row g-4">

                <div class="col-lg-3 col-md-6">
                    <div class="navbar-brand text-white d-flex align-items-center mb-3">
                        <i class="bi bi-activity text-cyan fs-3 me-2"></i>
                        <span class="fw-bold">HealthSystem</span>
                    </div>
                    <p class="small">
                        We are dedicated to providing the best healthcare solutions for individuals, doctors and
                        laboratories.
                    </p>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5 class="text-white mb-4 border-start border-info border-4 ps-3">QUICK LINKS</h5>
                    <ul class="list-unstyled">
                        <li><a href="../home.php" class="hover-text">Home</a></li>
                        <li><a href="../about_us.php" class="hover-text text-cyan fw-bold">About Us</a></li>
                        <li><a href="../our_services.php" class="hover-text">Service</a></li>
                        <li><a href="../contact_us.php" class="hover-text">Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5 class="text-white mb-4 border-start border-info border-4 ps-3">SERVICES</h5>
                    <ul class="list-unstyled">
                        <li class="small">Appointments</li>
                        <li class="small">Lab Tests</li>
                        <li class="small">Medical Records</li>
                        <li class="small">Consultations</li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4 border-start border-info border-4 ps-3">CONTACT US</h5>
                    <p class="small"><i class="bi bi-telephone text-cyan me-2"></i> +255 683-29-66-37</p>
                    <p class="small"><i class="bi bi-envelope-at text-cyan me-2"></i> info@healthsystem.com</p>
                    <p class="small"><i class="bi bi-geo-alt text-cyan me-2"></i> Dar es Salaam, Tanzania</p>
                    <p class="small"><i class="bi bi-map text-cyan me-2"></i> Visit Us (Map)</p>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5 class="text-white mb-4 border-start border-info border-4 ps-3">FOLLOW US</h5>
                    <div class="d-flex gap-2">
                        <a href="#" class="social-circle-btn"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-circle-btn"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="social-circle-btn"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-circle-btn"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>

            </div>

            <hr class="mt-5 border-secondary">

            <div class="text-center small">
                &copy; 2026 MEDICAL Labo-Care. Built with Good-Service & Care.
                Github: <a href="https://github.com/godfather-samwel-godfather/LabOnline.git" target="_blank"
                    class="text-cyan">https://github.com/godfather-samwel-godfather/LabOnline.git</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>