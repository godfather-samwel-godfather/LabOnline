<?php

require_once __DIR__ . '/../../includes/bootstrap.php';


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

}



flashMessage("Payment completed successfully.", "success");


header("Location: ../../?page=view_appointments");
exit;