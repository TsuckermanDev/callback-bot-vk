<?php

namespace bot\lib\command;

use bot\commands\ExampleCommand;

class CommandReader {

    public CommandHandler $commands; // for registration in our classes

    public function __construct() {
        $this->commands = new CommandHandler();
        $this->commands->add("/example", new ExampleCommand);
    }
    
    public function read(CommandSender $sender, Command $command) {
        if($this->commands->get($command->getName()) !== null) $this->commands->get($command->getName())->dispatch($sender, $command);
    }
    
}
?>