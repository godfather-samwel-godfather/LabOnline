<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../auth/redirect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('login.php?error=Invalid request');
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$redirectKey = sanitizeRedirectKey($_POST['redirect'] ?? null);
$redirectQuery = $redirectKey ? '&redirect=' . urlencode($redirectKey) : '';

$sql = 'SELECT * FROM users WHERE email = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    redirect('login.php?error=Invalid email or password' . $redirectQuery);
}

$user = $result->fetch_assoc();

if (!password_verify($password, $user['password'])) {
    redirect('login.php?error=Invalid email or password' . $redirectQuery);
}

// Block users who are not active yet
if ($user['status'] !== 'active') {
    $msg = match ($user['status']) {
        'pending'  => 'Your account is pending admin approval',
        'blocked'  => 'Your account has been blocked',
        'inactive' => 'Your account is suspended',
        default    => 'Your account is not active',
    };
    redirect('login.php?error=' . urlencode($msg) . $redirectQuery);
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['role'] = $user['role'];
$_SESSION['full_name'] = $user['full_name'];
$_SESSION['profile_image'] = $user['profile_image'];

// Update last login
$update = $conn->prepare('UPDATE users SET last_login = NOW() WHERE id = ?');
$update->bind_param('i', $user['id']);
$update->execute();

redirect(redirectAfterLogin($user['role'], $redirectKey));







?>