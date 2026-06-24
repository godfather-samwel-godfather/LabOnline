<?php

require_once __DIR__ . '/../../includes/bootstrap.php';


$contactRepository = new ContactRepository($conn);

$contactAction = new ContactAction($contactRepository);


$messagesResults = $contactAction->getAllMessages();

?>


<!DOCTYPE html>
<html>

<head>
    <title>Contact Messages</title>
</head>

<body>


    <h2>Contact Messages</h2>



    <?php while($row = $messagesResults->fetch_assoc()){ ?>


    <div>


        <h4>
            <?= $row['name']; ?>
        </h4>


        <p>
            Email:
            <?= $row['email']; ?>
        </p>


        <p>
            Subject:
            <?= $row['subject']; ?>
        </p>


        <p>
            Message:
            <?= $row['message']; ?>
        </p>



        <p>
            Status:
            <?= $row['status']; ?>
        </p>



        <form action="reply_contact.php" method="POST">


            <input type="hidden" name="id" value="<?= $row['id']; ?>">



            <textarea name="reply" placeholder="Write reply" required></textarea>


            <br>


            <button type="submit" name="send_reply">
                Send Reply
            </button>


        </form>


        <hr>


    </div>


    <?php } ?>


</body>

</html>