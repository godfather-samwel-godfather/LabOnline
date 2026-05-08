<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LabOnline Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
            url('assets/images/hospital.jpg');
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

        transition: background-image 0.5s ease-in-out;
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
    #laboFields {
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

                            <form method="POST" action="register_process.php" enctype="multipart/form-data">

                                <!-- CATEGORY -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold small">Select Category</label>

                                    <select id="userCategory" name="role" class="form-select" onchange="toggleField()"
                                        required>
                                        <option value="">-- Choose --</option>
                                        <option value="patient">Patient</option>
                                        <option value="doctor">Doctor</option>
                                        <option value="labo">Laboratory</option>
                                    </select>
                                </div>

                                <!-- COMMON -->
                                <div class="row g-2">

                                    <div class="col-12 col-md-6">
                                        <input type="text" name="full_name" class="form-control" placeholder="Full Name"
                                            required>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <input type="text" name="phone_number" class="form-control"
                                            placeholder="Phone Number" required>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            required>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Password" required>
                                    </div>
                                    <div class="col-12">
                                        <input type="file" name="profile_image" class="form-control" accept="image/*">
                                    </div>

                                </div>

                                <!-- PATIENT -->
                                <div id="patientFields" class="mt-3">
                                    <input type="date" name="dob" class="form-control mb-2">
                                    <select name="blood_group" class="form-control mb-2">
                                        <option value="">Select Blood Group</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                    </select>
                                    <select name="gender" class="form-control mb-2">
                                        <option value="">Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    <textarea name="patient_address" class=" form-control"
                                        placeholder="Home Address(Street,House No)"></textarea>
                                </div>

                                <!-- DOCTOR -->
                                <div id="doctorFields" class="mt-3">
                                    <input type="text" name="specialization" class="form-control mb-2"
                                        placeholder="Specialization">
                                    <input type="text" name="license_number" class="form-control mb-2"
                                        placeholder="License Number">
                                    <input type="text" name="hospital_name" class="form-control"
                                        placeholder="Hospital Name">
                                    <textarea name="doctor_address" class="form-control"
                                        placeholder="Hospital Address(eg;Mikocheni Rd, Regacy medical center)"></textarea>
                                </div>


                                <!-- LAB -->
                                <div id="laboFields" class="mt-3">
                                    <input type="text" name="labo_name" class="form-control mb-2"
                                        placeholder="Labo Name">
                                    <input type="text" name="location" class="form-control mb-2" placeholder="Location">
                                    <input type="text" name="available_tests" class="form-control"
                                        placeholder="Available Tests">
                                    <textarea name="labo_address" class=" form-control"
                                        placeholder="Physical Address(e.g.,plot No.45, 1st Floor, Sunshine plaza)"></textarea>
                                </div>


                                <button class=" btn btn-primary w-100 mt-4">
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
        patient: "assets/images/patient.jpg",
        doctor: "assets/images/doctor.jpg",
        labo: "assets/images/labo.jpg"
    };

    const defaultBackground = "assets/images/default.jpg";

    /* MAIN FUNCTION */
    function toggleField() {
        let category = document.getElementById("userCategory").value;
        let brand = document.getElementById("brandSection");
        let formTitle = document.querySelector("h4.fw-bold");

        const roles = ["patient", "doctor", "labo"];

        roles.forEach(role => {
            let section = document.getElementById(role + "Fields");

            if (section) {
                // Tunatafuta input, select, na textarea zote ndani ya div ya role husika
                let inputs = section.querySelectorAll("input, select, textarea");

                if (role === category) {
                    // 1. Onyesha na Wasiliana na hizi fields
                    section.style.display = "block";
                    inputs.forEach(input => {
                        input.disabled = false; // Inaruhusu data kutumwa
                        input.required = true; // Inamlazimisha mtumiaji ajaze
                    });
                } else {
                    // 2. Ficha na Zima kabisa hizi fields
                    section.style.display = "none";
                    inputs.forEach(input => {
                        input.disabled = true; // Inazuia data isitumwe PHP
                        input.required = false; // Inazuia kizuizi cha browser
                        input.value = ""; // Inasafisha maandishi yoyote yaliyokuwemo
                    });
                }
            }
        });

        // UX: Maboresho ya picha na kichwa cha habari kulingana na Role iliyochaguliwa
        if (category) {
            formTitle.innerText = "Register as " + category.charAt(0).toUpperCase() + category.slice(1);
            brand.style.backgroundImage = `url('${roleBackgrounds[category]}')`;
        } else {
            formTitle.innerText = "Register Account";
            brand.style.backgroundImage = `url('${defaultBackground}')`;
        }
    }

    /* INITIAL LOAD: Inahakikisha fomu inaanza ikiwa safi pindi page inapofunguka */
    document.addEventListener("DOMContentLoaded", function() {
        toggleField();
    });
    </script>

</body>

</html>