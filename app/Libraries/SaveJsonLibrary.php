<?php 

namespace App\Libraries;

Class SaveJsonLibrary
{
    public function __construct()
    {
        // Constructor code here if needed
    }

    public function saveJson($filename, $data)
    {
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($filename, $jsonData);
    }
}


?>