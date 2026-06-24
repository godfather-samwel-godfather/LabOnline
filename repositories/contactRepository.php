<?php
// contactRepository.php for handling database operations related to contact messages
class ContactRepository
{
    private $conn;


    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function saveContact($name, $email, $subject, $message)
    {

        $sql = "INSERT INTO contact_us
        (name, email, subject, message)
        VALUES (?, ?, ?, ?)";


        $stmt = $this->conn->prepare($sql);


        $stmt->bind_param(
            "ssss",
            $name,
            $email,
            $subject,
            $message
        );


        return $stmt->execute();
    }


// Get all messages for admin view for replying to messages
public function getAllMessages()
{

    $sql = "SELECT * FROM contact_us 
            ORDER BY created_at DESC";


    return $this->conn->query($sql);

}


// Update message with admin reply and set status to replied
public function updateReply($id, $reply)
{

    $sql = "UPDATE contact_us 
            SET reply = ?,
                status = 'replied',
                replied_at = NOW()
            WHERE id = ?";


    $stmt = $this->conn->prepare($sql);


    $stmt->bind_param(
        "si",
        $reply,
        $id
    );


    return $stmt->execute();

}
// Get messages by email for user view of message history
public function getMessagesByEmail($email)
{
    $sql = "SELECT * FROM contact_us 
            WHERE email = ?
            ORDER BY created_at DESC";

    $stmt = $this->conn->prepare($sql);

    $stmt->bind_param("s", $email);

    $stmt->execute();

    return $stmt->get_result();
}
}

?>