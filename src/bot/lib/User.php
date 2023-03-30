<?php

namespace bot\lib;

use bot\Constants;

class User {

    public int $id;
    public int $peer_id;

    public function __construct(int $user_id = 0, int $peer_id = 0) {
        $this->user_id = $user_id;
        $this->peer_id = $peer_id;
        $this->information = Request::call([
            'user_ids' => $this->user_id,
            'access_token' => Constants::TOKEN,
            'v' => '5.131',
            'fields' => Constants::USER_FIELDS
        ], "users.get");
    }

    public function getFirstName() : string{
        return $this->information["first_name"];
    }

    public function getLastName() : string {
        return $this->information["last_name"];
    }

    public function getInformation() : array{
        return $this->information;
    }

    public function getId() : int{
        return $this->user_id;
    }

    public function getPeerId() : int{
        return $this->peer_id;
    }

}
?>