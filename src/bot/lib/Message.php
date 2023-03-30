<?php

namespace bot\lib;

class Message {

    public int $peer_id;
    public string $text;
    public int $reply_to; // conversation message id
    public array $attachment;
    
    public function __construct(int $peer_id, string $text, int $reply_to = 0, array $attachment = []) {
        $this->peer_id = $peer_id;
        $this->text = $text;
        $this->reply_to = $reply_to;
	    $this->attachment = $attachment;
    }

    public function addAttachment(Attachment $attachment) : void{
        $this->attachment[count($this->attachment)] = (string) $attachment;
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
            'forward' => json_encode([
                'peer_id' => $this->peer_id,
                'conversation_message_ids' => $this->reply_to,
                'is_reply' => '1'
            ]),
            'attachment' => implode(',', $this->attachment),
            'disable_mentions' => "1"
        ], "messages.send");
    }
    
}
?>