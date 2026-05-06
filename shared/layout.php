<!--=====-Inaanza session
Inachukua role
Inahakikisha role ni valid
Inalinda system isi-break====-->
<?php
session_start();

// 🔥 ROLE SWITCH VIA URL (FOR TESTING)
if(isset($_GET['role'])){
    $_SESSION['role'] = $_GET['role'];
}

$role = $_SESSION['role'] ?? 'patient';

$allowed_roles = ['admin', 'doctor', 'labo', 'patient'];

if(!in_array($role, $allowed_roles)){
    $role = 'patient';
    $_SESSION['role'] = 'patient';
}
?>

<?php include 'head.php'; ?>

<body>

    <?php include 'topnav.php'; ?>

    <!-- SIDEBAR -->
    <div class="sidebar text-white p-2">
        <?php
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
        default:
            include "../sidebars/patient.php";
    }
    ?>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content p-3">

        <!-- 🔥 ROLE SWITCHER (TESTING TOOL) -->
        <div class="card p-2 mb-3 shadow-sm">
            <small class="text-muted">Switch Role (Testing)</small><br>

            <a href="?role=admin" class="btn btn-outline-primary btn-sm">Admin</a>
            <a href="?role=doctor" class="btn btn-outline-success btn-sm">Doctor</a>
            <a href="?role=labo" class="btn btn-outline-warning btn-sm">Labo</a>
            <a href="?role=patient" class="btn btn-outline-dark btn-sm">Patient</a>
        </div>

        <!-- PAGE CONTENT -->
        <?php
    if(isset($page_content) && file_exists($page_content)){
        include $page_content;
    }else{
        echo "<h4>Page not found</h4>";
    }
    ?>

    </div>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>