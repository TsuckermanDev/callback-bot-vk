<?php

namespace bot\lib;

class Message {

    public int $peer_id;
    public string $text;
    public array $attachment;
    
    public function __construct(int $peer_id = 0, string $text = "", array $attachment = []) {
        $this->peer_id = $peer_id;
        $this->text = $text;
	$this->attachment = $attachment;
    }

    public function addAttachment(Attachment $attachment) : void{
        $this->attachment[count($this->attachment)] = $attachment->toString();
    }

    public function delAttachment(int $key) : void{
        unset($this->attachment[$key]);
    }
    
    public function send() : void{
        Request::call([
            'message' => $this->text,
            'peer_id' => $this->peer_id,
            'access_token' => \bot\Constants::TOKEN,
            'v' => '5.131',
            'random_id' => '0',
            'attachment' => implode(",", $this->attachment),
            'disable_mentions' => "1"
        ], "messages.send");
    }
    
}
?>