<!-- Contact Action Class -->
<?php

class ContactAction
{
    private $contactRepository;

    public function __construct($contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function sendMessage($data)
    {
        $name = trim($data['name']);
        $email = trim($data['email']);
        $subject = trim($data['subject']);
        $message = trim($data['message']);

        if(empty($name) || empty($email) || empty($message))
        {
            return false;
        }

        return $this->contactRepository->saveContact(
            $name,
            $email,
            $subject,
            $message
        );
    }
    
    // For admin to get all messages
    public function getAllMessages()
    {
        return $this->contactRepository->getAllMessages();
    }

    /**
     * Method mpya ya kuchakata jibu la admin na kulisukuma kwenye repository
     */
    public function replyContact($data)
    {
        // 1. Hakikisha ID ipo na ni namba kamili (integer)
        $id = isset($data['id']) ? intval($data['id']) : 0;
        
        // 2. Safisha matini ya jibu (reply message)
        $reply = isset($data['reply']) ? trim($data['reply']) : '';

        // 3. Kama vigezo vikuu havipo, kataa katakata
        if(empty($id) || empty($reply))
        {
            return false;
        }

        // 4. Sukuma mzigo kwenda kwenye Repository kusasisha database
        return $this->contactRepository->updateReply($id, $reply);
    }


    // Get messages for logged in user in contact us page for displaying message history
public function getUserMessages($email)
{
    $result = $this->contactRepository->getMessagesByEmail($email);

    $messages = [];

    while($row = $result->fetch_assoc())
    {
        $messages[] = $row;
    }

    return $messages;
}
}

?>