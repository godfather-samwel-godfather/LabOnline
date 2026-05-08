<?php include 'head.php'; ?>

<body>
    <?php include 'topnav.php'; ?>

    <div class="sidebar text-white p-2">
        <?php
        // LAZIMA tufafanue $role inatoka wapi kabla ya kuitumia kwenye switch
        // Tunaichukua kutoka kwenye session tuliyoseti kule login_process.php
        $role = $_SESSION['role'] ?? 'patient'; 

        switch($role){
            case 'admin':
                include "../sidebars/admin.php";
                break;
            case 'doctor':
                include "../sidebars/doctor.php";
                break;
            case 'labo':
                include "../sidebars/labo.php";
                break;
            case 'patient':
                include "../sidebars/patient.php";
                break;
            default:
                include "../sidebars/patient.php";
        }
        ?>
    </div>

    <div class="main-content p-3">

        <?php
        if(isset($page_content) && file_exists($page_content)){
            include $page_content;
        }else{
            echo "<h4>Page not found</h4>";
        }
        ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>