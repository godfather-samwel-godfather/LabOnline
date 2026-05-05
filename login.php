<!DOCTYPE html>
<html lang="sw">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> Login Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
            url('images/hospital.jpg');
        background-size: cover;
        background-position: center;
    }

    .left-panel {
        min-height: 450px;

        /* IMAGE + OVERLAY (merged) */
        background-image:

            /*linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),*/
            url('images/service.jpg');

        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;

        position: relative;
        transition: 0.4s ease-in-out;
    }


    /* WRAPPER */
    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 20px;
    }

    /* CARD */
    .login-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    /* LEFT PANEL */
    .left-panel {
        min-height: 450px;
        background-size: cover;
        background-position: center;
        position: relative;
        transition: 0.4s ease-in-out;
    }

    /* OVERLAY */
    .left-panel::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.55);
    }

    /* TEXT ABOVE */
    .left-panel * {
        position: relative;
        z-index: 2;
    }

    /* RESPONSIVE */
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

                        <!-- LEFT SIDE -->
                        <div id="leftPanel"
                            class="col-12 col-md-5 left-panel d-flex flex-column justify-content-center align-items-center text-white text-center">

                            <h3 class="fw-bold">Online Lab Portal</h3>
                            <p class="text-info">Login to continue</p>

                        </div>

                        <!-- RIGHT SIDE -->
                        <div class="col-12 col-md-7 bg-white p-4">

                            <h4 class="fw-bold mb-3">Login</h4>

                            <form id="loginForm">
                                <!-- EMAIL -->
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email" required>
                                </div>

                                <!-- PASSWORD -->
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Password" required>
                                </div>

                                <!-- LOGIN BUTTON -->
                                <button class="btn btn-success w-100">
                                    Login
                                </button>

                                <!-- REGISTER MESSAGE -->
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

    <script>

    </script>

</body>

</html>