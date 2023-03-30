<?php

namespace bot\lib;

use bot\Auth;

class User {

    public function __construct(int $user_id, int $peer_id) {
        $this->user_id = $user_id;
        $this->peer_id = $peer_id;
    }

    public function getInformation(string $fields) : array{
        return Request::call([
            'user_ids' => $this->user_id,
            'access_token' => Auth::TOKEN,
            'v' => '5.103',
            'fields' => $fields
        ], "users.get");
    }

    public function getFirstName() : string{
        return $this->getInformation("first_name")->first_name;
    }

    public function getLastName() : string {
        return $this->getInformation("last_name")->last_name;
    }

    public function getId() : int{
        return $this->user_id;
    }

    public function getPeerId() : int{
        return $this->peer_id;
    }

}
?>