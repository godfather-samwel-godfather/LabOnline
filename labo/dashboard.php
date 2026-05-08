<?php
require_once __DIR__ . '/../auth/auth.php'; //  login + role check

//=== ROLE PROTECTION==
if($_SESSION['role'] !== 'labo'){
    header("Location: ../auth/unauthorized.php");
    exit;
}

$page_content = "content.php";
include "../shared/layout.php";
?>