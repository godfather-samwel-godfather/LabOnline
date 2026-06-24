<?php

class adminContactAction
{

    private $contactRepository;


    public function __construct($contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }


    public function getMessages()
    {
        return $this->contactRepository->getAllMessages();
    }



    public function replyMessage($id, $reply)
    {

        if(empty($reply))
        {
            return false;
        }


        return $this->contactRepository
        ->updateReply($id, $reply);

    }

}

?>