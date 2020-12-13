<?php


class ApiTelSearch
{
    const API_KEY_LOCATION = "../.api_key_telsearch";
    private $_api_key;
    public function __construct()
    {
        $content = file_get_contents(self::API_KEY_LOCATION);
        if(strlen($content) > 0) {
            $this->_api_key = $content;
        }
    }
}