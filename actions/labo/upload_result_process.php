<?php
/**
 * Labo: pakia faili ya matokeo na kamilisha appointment.
 */
require_once __DIR__ . '/../../includes/action_bootstrap.php';
requireRole('labo');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../../labo/dashboard.php?page=upload_results&error=Invalid request');
}

$appointmentId = (int) ($_POST['appointment_id'] ?? 0);
$remarks = trim($_POST['remarks'] ?? '');
$labUserId = getCurrentUserId();

if (!$appointmentId) {
    redirect('../../labo/dashboard.php?page=upload_results&error=Select an appointment');
}

if (!isset($_FILES['result_file']) || $_FILES['result_file']['error'] !== UPLOAD_ERR_OK) {
    redirect('../../labo/dashboard.php?page=upload_results&error=Please upload a result file');
}

$allowed = ['pdf', 'jpg', 'jpeg', 'png'];
$ext = strtolower(pathinfo($_FILES['result_file']['name'], PATHINFO_EXTENSION));

if (!in_array($ext, $allowed, true)) {
    redirect('../../labo/dashboard.php?page=upload_results&error=Only PDF, JPG, PNG files allowed');
}

$uploadDir = __DIR__ . '/../../assets/uploads/results/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$fileName = time() . '_' . uniqid() . '.' . $ext;
$target = $uploadDir . $fileName;

if (!move_uploaded_file($_FILES['result_file']['tmp_name'], $target)) {
    redirect('../../labo/dashboard.php?page=upload_results&error=Upload failed');
}

// Path stored in DB (relative for browser)
$dbPath = 'assets/uploads/results/' . $fileName;

$resultRepo = new TestResultRepository($conn);

if ($resultRepo->uploadAndComplete($appointmentId, $labUserId, $dbPath, $remarks)) {
    redirect('../../labo/dashboard.php?page=upload_results&msg=Result uploaded successfully');
}

redirect('../../labo/dashboard.php?page=upload_results&error=Could not save result');
