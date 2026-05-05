<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LabOnline Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
            url('images/hospital.jpg');
        background-size: cover;
        background-position: center;
    }

    /* WRAPPER */
    .register-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 20px;
    }

    /* CARD */
    .main-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    /* LEFT PANEL */
    .brand-section {
        min-height: 420px;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        flex-direction: column;

        background-size: cover;
        background-position: center;

        position: relative;
        transition: 0.4s ease-in-out;
    }

    /* DARK OVERLAY */
    .brand-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.55);
    }

    /* TEXT ABOVE IMAGE */
    .brand-section * {
        position: relative;
        z-index: 2;
    }

    /* ROLE FIELDS */
    #patientFields,
    #doctorFields,
    #labFields {
        display: none;
    }

    /* RESPONSIVE FIX */
    @media (max-width:768px) {
        .brand-section {
            min-height: 220px;
        }
    }
    </style>
</head>

<body>

    <?php include 'shared/navbar.html'; ?>

    <div class=" container register-wrapper">

        <div class="row justify-content-center w-100">
            <div class="col-12 col-lg-10">

                <div class="card main-card">
                    <div class="row g-0">

                        <!-- LEFT SIDE -->
                        <div id="brandSection" class="col-12 col-md-5 brand-section">
                            <h3 class="fw-bold">Registration Panel</h3>
                            <p class="text-white-50">Select role to continue</p>
                        </div>

                        <!-- RIGHT SIDE -->
                        <div class="col-12 col-md-7 p-4 bg-white">

                            <h4 class="fw-bold mb-3">Register Account</h4>

                            <form>

                                <!-- CATEGORY -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold small">Select Category</label>

                                    <select id="userCategory" class="form-select" onchange="toggleField()" required>
                                        <option value="">-- Choose --</option>
                                        <option value="patient">Patient</option>
                                        <option value="doctor">Doctor</option>
                                        <option value="lab">Laboratory</option>
                                    </select>
                                </div>

                                <!-- COMMON -->
                                <div class="row g-2">

                                    <div class="col-12 col-md-6">
                                        <input type="text" class="form-control" placeholder="Full Name" required>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <input type="text" class="form-control" placeholder="Phone Number" required>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <input type="email" class="form-control" placeholder="Email" required>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <input type="password" class="form-control" placeholder="Password" required>
                                    </div>

                                </div>

                                <!-- PATIENT -->
                                <div id="patientFields" class="mt-3">
                                    <input type="date" class="form-control mb-2">
                                    <select class="form-control mb-2">
                                        <option>Gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                    <textarea class="form-control" placeholder="Address"></textarea>
                                </div>

                                <!-- DOCTOR -->
                                <div id="doctorFields" class="mt-3">
                                    <input type="text" class="form-control mb-2" placeholder="Specialization">
                                    <input type="text" class="form-control mb-2" placeholder="License Number">
                                    <input type="text" class="form-control" placeholder="Hospital Name">
                                </div>

                                <!-- LAB -->
                                <div id="labFields" class="mt-3">
                                    <input type="text" class="form-control mb-2" placeholder="Lab Name">
                                    <input type="text" class="form-control mb-2" placeholder="Location">
                                    <input type="text" class="form-control" placeholder="Available Tests">
                                </div>

                                <button class="btn btn-primary w-100 mt-4">
                                    Register
                                </button>

                            </form>

                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <?php include 'shared/footer.html'; ?>

    <script>
    /* ROLE BACKGROUNDS */
    const roleBackgrounds = {
        patient: "images/patient.jpg",
        doctor: "images/doctor.jpg",
        lab: "images/labo.jpg"
    };

    const defaultBackground = "images/default.jpg";

    /* MAIN FUNCTION */
    function toggleField() {

        let category = document.getElementById("userCategory").value;
        let brand = document.getElementById("brandSection");

        // hide all fields
        document.getElementById("patientFields").style.display = "none";
        document.getElementById("doctorFields").style.display = "none";
        document.getElementById("labFields").style.display = "none";

        // DEFAULT IMAGE
        if (!category) {
            brand.style.backgroundImage = `url('${defaultBackground}')`;
            return;
        }

        // ROLE IMAGE
        brand.style.backgroundImage = roleBackgrounds[category] ?
            `url('${roleBackgrounds[category]}')` :
            `url('${defaultBackground}')`;

        // SHOW FIELDS
        document.getElementById(category + "Fields").style.display = "block";
    }

    /* INITIAL LOAD */
    document.addEventListener("DOMContentLoaded", function() {
        toggleField();
    });
    </script>

</body>

</html>