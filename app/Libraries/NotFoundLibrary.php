<?php

namespace App\Libraries;


Class NotFoundLibrary
{
    public function __construct()
    {
        // Constructor code here if needed
    }

    public function notFound($message = 'Not Found')
    {
        http_response_code(404);
        echo json_encode(['error' => $message]);
        exit;
    }
}


?>