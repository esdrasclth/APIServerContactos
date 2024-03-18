<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once 'database.php';
    include_once 'contacto.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Contacto($db);
    
    // Verificar si se proporcionó un ID válido
    if(isset($_GET['nombre']) && $_GET['nombre'] != ""){
        $item->nombre = $_GET['nombre'];
        $stmt = $item->GetOneContact();
        $num = $stmt->rowCount();
    
        // Verificar si se encontró el usuario con el ID proporcionado
        if($num > 0){
            $contact_arr = array();
            $contact_arr["contacto"] = array();
    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
    
            $contacto_item = array(
                //"id" => $id,
                "nombre" => $nombre,
                "telefono" => $telefono,
                "latitud" => $latitud,
                "longitud" => $longitud
            );
    
            array_push($contact_arr["contacto"], $contacto_item);
    
            http_response_code(200);
            echo json_encode($contact_arr);
        }
        else{
            http_response_code(404);
            echo json_encode(
                array("message" => "No se encontró el usuario.")
            );
        }
    }
    else{
        http_response_code(400);
        echo json_encode(
            array("message" => "No se proporcionó un ID válido.")
        );
    }
    ?>