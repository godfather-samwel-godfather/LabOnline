<?php
// 1. Unganisha na Database
require_once __DIR__ . '/config/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 2. Pokea Common Fields (Data za Login)
    $role = $_POST['role'] ?? '';
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    // 3. FILE VALIDATION (Security for Profile Image)
    $profile_image = "default.png"; 
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['profile_image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $new_name = time() . "_" . uniqid() . "." . $ext;
            $target = "assets/uploads/" . $new_name;
            
            // Hakikisha folder lipo
            if (!is_dir("assets/uploads/")) {
                mkdir("assets/uploads/", 0777, true);
            }

            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target)) {
                $profile_image = $new_name;
            }
        } else {
            header("Location: register.php?error=Invalid image Type");
            exit();
        }
    }

    // 4. ANZA TRANSACTION (Usalama wa Uhusiano wa Tables)
    $conn->begin_transaction();

    try {
        // A. Kagua kama Email tayari ipo
        $checkEmail = "SELECT email FROM users WHERE email = ?";
        $stmtCheck = $conn->prepare($checkEmail);
        $stmtCheck->bind_param("s", $email);
        $stmtCheck->execute();
        if ($stmtCheck->get_result()->num_rows > 0) {
            throw new Exception("Email Already exist!");
        }

        // B. Ingiza kwenye table kuu ya USERS
        $sqlUser = "INSERT INTO users (full_name, email, phone_number, password, role, profile_image) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtUser = $conn->prepare($sqlUser);
        $stmtUser->bind_param("ssssss", $full_name, $email, $phone, $password, $role, $profile_image);
        $stmtUser->execute();
        
        // Pata ID ya huyu user aliyesajiliwa sasa hivi
        $user_id = $conn->insert_id;

        // C. Ingiza kwenye Role-Specific Table
        if ($role == 'patient') {
            $dob = $_POST['dob'] ?? null;
            $blood = $_POST['blood_group'] ?? null;
            $gender = $_POST['gender'] ?? null;
            $address = $_POST['patient_address'] ?? null;

            $sqlRole = "INSERT INTO patients (user_id, gender, dob, blood_group, patient_address) VALUES (?, ?, ?, ?, ?)";
            $stmtRole = $conn->prepare($sqlRole);
            $stmtRole->bind_param("issss", $user_id, $gender, $dob, $blood, $address);

        } elseif ($role == 'doctor') {
            $spec = $_POST['specialization'] ?? null;
            $license = $_POST['license_number'] ?? null;
            $hosp = $_POST['hospital_name'] ?? null;
            $address = $_POST['doctor_address'] ?? null;

            $sqlRole = "INSERT INTO doctors (user_id, specialization, license_number, hospital_name, doctor_address) VALUES (?, ?, ?, ?, ?)";
            $stmtRole = $conn->prepare($sqlRole);
            $stmtRole->bind_param("issss", $user_id, $spec, $license, $hosp, $address);

        } elseif ($role == 'labo') {
            $lab_name = $_POST['labo_name'] ?? $full_name;
            $loc = $_POST['location'] ?? null;
            $tests = $_POST['available_tests'] ?? null;
            $address = $_POST['labo_address'] ?? null;

            $sqlRole = "INSERT INTO laboratories (user_id, labo_name, location, available_tests, labo_address) VALUES (?, ?, ?, ?, ?)";
            $stmtRole = $conn->prepare($sqlRole);
            $stmtRole->bind_param("issss", $user_id, $lab_name, $loc, $tests, $address);
        }

        $stmtRole->execute();

        // Kila kitu kiko sawa, hifadhi mabadiliko (Commit)
        $conn->commit();
        
        header("Location: login.php?msg=Registration Successful! Please login.");
        exit();

    } catch (Exception $e) {
        // Ikitokea error yoyote, rudisha database hali ya mwanzo (Rollback)
        $conn->rollback();
        header("Location: register.php?error=" . urlencode($e->getMessage()));
        exit();
    }

    $conn->close();
}
?>