<?php

namespace bot\commands;

use bot\lib\command\{CommandSender, Command, SimpleCommand};

class ExampleCommand extends SimpleCommand{
    
    public function __construct() {
    }
    
    public function dispatch(CommandSender $sender, Command $command) {
        $message = new \bot\lib\Message($sender->getPeerId(), "цукерман не лох");
            $doc = 0;
	    foreach($command->getAttachments() as $key => $attachment) {
            if($attachment->type !== "doc") $message->addAttachment($attachment);
            if($attachment->type === "doc") {
                if($doc === 0){
                    $download = new \bot\lib\Download($attachment->url, $attachment->title);
                    $download->get();
                    $attachment = \bot\lib\Upload::document($attachment->title, $sender->getPeerId(), true);
                    $message->addAttachment($attachment);
                    $doc = 1;
                    $message->text = "бот отправил только один файл, чтобы не ломать VK API. TODO: fix";
                }
            }
        }
        $message->send();
    }
    
}
?>