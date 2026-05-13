<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once "../auth/redirect.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 1){

$user = $result->fetch_assoc();

if(password_verify($password, $user['password'])){

$_SESSION['user_id'] = $user['id'];
$_SESSION['role'] = $user['role'];

header("Location: " . redirectByRole($user['role']));
exit;

}

}

header("Location: login.php?error=invalid");
exit;

}














?>