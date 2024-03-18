<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once 'Database.php';
    include_once 'contacto.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Contacto($db);

    $id = $_GET['id'];

    $item->id = $id;

    if($item->deleteContacto()){
        echo "Contacto eliminado.";
    } else{
        echo "Contacto no eliminado";
    }
?>