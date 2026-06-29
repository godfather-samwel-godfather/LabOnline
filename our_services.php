<?php
require_once 'includes/helpers.php';
require_once 'config/db.php';
require_once 'repositories/LabTestRepository.php';

$labTestRepo = new LabTestRepository($conn);
$tests = $labTestRepo->getAllWithCategory();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Our Services</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">


    <style>
    body {
        background: #f5f7fb;
    }


    /* HERO */

    .hero {

        background:
            linear-gradient(rgba(0, 0, 80, .7), rgba(0, 0, 80, .7)),
            url("assets/images/labo.jpg");

        background-size: cover;

        background-position: center;

        color: white;

        padding: 90px 20px;

        text-align: center;

    }




    /* CARD */

    .service-card {

        background: white;

        border-radius: 20px;

        padding: 30px 25px;

        text-align: center;

        box-shadow: 0 8px 25px rgba(0, 0, 0, .08);

        transition: .4s;

        height: 100%;

    }



    .service-card:hover {

        transform: translateY(-12px);

        box-shadow: 0 15px 35px rgba(0, 0, 0, .15);

    }





    .service-icon {

        width: 80px;

        height: 80px;

        margin: auto;

        border-radius: 50%;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #eaf2ff;

    }



    .service-icon i {

        font-size: 40px;

    }





    .price-box {

        font-size: 18px;

        font-weight: bold;

        color: #0d6efd;

    }





    .book-btn {

        border-radius: 25px;

        padding: 8px 25px;

    }






    .search-box {

        max-width: 400px;

        margin: auto;

        border-radius: 25px;

    }



    .filter-btn {

        margin: 5px;

        border-radius: 20px;

    }



    .active-btn {

        background: #0d6efd !important;

        color: white !important;

    }



    .show {

        opacity: 1;

        transform: scale(1);

        transition: .4s;

    }



    .hide {

        display: none;

    }
    </style>


</head>


<body>


    <?php include('shared/navbar.html'); ?>



    <!-- HERO -->

    <div class="hero">

        <h1>Our Services</h1>

        <p>Reliable laboratory and patient care services</p>

    </div>





    <!-- SEARCH -->

    <div class="container my-4 text-center">


        <input type="text" id="searchInput" class="form-control search-box" placeholder="Search services..."
            onkeyup="searchService()">


    </div>





    <!-- FILTER -->

    <div class="container text-center">


        <button class="btn btn-primary filter-btn active-btn" onclick="filterService('all',this)">
            All
        </button>



        <button class="btn btn-outline-primary filter-btn" onclick="filterService('lab',this)">
            Lab Tests
        </button>



        <button class="btn btn-outline-success filter-btn" onclick="filterService('patient',this)">
            Patient
        </button>



        <button class="btn btn-outline-danger filter-btn" onclick="filterService('emergency',this)">
            Emergency
        </button>



    </div>






    <!-- SERVICES -->

    <div class="container my-5">


        <div class="row g-4">





            <!-- DATABASE LAB TESTS -->


            <?php foreach($tests as $test): ?>


            <div class="col-lg-4 service-item lab">


                <div class="service-card">


                    <div class="service-icon">

                        <i class="bi bi-droplet-half text-primary"></i>

                    </div>



                    <h5 class="mt-4">

                        <?= e($test['test_name']) ?>

                    </h5>



                    <span class="badge bg-primary">

                        <?= e($test['category_name'] ?? '-') ?>

                    </span>



                    <p class="mt-3">

                        <?= e($test['description']) ?>

                    </p>



                    <div class="price-box">

                        <?= number_format($test['price']) ?> TZS

                    </div>



                    <p class="text-muted">

                        <i class="bi bi-clock"></i>

                        <?= e($test['duration']) ?>

                    </p>



                    <button class="btn btn-primary book-btn">

                        Book Test

                    </button>



                </div>


            </div>



            <?php endforeach; ?>








            <!-- PATIENT CARE -->


            <div class="col-lg-4 service-item patient">


                <div class="service-card">


                    <div class="service-icon">

                        <i class="bi bi-person-heart text-success"></i>

                    </div>



                    <h5 class="mt-4">

                        Patient Care

                    </h5>



                    <p>

                        High quality care and support for patients.

                    </p>



                    <a href="" class="btn btn-success book-btn">

                        Learn More

                    </a>



                </div>


            </div>








            <!-- EMERGENCY -->


            <div class="col-lg-4 service-item emergency">


                <div class="service-card">


                    <div class="service-icon">

                        <i class="bi bi-hospital text-danger"></i>

                    </div>



                    <h5 class="mt-4">

                        Emergency Care

                    </h5>



                    <p>

                        24/7 emergency medical support services.

                    </p>



                    <a href="contact_us.php" class="btn btn-danger book-btn">

                        Contact Now

                    </a>



                </div>


            </div>






        </div>


    </div>






    <?php include('shared/footer.html'); ?>






    <script>
    let currentCategory = "all";

    let activeBtn = null;



    function filterService(category, btn) {


        currentCategory = category;



        if (activeBtn) {

            activeBtn.classList.remove("active-btn");

        }


        btn.classList.add("active-btn");


        activeBtn = btn;


        applyFilters();


    }




    function searchService() {

        applyFilters();

    }





    function applyFilters() {


        let input = document
            .getElementById("searchInput")
            .value
            .toLowerCase();



        let items = document.querySelectorAll(".service-item");



        items.forEach(item => {


            let text = item.innerText.toLowerCase();


            let categoryMatch =
                currentCategory === "all" ||
                item.classList.contains(currentCategory);



            let searchMatch =
                text.includes(input);



            if (categoryMatch && searchMatch) {

                item.classList.remove("hide");

            } else {

                item.classList.add("hide");

            }


        });


    }
    </script>



</body>

</html>