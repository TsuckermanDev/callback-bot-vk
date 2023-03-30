<?php

namespace bot\lib;

class Attachment {

    public string $type;
    public int $id;
    public int $owner_id;
    public ?string $access_key;
    public ?string $title;
    public ?string $url;

    public function __construct(string $type, int $id, int $owner_id, ?string $access_key = null, ?string $title = null, ?string $url = null) {
        $this->type = $type;
        $this->id = $id;
        $this->owner_id = $owner_id;
        $this->access_key = $access_key;
        $this->title = $title;
        $this->url = $url;
    }

    public function __toString() : string{
        return isset($this->access_key) ? "{$this->type}{$this->owner_id}_{$this->id}_{$this->access_key}" : "{$this->type}{$this->owner_id}_{$this->id}";
    }

    public static function toObject(array $attachment) : self{
        $type = $attachment["type"];
        return new self($type, $attachment[$type]["id"], $attachment[$type]["owner_id"], array_key_exists("access_key", $attachment[$type]) ? $attachment[$type]["access_key"] : null, array_key_exists("title", $attachment[$type]) ? $attachment[$type]["title"] : null, array_key_exists("url", $attachment[$type]) ? $attachment[$type]["url"] : null);
    }

}
?>