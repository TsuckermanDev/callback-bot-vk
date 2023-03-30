<?php

namespace bot\command;

class Command {

    public function __construct(string $message, array $attachments) {
        $this->message = $message;
        $this->attachments = $attachments;
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