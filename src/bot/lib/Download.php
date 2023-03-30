<?php

namespace bot\lib;

use bot\Constants;

class Download {

    public function __construct(string $url = "", string $name = "") {
        $this->url = $url;
        $this->name = $name;
    }

    public function setURL(string $url) : void{
        $this->url = $url;
    }

    public function setName(string $name) : void{
        $this->name = $name;
    }

    public function get() : void{
        if(!file_exists(Constants::DOCS_DIRECTORY.$this->name)) file_put_contents(Constants::DOCS_DIRECTORY.$this->name, file_get_contents($this->url));
    }

}
?>