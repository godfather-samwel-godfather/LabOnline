<?php
require_once __DIR__ . '/../auth/auth.php';

if($_SESSION['role'] !== 'admin'){
    header("Location: ../auth/unauthorized.php");
    exit;
}

$page_content = "content.php";
include "../shared/layout.php";
?>