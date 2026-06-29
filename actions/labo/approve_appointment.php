<?php
/**
 * Labo: approve test request (paid → approved)
 */

require_once __DIR__ . '/../../includes/action_bootstrap.php';

requireRole('labo');


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    redirect('../../labo/dashboard.php?page=test_requests&error=Invalid request');

}



$appointmentId = (int)($_POST['appointment_id'] ?? 0);

$labUserId = getCurrentUserId();



$labRepo = new LaboratoryRepository($conn);

$labId = $labRepo->getIdByUserId($labUserId);



if (!$labId || !$appointmentId) {

    redirect('../../labo/dashboard.php?page=test_requests&error=Invalid request');

}




// CHECK PAYMENT

// CHECK PAYMENT

$paymentRepo = new PaymentRepository($conn);

$payment = $paymentRepo->getByAppointmentId($appointmentId);


$paid = false;


// Normal payment
if ($payment && $payment['payment_status'] === 'paid') {

    $paid = true;

}



// Rebook payment check
if (
    !$paid &&
    $payment &&
    !empty($payment['reference_payment_id'])
) {


    $oldPayment = $paymentRepo->getById(
        (int)$payment['reference_payment_id']
    );


    if (
        $oldPayment &&
        $oldPayment['payment_status'] === 'paid'
    ) {

        $paid = true;

    }

}



if (!$paid) {

    redirect(
        '../../labo/dashboard.php?page=test_requests&error=Patient has not paid yet'
    );

}




// APPROVE APPOINTMENT

$appointmentRepo = new AppointmentRepository($conn);



if (
    $appointmentRepo->updateStatus(
        $appointmentId,
        'approved',
        $labUserId,
        'Appointment approved by laboratory'
    )
) {


    redirect(
        '../../labo/dashboard.php?page=test_requests&msg=Request approved successfully'
    );


}



redirect(
    '../../labo/dashboard.php?page=test_requests&error=Failed to approve request'
);