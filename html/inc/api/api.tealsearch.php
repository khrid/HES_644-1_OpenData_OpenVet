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


    public function insertAllVets(){
        $map_url_old = "https://tel.search.ch/api/?was=v%C3%A9t%C3%A9rinaire&wo=valais&maxnum=200&key=".$this->_api_key; // does not work
        $map_url = "https://tel.search.ch/api/?was=v%C3%A9t%C3%A9rinaire&wo=valais&maxnum=200&key=343b8735ba6d3de3bd71269774e165f3";

        if (($response_xml_data = file_get_contents($map_url))===false){
            echo "Error fetching XML\n";
        } else {
            libxml_use_internal_errors(true);
            $data = new SimpleXMLElement($response_xml_data);
            if (!$data) {
                echo "Error loading XML\n";
                foreach(libxml_get_errors() as $error) {
                    echo "\t", $error->message;
                }
            } else {
                //print_r($data);
                $database = new Database();
                foreach ($data->entry as $entry){
                    $database->insertVet($entry->title,"");
                }
            }
        }
    }
}