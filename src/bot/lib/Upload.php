<?php

namespace bot\lib;

use bot\Constants;

class Upload {

    public function __construct() {

    }

    public static function document(string $file, int $peer_id, $delete = false) : ?Attachment{
        $request = Request::call([
            "access_token" => Constants::TOKEN,
            "v" => "5.131",
            "file" => Request::upload(Request::call([
            "access_token" => Constants::TOKEN,
            "v" => "5.131",
            "type" => "doc",
            "peer_id" => $peer_id
        ], "docs.getMessagesUploadServer")["response"]["upload_url"], $file)["file"]
        ], "docs.save");
        if($delete) unlink(Constants::DOCS_DIRECTORY.$file);
        return new Attachment("doc", $request["response"]["doc"]["id"], $request["response"]["doc"]["owner_id"]);

    }

}
?>