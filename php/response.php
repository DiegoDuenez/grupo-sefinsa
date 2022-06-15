<?php



function json($data, $status_code = 200){

    http_response_code($status_code);
    return json_encode($data);

}
