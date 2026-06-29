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



$appointmentRepo = new AppointmentRepository($conn);





// REBOOK SECURITY

$rebookId = (int)($_POST['rebook_id'] ?? 0);



if($rebookId > 0){


    $oldAppointment = $appointmentRepo->getById($rebookId);



    if(!$oldAppointment){


        redirect(
            '../../patient/dashboard.php?page=create_appointment&error=Invalid rebook appointment'
        );


    }



    // tumia laboratory ya zamani

    $laboratoryId = (int)$oldAppointment['laboratory_id'];



    // tumia tests za zamani kutoka database

    $testIds = $appointmentRepo->getTestsByAppointmentId($rebookId);



}





// validate collection

if (!in_array($sampleCollection,['home','lab'],true)) {

    $sampleCollection='lab';

}





// validate priority

if (!in_array($priority,['normal','urgent'],true)) {

    $priority='normal';

}





if(!$laboratoryId || !$appointmentDate || !$appointmentTime || empty($testIds)){


    redirect(
        '../../patient/dashboard.php?page=create_appointment&error=Please fill all required fields and select at least one test'
    );


}






if($sampleCollection === 'home' && $address === ''){


    redirect(
        '../../patient/dashboard.php?page=create_appointment&error=Address is required for home collection'
    );


}







try {



    $appointmentId = $appointmentRepo->create([


        'rebooked_from_id' => $rebookId ?: null,


        'patient_id' => $patientId,


        'doctor_id' => $doctorId,


        'laboratory_id' => $laboratoryId,


        'appointment_date' => $appointmentDate,


        'appointment_time' => $appointmentTime,


        'sample_collection' => $sampleCollection,


        'address' => $address !== '' ? $address : null,


        'priority' => $priority,


        'notes' => $notes !== '' ? $notes : null



    ], $testIds);









    // PAYMENT

    $paymentRepo = new PaymentRepository($conn);



    $oldPayment = null;


    $newPaymentStatus = 'pending';





    if($rebookId > 0){



        $oldPayment = $paymentRepo->getByAppointmentId($rebookId);



        if(
            $oldPayment &&
            $oldPayment['payment_status'] === 'paid'
        ){


            $newPaymentStatus = 'paid';


        }


    }







    // CREATE PAYMENT RECORD


    $paymentRepo->create([



        'appointment_id' => $appointmentId,



        'reference_payment_id' => $oldPayment['id'] ?? null,



        'amount' => 50000,



        'payment_method' => $oldPayment['payment_method'] ?? null,



        'payment_status' => $newPaymentStatus,



        'transaction_id' => $oldPayment['transaction_id'] ?? null



    ]);








    redirect(
        '../../patient/dashboard.php?page=view_appointments&msg=Appointment booked successfully'
    );






}
catch(Throwable $e){



    redirect(
        '../../patient/dashboard.php?page=create_appointment&error=Could not create appointment. Please try again.'
    );


}