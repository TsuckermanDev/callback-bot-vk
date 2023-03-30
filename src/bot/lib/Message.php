<?php

namespace bot\lib;

use bot\Constants;

class Message {
    
    public function __construct(string $text = "", array $attachment = []) {
        $this->text = $text;
        $this->attachment = $attachment;
    }
    
    public function setText(string $text) : void{
        $this->text = $text;
    }
    
    public function getText() : string{
        return $this->text;
    }

    public function addAttachment(Attachment $attachment) : void{
        $this->attachment[count($this->attachment)] = $attachment->toFormat();
    }

    public function getAttachment() : string{
        return implode(",", $this->attachment);
    }

    public function delAttachment(int $key) : void{
        unset($this->attachment[$key]);
    }
    
    public function send(int $peer_id) : void{
        Request::call([
            'message' => $this->getText(),
            'peer_id' => $peer_id,
            'access_token' => Constants::TOKEN,
            'v' => '5.103',
            'random_id' => '0',
            'attachment' => $this->getAttachment(),
            'disable_mentions' => "1"
        ], "messages.send");
    }
    
}
?>