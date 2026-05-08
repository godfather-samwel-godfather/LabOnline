<?php
require_once __DIR__ . '/../auth/auth.php'; //  security first

if($_SESSION['role'] !== 'doctor'){
    header("Location: ../auth/unauthorized.php");
    exit;
}

$page_content = "content.php";
include "../shared/layout.php";
?>