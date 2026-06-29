<?php

require_once __DIR__ . '/../../includes/action_bootstrap.php';

requireRole('labo');



if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    redirect('../../labo/dashboard.php?page=test_requests&error=Invalid request');

}




$appointmentId = (int)($_POST['appointment_id'] ?? 0);


$reason = trim($_POST['reason'] ?? '');



if ($appointmentId <= 0) {

    redirect('../../labo/dashboard.php?page=test_requests&error=Invalid appointment');

}



if ($reason === '') {

    $reason = "Request rejected by laboratory";

}




$appointmentRepo = new AppointmentRepository($conn);



$result = $appointmentRepo->updateStatus(

    $appointmentId,

    'rejected',

    getCurrentUserId(),

    $reason

);





if ($result) {


    redirect(
        '../../labo/dashboard.php?page=test_requests&msg=Request rejected successfully'
    );


}





redirect(
    '../../labo/dashboard.php?page=test_requests&error=Failed to reject request'
);

?>