<?php

namespace bot\lib;

class Attachment {

    public function __construct(array $attachment = []) {
        $this->attachment = $attachment;
    }

    public function getType() : string{
        return $this->attachment["type"];
    }

    public function getOwnerId() : int{
        return $this->attachment[$this->getType()]["owner_id"];
    }

    public function getId() : int{
        return $this->attachment[$this->getType()]["id"];
    }

    public function getAccessKey() : string{
        return $this->attachment[$this->getType()]["access_key"];
    }

    public function setType(string $type) : void{
        $this->attachment["type"] = $type;
        $this->attachment[$type] = [];
    }

    public function setOwnerId(int $owner_id) : void{
        $this->attachment[$this->getType()]["owner_id"] = $owner_id;
    }

    public function setId(int $id) : void{
        $this->attachment[$this->getType()]["id"] = $id;
    }

    public function setAccessKey(string $access_key) : void{
        $this->attachment[$this->getType()]["access_key"] = $access_key;
    }

    public function toFormat() : string{
        switch($this->getType()) {
            case "audio":
            case "doc":
                return "{$this->getType()}{$this->getOwnerId()}_{$this->getId()}";
            break;
            case "video":
            case "photo":
                return "{$this->getType()}{$this->getOwnerId()}_{$this->getId()}_{$this->getAccessKey()}";
            break;
            default:
                return "";
            break;
        }
    }

}
?>