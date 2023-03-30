<?php

namespace bot\lib;

use bot\Constants;

class Request {

    public static function call(array $params, string $method, bool $array = false) {
        $curl = curl_init("https://api.vk.com/method/{$method}?". http_build_query($params));
        curl_setopt_array($curl, [
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 0,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1
        ]);
        $data = json_decode(curl_exec($curl), $array);
        curl_close($curl);
        return $data;
    }

    public static function upload(string $url, string $file) {
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => ['file' => new \CURLfile(Constants::DOCS_DIRECTORY.$file)]
        ]);
        $data = json_decode(curl_exec($curl), true);
        curl_close($curl);
        return $data;
    }

}
?>