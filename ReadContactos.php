<?php
header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: GET");


include_once 'Database.php';
include_once 'contacto.php';


$database = new Database();
$instancia = $database->getConnection();

$item = new Contacto($instancia);

$resp = $item->GetContactos();


if($resp->rowCount()>0)
{
   $Contactarray = array();
   while($fila = $resp->fetch(PDO::FETCH_ASSOC) ){
    extract($fila);
    $e=array("id" => $id,
             "nombre" => $nombre,
             "telefono" => $telefono,
             "latitud" => $latitud,
             "longitud" => $longitud,
             "imagen" => $imagen);

             array_push($Contactarray,$e);
   }
   $response = array("datos" => $Contactarray);
   echo json_encode($response);

}else{
    
    echo json_encode(array("message" => "No hay datos"));
}




?>