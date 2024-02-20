<?php
/**
 * @author Johan Santiago VR
 * @version 1.0
 * @created 31-oct-2022 04:28:23 p.m.
 */
class Usuario
{

	Private $Idusuarios;
	Private $Nombres;
	Private $Apellidos;
	Private $Email;
	private $Telefono;
	Private $Pasword;
	Private $img;
	Private $Rol;
	Private $Estado;
	private $Conexion;
	
	

	//Constructor
	public function Usuario()
	{
		
	}

	public function getIdusuario()
	{
		return $this->Idusuarios;
	}

	public function getNombres()
	{
		return $this->Nombres;
	}
	public function getApellidos()
	{
		return $this->Apellidos;
	}

	public function getEmail ()
	{
		return $this->Email ;
	}

	public function getTelefono()
	{
		return $this->Telefono;
	}

	private function getPasword()
	{
		return $this->Pasword;
	}
	private function getimg()
	{
		return $this->img;
	}

	public function getRol()
	{
		return $this->Rol;
	}
	public function getEstado()
	{
		return $this->Estado;
	}

	

	/**
	 * 
	 *
	 */
	public function setIdusuario($newVal)
	{
		$this->Idusuarios = $newVal;
	}

	/**
	 * 
	 *
	 */
	public function setNombres($newVal)
	{
		$this->Nombres = $newVal;
	}
	/**
	 * 
	 *
	 */
	public function setApellidos($newVal)
	{
		$this->Apellidos = $newVal;
	}

	/**
	 * 
	 * 
	 */
	public function setCorreo($newVal)
	{
		$this->Email  = $newVal;
	}

	/**
	 * 
	 * 
	 */
	public function setTelefono($newVal)
	{
		$this->Telefono = $newVal;
	}

	/**
	 * 
	 * 
	 */
	public function setPasword($newVal)
	{
		$this->Pasword = $newVal;
	}
	/**
	 * 
	 * 
	 */
	public function setimg($newVal)
	{
		$this->img = $newVal;
	}

	/**
	 * 
	 * 
	 */
	public function setRol($newVal)
	{
		$this->Rol = $newVal;
	}
	/**
	 * 
	 * 
	 */
	public function setEstado($newVal)
	{
		$this->Estado = $newVal;
	}

	
	

	public function crearUsuario($Idusuarios,$Nombres,$Apellidos,$Email,$Telefono,$Pasword,$img,$Rol,$Estado)
	{
		$this->Idusuarios=$Idusuarios;
		$this->Nombres=$Nombres;
		$this->Apellidos=$Apellidos;
		$this->Email=$Email;
		$this->Telefono=$Telefono;
		$this->Pasword=$Pasword ;
		$this->img=$img ;
		$this->Rol=$Rol;
		$this->Estado=$Estado;
		
	}
	
	public function agregarUsuario()
	{	
		$this->Conexion=Conectarse();
		$sql="insert into usuarios(Idusuarios, Nombres, Apellidos, Correo, Telefono, Pasword, Rol) 
values ('$this->Idusuarios','$this->Nombres','$this->Apellidos','$this->Email','$this->Telefono','$this->Pasword',$this->img','$this->Rol','$this->Estado')";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	
	}

	public function modificarUsuario($Idusuarios)
	{	
		$this->Conexion=Conectarse();
		$sql="update  set Idusuarios =$this->Idusuarios','$this->Nombres','$this->Apellidos','$this->Email','$this->Telefono','$this->Pasword',$this->img','$this->Rol','$this->Estado' where Idusuarios = '$this->Idusuarios";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	
		}

	public function eliminarUsuario($Idusuarios)
	{	
		$this->Conexion=Conectarse();
		$sql="delete from usuarios where Idusuarios = '$this->Idusuarios";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	
		}


	public function consultarUsuario()
	{
		$this->Conexion=Conectarse();
		$sql="select * from usuarios";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	
	}
	
	public function consultarUsuarioContraseña($Idusuarios, $Paswordmd5)
{
    $this->Conexion = Conectarse();
    
    // Preparar la consulta con parámetros
    $sql = "SELECT * FROM usuarios WHERE Idusuarios = ? AND Pasword = ?";
    $stmt = $this->Conexion->prepare($sql);
    
    // Verificar si la preparación de la consulta tuvo éxito
    if ($stmt === false) {
        // Manejar el error de preparación de la consulta
        die('Error en la preparación de la consulta: ' . $this->Conexion->error);
    }
    
    // Vincular parámetros con sus tipos de datos
    $stmt->bind_param("is", $Idusuarios, $Paswordmd5); // "i" para integer, "s" para string
    
    // Ejecutar la consulta
    $stmt->execute();
    
    // Obtener el resultado
    $resultado = $stmt->get_result();
    
    // Verificar si se encontró un usuario con las credenciales proporcionadas
    if ($resultado->num_rows > 0) {
        // Usuario autenticado correctamente
        return true;
    } else {
        // Usuario no autenticado
        return false;
    }
    
    // Cerrar el statement
    
    // No cerrar la conexión aquí si quieres seguir usándola fuera de esta función
}
// 	public function __construct()
// {
//     // Inicializar la conexión aquí, por ejemplo:
//     $this->conexion = new mysqli("localhost", "root", "", "digiworm");
//     if ($this->conexion->connect_error) {
//         die("Error de conexión: " . $this->conexion->connect_error);
//     }
// }
	
	
	}
	
	
	
	
	
?>