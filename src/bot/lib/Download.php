<?php

namespace bot\lib;

use bot\Constants;

class Download {

    public string $url;
    public string $name;

    public function __construct(string $url, string $name) {
        $this->url = $url;
        $this->name = $name;
        if(!file_exists(Constants::DOCS_DIRECTORY.$this->name)) file_put_contents(Constants::DOCS_DIRECTORY.$this->name, file_get_contents($this->url));
    }

}
?>