<?php

require_once __DIR__ . '/../../includes/bootstrap.php';


// Hakikisha labo amelogin
if (!isset($_SESSION['user_id'])) {

    header("Location: ../../auth/login.php");
    exit;

}



$appointmentId = (int)($_POST['appointment_id'] ?? 0);


$reason = trim($_POST['reason'] ?? '');



if ($appointmentId <= 0) {


    header("Location: ../../labo/dashboard.php?page=test_requests&error=Invalid request");

    exit;

}



if ($reason === '') {


    $reason = "Request rejected by laboratory";

}




$appointmentRepo = new AppointmentRepository($conn);



$result = $appointmentRepo->updateStatus(

    $appointmentId,

    'rejected',

    $_SESSION['user_id'],

    $reason

);





if ($result) {


    header(
        "Location: ../../labo/dashboard.php?page=test_requests&msg=Request rejected successfully"
    );


    exit;


}





header(

    "Location: ../../labo/dashboard.php?page=test_requests&error=Failed to reject request"

);


exit;

?>