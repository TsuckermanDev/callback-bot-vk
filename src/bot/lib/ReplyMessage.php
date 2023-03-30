<?php

namespace bot\lib;

class ReplyMessage {

    public User $reply_user;
    public int $conversation_id;
    public string $text;
    public array $attachments;

    public function __construct(int $peer_id, int $user_id, int $conversation_id, string $text, array $attachments = []) {
        $this->reply_user = new User($user_id, $peer_id);
        $this->conversation_id = $conversation_id;
        $this->text = $text;
        $this->attachments = [];
        foreach($attachments as $attachment) {
            array_push($this->attachments, Attachment::toObject($attachment));
        }
    }

    public function getReplyUser() : User{
        return $this->reply_user;
    }

    public function getAttachments() : array{
        return $this->attachments;
    }

    public static function toObject(array $reply_message) : self{
        return new self($reply_message["peer_id"], $reply_message["from_id"], $reply_message["conversation_message_id"], $reply_message["text"], $reply_message["attachments"]);
    }

}
?>