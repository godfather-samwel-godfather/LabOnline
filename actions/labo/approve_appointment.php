<?php
/**
 * Labo: idhinisha ombi la vipimo (pending → approved).
 */

require_once __DIR__ . '/../../includes/action_bootstrap.php';

requireRole('labo');


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    redirect('../../labo/dashboard.php?page=test_requests&error=Invalid request');

}



$appointmentId = (int) ($_POST['appointment_id'] ?? 0);

$labUserId = getCurrentUserId();



$labRepo = new LaboratoryRepository($conn);

$labId = $labRepo->getIdByUserId($labUserId);



if (!$labId || !$appointmentId) {

    redirect('../../labo/dashboard.php?page=test_requests&error=Invalid request');

}




// CHECK PAYMENT FIRST

$paymentRepo = new PaymentRepository($conn);


$payment = $paymentRepo->getByAppointmentId($appointmentId);



if (!$payment || $payment['payment_status'] !== 'paid') {


    redirect(
        '../../labo/dashboard.php?page=test_requests&error=Patient has not paid yet'
    );


}




// NOW APPROVE

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
        '../../labo/dashboard.php?page=test_requests&msg=Request approved'
    );


}



redirect(
    '../../labo/dashboard.php?page=test_requests&error=Could not approve request'
);