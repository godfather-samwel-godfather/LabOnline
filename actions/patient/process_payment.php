<?php

require_once __DIR__ . '/../../includes/bootstrap.php';
require_once __DIR__ . '/../../services/PaymentService.php';


$appointmentId = $_GET['id'] ?? null;


if (!$appointmentId) {

    flashMessage("Invalid appointment.", "danger");

    header("Location: ../../?page=view_appointments");
    exit;

}


$paymentRepo = new PaymentRepository($conn);
$appointmentRepo = new AppointmentRepository($conn);


$appointment = $appointmentRepo->getById((int)$appointmentId);


if (!$appointment) {

    flashMessage("Appointment not found.", "danger");

    header("Location: ../../?page=view_appointments");
    exit;

}



$payment = $paymentRepo->getByAppointmentId((int)$appointmentId);
// Hakikisha appointment ina payment record kabla ya kuendelea
if (!$payment) {

    flashMessage(
        "Payment record not found.",
        "danger"
    );

    header("Location: ../../?page=view_appointments");
    exit;

}


// Check if payment already exists for this appointment
if (
    $payment &&
    !empty($payment['reference_payment_id'])
) {

    $sql = "SELECT payment_status
            FROM payments
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "i",
        $payment['reference_payment_id']
    );

    $stmt->execute();

    $oldPayment = $stmt->get_result()->fetch_assoc();

    if (
        $oldPayment &&
        $oldPayment['payment_status'] === 'paid'
    ) {

        $paymentRepo->updateStatus(
            (int)$appointmentId,
            'paid'
        );

        flashMessage(
            "Previous payment has been reused successfully.",
            "success"
        );

        header("Location: ../../?page=view_appointments");
        exit;
    }
}


/*Simulate payment process ilikuwa mwanzo kwasababu tulikuwa hatuna payment gateway ya kweli.
 Hapa chini ni code ya simulation ya payment process ambayo kwasasa  mpesa ndiyo itaamua .
if ($payment) {

    $paymentRepo->updateStatus(
        (int)$appointmentId,
        'paid'
    );


} else {


    $paymentRepo->create([

        'appointment_id' => $appointmentId,
        'amount' => 50000,
        'payment_method' => 'Simulation',
        'payment_status' => 'paid',
        'transaction_id' => 'TXN-' . time()

    ]);

}*/
// Process payment through Mock Mpesa API


// Create an instance of PaymentService used to process the payment todecide 
// if the payment is successful or not and update the payment status accordingly.
$paymentService = new PaymentService($conn);


$result = $paymentService->processPayment(
    $payment['id']
);



if ($result['success']) {


    flashMessage(
        "Payment completed successfully.",
        "success"
    );


} else {


    flashMessage(
        $result['message'],
        "danger"
    );

}



header("Location: ../../?page=view_appointments");
exit;