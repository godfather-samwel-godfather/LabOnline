<?php

require_once __DIR__ . '/includes/bootstrap.php';


$contactRepository = new ContactRepository($conn);


$contactAction = new ContactAction($contactRepository);



if(isset($_POST['send_message']))
{


    $result = $contactAction
    ->sendMessage($_POST);



    if($result)
    {

        header("Location: contact_us.php?success=1");
        exit();

    }
    else
    {

        header("Location: contact_us.php?error=1");
        exit();

    }

}

?>