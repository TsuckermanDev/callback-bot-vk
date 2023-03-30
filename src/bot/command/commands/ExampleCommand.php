<?php

namespace bot\command\commands;

use bot\command\{CommandSender, Command, SimpleCommand};

class ExampleCommand extends SimpleCommand{
    
    public function __construct() {
    }
    
    public function dispatch(CommandSender $sender, Command $command) {
        $message = new \bot\lib\Message("цукерман не лох");
	foreach($command->getAttachments() as $key) {
            $attachment = new \bot\lib\Attachment();
            $attachment->setType($key["type"]);
            $attachment->setOwnerId($key[$attachment->getType()]["owner_id"]);
            $attachment->setId($key[$attachment->getType()]["id"]);
            if(array_key_exists("access_key", $key[$attachment->getType()])) $attachment->setAccessKey($key[$attachment->getType()]["access_key"]);
            if($attachment->getType() !== "doc") $message->addAttachment($attachment);
            if($attachment->getType() === "doc") {
                $download = new \bot\lib\Download($key[$attachment->getType()]["url"], $key[$attachment->getType()]["title"]);
                $download->get();
                $attachment = \bot\lib\Upload::document($key[$attachment->getType()]["title"], $sender->getPeerId());
                $message->addAttachment($attachment);
            }
        }
        $message->send($sender->getPeerId());
    }
    
}
?>