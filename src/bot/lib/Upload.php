<?php

namespace bot\lib;

use bot\Constants;

class Upload {

    public function __construct() {

    }

    public static function getUploadServer(int $peer_id) : string {
        return Request::call([
            "access_token" => Constants::TOKEN,
            "v" => "5.131",
            "type" => "doc",
            "peer_id" => $peer_id
        ], "docs.getMessagesUploadServer")->response->upload_url;
    }

    public static function document(string $file, int $peer_id, $delete = true) : ?Attachment{
        $server = self::getUploadServer($peer_id);

       $request = Request::call([
            "access_token" => Constants::TOKEN,
            "v" => "5.131",
            "file" => Request::upload($server, $file)["file"]
        ], "docs.save", true);
        if($delete) unlink(Constants::DOCS_DIRECTORY.$file);
        $attachment = new Attachment();
        $attachment->setType($request["response"]["type"]);
        $attachment->setId($request["response"][$attachment->getType()]["id"]);
        $attachment->setOwnerId($request["response"][$attachment->getType()]["owner_id"]);
        return $attachment;

    }

}
?>