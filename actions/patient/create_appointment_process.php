<?php
/**
 * Patient: unda appointment mpya + vipimo.
 */
require_once __DIR__ . '/../../includes/action_bootstrap.php';
requireRole('patient');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../../patient/dashboard.php?page=create_appointment&error=Invalid request');
}

$patientId = getCurrentUserId();
$laboratoryId = (int) ($_POST['laboratory_id'] ?? 0);
$doctorId = !empty($_POST['doctor_id']) ? (int) $_POST['doctor_id'] : null;
$appointmentDate = trim($_POST['appointment_date'] ?? '');
$appointmentTime = trim($_POST['appointment_time'] ?? '');
$sampleCollection = $_POST['sample_collection'] ?? 'lab';
$address = trim($_POST['address'] ?? '');
$priority = $_POST['priority'] ?? 'normal';
$notes = trim($_POST['notes'] ?? '');
$testIds = $_POST['test_ids'] ?? [];

// sample_collection: home au lab
if (!in_array($sampleCollection, ['home', 'lab'], true)) {
    $sampleCollection = 'lab';
}

if (!in_array($priority, ['normal', 'urgent'], true)) {
    $priority = 'normal';
}

if (!$laboratoryId || !$appointmentDate || !$appointmentTime || empty($testIds)) {
    redirect('../../patient/dashboard.php?page=create_appointment&error=Please fill all required fields and select at least one test');
}

if ($sampleCollection === 'home' && $address === '') {
    redirect('../../patient/dashboard.php?page=create_appointment&error=Address is required for home collection');
}

$appointmentRepo = new AppointmentRepository($conn);

try {
    $appointmentRepo->create([
        'patient_id'         => $patientId,
        'doctor_id'          => $doctorId,
        'laboratory_id'      => $laboratoryId,
        'appointment_date'   => $appointmentDate,
        'appointment_time'   => $appointmentTime,
        'sample_collection'  => $sampleCollection,
        'address'            => $address !== '' ? $address : null,
        'priority'           => $priority,
        'notes'              => $notes !== '' ? $notes : null,
    ], $testIds);

    redirect('../../patient/dashboard.php?page=view_appointments&msg=Appointment booked successfully');
} catch (Throwable $e) {
    redirect('../../patient/dashboard.php?page=create_appointment&error=Could not create appointment. Please try again.');
}
