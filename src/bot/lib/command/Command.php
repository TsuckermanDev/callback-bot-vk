<?php

namespace bot\lib\command;

class Command {

    public function __construct(string $message, array $attachments) {
        $this->message = $message;
        $this->attachments = [];
        foreach($attachments as $attachment) {
            array_push($this->attachments, \bot\lib\Attachment::toObject($attachment));
        }
    }

    public function getName() : string{
        return explode(" ", $this->message)[0];
    }

    public function getArgs() : string{
        $msg = explode(" ", $this->message);
        unset($msg[0]);
        return explode(" ", implode(" ", $msg));
    }

    public function getMessage() : string{
        return $this->message;
    }

    public function getAttachments() : array{
        return $this->attachments;
    }

}
?>