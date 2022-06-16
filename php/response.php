<?php



function json($data, $status_code = 200){

    http_response_code($status_code);
    return json_encode($data);

}


function notDefine(){
    $_DATA = json_decode(file_get_contents('php://input'), true);
    $func = $_DATA['func'];
    http_response_code(404);
    $data = [
        "status"=>"error",
        "data"=>[],
        "message"=> "La funcion $func no esta definida"
    ];
    return json_encode($data);
}

function abort($status_code, $message){
    if($status_code >= 400 && $status_code >= 599){
        http_response_code($status_code);
        return json_encode(['status'=>'abort', 'message'=>$message]);
        die();
    }
    else{
        http_response_code(400);
        return json_encode(['status'=>'abort', 'message'=>$message]);
        die();
    }
    
}