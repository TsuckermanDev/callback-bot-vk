<?php

namespace bot\lib\command;

class CommandHandler {

    public function __construct() {
        $this->commands = [];
    }

    public function add(string $command, SimpleCommand $class) : void{
        $this->commands[$command] = $class;
    }

    public function del(string $command) : void{
        unset($this->commands);
    }

    public function get(string $command) : ?SimpleCommand{
        if(!array_key_exists($command, $this->commands)) return null;
        return $this->commands[$command];
    }

}
?>