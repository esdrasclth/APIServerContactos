<?php
class Contacto{

private $con;

//tabla 
public $table = "contactos";


//campos

public $id;
public $nombre;
public $telefono;
public $longitud;
public $latitud;
public $imagen;


public function __construct($db)
	{
		$this->con = $db;
	}



    // Crear los metodos crud para los microservicios
    // Create
    public function createContacto()
    {
    	$consulta = "INSERT into " . $this->table .
    				" SET  
    				nombre   = :nombre,
    				telefono = :telefono,
    				latitud  = :latitud,
    				longitud	  =:longitud,
                    imagen	  =:imagen";

      
    	$comando = $this->con->prepare($consulta);
        
        // Limpieza
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->latitud = htmlspecialchars(strip_tags($this->latitud));
        $this->longitud = htmlspecialchars(strip_tags($this->longitud));
        $this->imagen = htmlspecialchars(strip_tags($this->imagen));
		

        // paso de parametros
		$comando->bindParam(":nombre", $this->nombre);
		$comando->bindParam(":telefono", $this->telefono);
		$comando->bindParam(":latitud", $this->latitud);
		$comando->bindParam(":longitud", $this->longitud);
        $comando->bindParam(":imagen", $this->imagen);

		if($comando->execute())
		{
			return true;
		}
		return false;
    }

    // Read lista completa
    public function GetContactos()
    {
    	$sql = "SELECT id, nombre, telefono, latitud, longitud, imagen FROM " .$this->table . "";
    	$stmt = $this->con->prepare($sql);
    	$stmt->execute();

    	return $stmt;
    }

    // Read un Alumno
    public function GetOneContact()
{
    $sql = "SELECT  nombre, telefono,latitud,longitud, imagen FROM " . $this->table . " WHERE nombre = ?";

    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(1, $this->nombre);
    $stmt->execute();

    return $stmt;
}

    public function  updateContacto()
    {
    	$consulta = "UPDATE " . $this->table .
                    " SET  
                    nombre   = :nombre,
                    telefono = :telefono,
                    latitud  = :latitud,
                    longitud =:longitud,
                    imagen =:imagen
                    WHERE id =  :id";

    	$comando = $this->con->prepare($consulta);
        
        // Limpieza
		$this->id = htmlspecialchars(strip_tags($this->id));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->latitud = htmlspecialchars(strip_tags($this->latitud));
        $this->longitud = htmlspecialchars(strip_tags($this->longitud));
        $this->imagen = htmlspecialchars(strip_tags($this->imagen));
		

        // paso de parametros
		$comando->bindParam(":id", $this->id);
		$comando->bindParam(":nombre", $this->nombre);
		$comando->bindParam(":telefono", $this->telefono);
		$comando->bindParam(":latitud", $this->latitud);
		$comando->bindParam(":longitud", $this->longitud);
        $comando->bindParam(":imagen", $this->imagen);


		if($comando->execute())
		{
			return true;
		}
		return false;
    }

    Function deleteContacto()
{
    $query = "DELETE FROM " . $this->table . " WHERE id = :id";

    $stmt = $this->con->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(":id", $this->id);

    if($stmt->execute()){
        return true;
    }
    else{
        return false;
    }
}
}

?>
