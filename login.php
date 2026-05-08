<?php
require_once 'config/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Panel | Online Lab Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
            url('assets/images/hospital.jpg');
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
        background-image: url('assets/images/service.jpg');
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

    <?php include 'shared/navbar.html'; ?>

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

    <?php include 'shared/footer.html'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>