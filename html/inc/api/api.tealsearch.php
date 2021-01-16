<?php

class ApiTelSearch
{
    const API_KEY_LOCATION = "../.api_key_telsearch";
    private $_api_key;
    public function __construct()
    {
        $content = file_get_contents(self::API_KEY_LOCATION);
        if(strlen($content) > 0) {
            $this->_api_key = trim($content);
        }
    }


    public function insertAllVets(){
        // old key --> 343b8735ba6d3de3bd71269774e165f3
        // old key --> 7608ea265ec632dbb844da39a40dfa6e
        $map_url = "https://tel.search.ch/api/?was=v%C3%A9t%C3%A9rinaire&wo=valais&maxnum=200&key=04e22ef45a6535ce713a000d0550bae4&lang=fr";
        //$map_url =  "../../data.xml";

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
                $database = new Database();
                foreach ($data->entry as $entry){
                    $isVet = 0;

                    // contrôle si l'occupation du vétérinaire contient "vét"
                    if(is_int(strpos(strtoupper($entry->xpath('tel:occupation')[0]), "VéT"))){
                        $isVet = 1;
                    }

                    // contrôle si le titre du vétérinaire contient "vét"
                    if(is_int(strpos(strtoupper($entry->title), "VéT"))){
                        $isVet = 1;
                    }

                    if($isVet==0){
                        // contrôle si une des catégories du vétérinaire contient "vét"
                        $categories = $entry->xpath('tel:category');
                        for($i = 0; $i < sizeof($categories); $i++){
                            if(is_int(strpos(strtoupper($categories[$i]), "VéT"))){
                                $isVet = 1;
                            }
                        }
                    }

                    if($isVet==1){
                        //echo $entry->title."<br/><br/>";
                        $email = "--";
                        if(sizeof($entry->xpath("tel:extra[@type='email']"))>0) {
                            $email = rtrim(($entry->xpath("tel:extra[@type='email']")[0]), '*');
                        }
                        $database->insertVet($entry->title,$entry->xpath('tel:street')[0]." ".$entry->xpath('tel:streetno')[0],
                            $entry->xpath('tel:zip')[0]." ".$entry->xpath('tel:city')[0],$entry->xpath('tel:phone')[0],$email);
                    }
                }
            }
        }
    }
}