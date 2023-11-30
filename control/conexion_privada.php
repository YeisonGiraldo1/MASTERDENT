<?php
$dataBase="(\"localhost\",\"root\",\"\",\"u638142989_MasterdentDB\")";

class conexion
{
	private $servidor;
	private $usuario;
	private $contrasena;
	private $basedatos;
	public  $conexion;

	public function __construct(){
		$this->servidor   = "localhost";
		$this->usuario	  = "root";
		$this->contrasena = "";
		$this->basedatos  = "u638142989_MasterdentDB";
	}

	function conectar()
    {
        try {
            $this->conexion = new PDO("mysql:host=$this->servidor;dbname=$this->basedatos", $this->usuario, $this->contrasena);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Conexión exitosa a la base de datos";
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
	function cerrar(){
		
	}


	   // Nuevo método para preparar consultas
	   function prepararConsulta($sql)
	   {
		   return $this->conexion->prepare($sql);
	   }
}
?>
