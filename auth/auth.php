<!--=====-Inaanza session
Inachukua role
Inahakikisha role ni valid
Inalinda system isi-break====-->
<!-- ===CALLED MIDDWARE (AUTH GUARD)===-->
<?php
session_start();
require_once __DIR__ . '/../config/db.php';

//  LOGIN CONTROL / lOGIN CHECK(IMPORTANT)
if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit;
}
//  ROLE VALIDATE  (IMPORTANT)

    $valid_roles = ['admin', 'doctor', 'labo', 'patient'];
    if(!in_array($_SESSION['role'], $valid_roles)){
        // Invalid role, Force log out user safely
        session_destroy();
        header("Location: ../login.php");
        exit;
    }