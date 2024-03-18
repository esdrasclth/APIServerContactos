<?php
header("Access-Control-Allow-Origin: *"); 

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: POST");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//permitir solo el meto http postipconfig

include_once 'Database.php';
include_once 'contacto.php';

$database = new Database();
$db = $database->getConnection();

$item = new Contacto($db);
$data = json_decode(file_get_contents("php://input"));



if(isset($data)){
$item->nombre = $data->nombre;
$item->telefono = $data->telefono;
$item->latitud = $data->latitud;
$item->longitud = $data->longitud;
$item->imagen = $data->imagen;


if($item->createContacto()){
    echo json_encode(array("message" => " Contacto creado"));
}
else{
    echo json_encode(array("message" => "Contacto no creado"));
}
}else{
    echo json_encode(array("message" => "No hay datos"));
}


?>
