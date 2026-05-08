<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Us</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">


    <style>
    body {
        background: #f5f7fb;
    }

    /* HERO */
    .hero {
        background: linear-gradient(rgba(0, 0, 80, 0.7), rgba(0, 0, 80, 0.7)),
            url("assets/images/hospital.jpg");
        background-size: cover;
        background-position: center;
        color: white;
        padding: 80px 20px;
        text-align: center;
    }

    /* CARD STYLE */
    .card-box {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        padding: 25px;
    }

    /* INPUTS */
    .form-control {
        border-radius: 10px;
    }

    /* BUTTON */
    .btn-send {
        background: #0d6efd;
        color: white;
        border-radius: 10px;
        padding: 12px;
    }

    .btn-send:hover {
        background: #084298;
    }

    /* INFO ICON */
    .info i {
        font-size: 20px;
        color: #0d6efd;
        margin-right: 10px;
    }
    </style>
</head>

<body>
    <?php include('shared/navbar.html'); ?>


    <!-- HERO SECTION -->
    <div class="hero">
        <h1>Contact Us</h1>
        <p>We are here to help and answer any question</p>
    </div>

    <!-- MAIN SECTION -->
    <div class="container my-5">
        <div class="row g-4">

            <!-- FORM -->
            <div class="col-lg-7">
                <div class="card-box">
                    <h4 class="mb-3">Send Us a Message</h4>

                    <form action="send_mail.php" method="POST">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Your Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your name"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Your Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email"
                                    required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="Enter subject">
                        </div>

                        <div class="mb-3">
                            <label>Message</label>
                            <textarea name="message" rows="5" class="form-control" placeholder="Type your message..."
                                required></textarea>
                        </div>

                        <button class="btn btn-send w-100">
                            <i class="bi bi-send"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>

            <!-- CONTACT INFO -->
            <div class="col-lg-5">

                <div class="card-box mb-4">
                    <h5>Contact Information</h5>

                    <div class="info mt-3">
                        <p><i class="bi bi-geo-alt"></i> Dar es Salaam, Tanzania</p>
                        <p><i class="bi bi-telephone"></i> +255 700 000 000</p>
                        <p><i class="bi bi-envelope"></i> info@healthsystem.com</p>
                        <p><i class="bi bi-clock"></i> 24/7 Support Available</p>
                    </div>
                </div>

                <!-- MAP -->
                <div class="card-box">
                    <iframe src="https://maps.google.com/maps?q=dar%20es%20salaam&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        width="100%" height="250" style="border:0; border-radius:10px;">
                    </iframe>
                </div>

            </div>

        </div>
    </div>
    <!-- INCLUDE FOOTER -->
    <?php include('shared/footer.html'); ?>

</body>

</html>