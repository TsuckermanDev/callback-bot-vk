<?php

namespace bot\lib\command;

use bot\lib\ReplyMessage;

class Command {

    public string $text;
    public string $name;
    public array $args;
    public int $conversation_id;
    public ?ReplyMessage $reply_message;
    public array $attachments;

    public function __construct(string $text, int $conversation_id, ?array $reply_message, array $attachments) {
        $this->text = $text;
        $this->name = explode(" ", $this->text)[0];
        $args = explode(" ", $this->text);
        unset($args[0]);
        $this->args = explode(" ", implode(" ", $args));
        unset($args);
        $this->conversation_id = $conversation_id;
        $this->reply_message = isset($reply_message) ? ReplyMessage::toObject($reply_message) : null;
        $this->attachments = [];
        foreach($attachments as $attachment) {
            array_push($this->attachments, \bot\lib\Attachment::toObject($attachment));
        }
    }

    public function getName() : string{
        return $this->name;
    }

    public function getReplyMessage() : ?ReplyMessage{
        return $this->reply_message;
    }

    public function getAttachments() : array{
        return $this->attachments;
    }



}
?>