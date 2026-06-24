<?php

// 1. Njia sahihi ya kuelekea bootstrap (tunarudi nyuma mara moja tu tukiwa ndani ya admin/)
require_once __DIR__ . '/../../includes/bootstrap.php';

$contactRepository = new ContactRepository($conn);
$contactAction = new ContactAction($contactRepository);

if(isset($_POST['send_reply']))
{
    // 2. Tunapitisha $_POST yote kwenda kwenye method sahihi: replyContact()
    $result = $contactAction->replyContact($_POST);

    if($result)
    {
        // 3. Baada ya kufanikiwa, mrudishe admin kwenye ile dashboard layout yenye page ya ujumbe
        header("Location: ../dashboard.php?page=contact_messages&success=1");
        exit();
    }
    else 
    {
        // Kama imefeli kwa sababu yoyote
        header("Location: ../dashboard.php?page=contact_messages&error=1");
        exit();
    }
}
else 
{
    // Kama mtu ameingia bila kubonyeza button
    header("Location: ../dashboard.php?page=contact_messages");
    exit();
}

?>