<?php
session_start();
// Using __DIR__ ensures the path is absolute and reliable
require_once __DIR__ . '/../config/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Sanitize input to prevent SQL Injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // 2. Fetch the user from the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // 3. Verify hashed password
        if (password_verify($password, $user['password'])) {
            
            // 4. Set Session Variables for global use
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['profile_image'] = $user['profile_image'];

            // 5. Role-Based Redirection (The Controller)
            switch ($user['role']) {
                case 'admin':
                    header("Location: ../admin/dashboard.php");
                    break;
                case 'doctor':
                    header("Location: ../doctor/dashboard.php");
                    break;
                case 'patient':
                    header("Location: ../patient/dashboard.php");
                    break;
                case 'labo':
                    header("Location: ../labo/dashboard.php");
                    break;
                default:
                    header("Location: login.php?error=Unauthorized role");
                    break;
            }
            exit();

        } else {
            // Password mismatch
            header("Location: login.php?error=Invalid password");
            exit();
        }
    } else {
        // Email not found
        header("Location: login.php?error=Account not found");
        exit();
    }
} else {
    // Direct access attempt
    header("Location: login.php");
    exit();
}