<?php

namespace bot\command;

use bot\command\commands\ExampleCommand;

class CommandReader {

    public function __construct() {
        $this->commands = new CommandRegistrator();
        $this->commands->add("/cock", new ExampleCommand);
    }
    
    public function read(CommandSender $sender, Command $command) {
        if($this->commands->get($command->getName()) !== null) {
            $cmd = $this->commands->get($command->getName());
            $cmd->dispatch($sender, $command);
        }
    }
    
}
?>