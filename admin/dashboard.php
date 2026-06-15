<?php
session_start();
require_once __DIR__ . '/../auth/auth.php'; // Hakikisha amelogin
require_once __DIR__ . '/../includes/bootstrap.php';

// === 1. ROLE PROTECTION ===
// Zuia mtu asiye mgonjwa kuingia huku
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../auth/unauthorized.php");
    exit;
}

// === 2. DYNAMIC ROUTING (DRY Logic) ===
// Tunapata jina la page kutoka kwenye URL (mfano: ?page=results)
$p = $_GET['page'] ?? 'home'; 

// Safisha jina la file kwa ajili ya usalama
$p = basename($p); 

// Tafuta file husika ndani ya folder la 'content'
$page_content = "content/{$p}.php"; 

// Kama file halipo, rudi home
if (!file_exists($page_content)) {
    $page_content = "content/home.php"; 
}

// === 3. LOAD LAYOUT ===
// Layout sasa itachukua $page_content na kuiweka katikati ya Navbar na Sidebar
include "../shared/layout.php";
?>