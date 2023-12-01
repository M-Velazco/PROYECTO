<?php
/**
 * @author Johan Santiago VR
 * @version 1.0
 * @created 31-oct-2022 04:28:23 p.m.
 */
class Usuario
{

	Private $Idusuarios;
	Private $Nombre_apellido;
	Private $Correo;
	private $Telefono;
	Private $Contraseña;
	Private $Rol;
	private $conexion;
	
	

	//Constructor
	public function Usuario()
	{
		
	}

	public function getIdusuario()
	{
		return $this->Idusuarios;
	}

	public function getNombre_apellido()
	{
		return $this->Nombre_apellido;
	}

	public function getCorreo()
	{
		return $this->Correo;
	}

	public function getTelefono()
	{
		return $this->Telefono;
	}

	private function getContraseña()
	{
		return $this->Contraseña;
	}

	public function getRol()
	{
		return $this->Rol;
	}

	

	/**
	 * 
	 * @param newVal
	 */
	public function setIdusuario($newVal)
	{
		$this->Idusuarios = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setNombre_apellido($newVal)
	{
		$this->Nombre_apellido = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setCorreo($newVal)
	{
		$this->Correo = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setTelefono($newVal)
	{
		$this->Telefono = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setContraseña($newVal)
	{
		$this->Contraseña = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setRol($newVal)
	{
		$this->Rol = $newVal;
	}

	
	

	public function crearUsuario($Idusuarios,$Nombre_apellido,$Correo,$Telefono,$Contraseña,$Rol)
	{
		$this->Idusuarios=$Idusuarios;
		$this->Nombre_apellido=$Nombre_apellido;
		$this->Correo=$Correo;
		$this->Telefono=$Telefono;
		$this->Contraseña=$Contraseña ;
		$this->Rol=$Rol;
		
	}
	

public function agregarUsuario()
{
    // Setea los datos del usuario

    // Inserta datos en la tabla 'usuarios'
    $sqlUsuarios = "INSERT INTO usuarios (idusuarios, Nombre_apellido, Correo, Telefono, Contraseña, Rol) 
    VALUES ('$this->Idusuarios', '$this->Nombre_apellido', '$this->Correo', '$this->Telefono', '$this->Contraseña', '$this->Rol')";

    $resultadoUsuarios = $this->conexion->query($sqlUsuarios); // Cambio a $this->conexion

    if (!$resultadoUsuarios) {
        $this->conexion->close(); // Cambio a $this->conexion
        return false;
    }

    // Verifica el rol y, si es 'Docente', inserta en la tabla 'docente'
    if ($this->Rol == "Docente") {
        $sqlDocente = "INSERT INTO docente (iddocente, Nombre_apellido, Correo, Contraseña) 
        VALUES ('$this->Idusuarios', '$this->Nombre_apellido', '$this->Correo', '$this->Contraseña')";

        $resultadoDocente = $this->conexion->query($sqlDocente); // Cambio a $this->conexion

        if (!$resultadoDocente) {
            $this->conexion->close(); // Cambio a $this->conexion
            return false;
        }
    }

    // Verifica si el rol es 'Estudiante' y, si es así, inserta en la tabla 'estudiante'
    if ($this->Rol == "Estudiante") {
        $sqlEstudiante = "INSERT INTO estudiante (idestudiante, Nombre_apellido, Correo, Contraseña) 
        VALUES ('$this->Idusuarios', '$this->Nombre_apellido', '$this->Correo', '$this->Contraseña')";

        $resultadoEstudiante = $this->conexion->query($sqlEstudiante); // Cambio a $this->conexion

        if (!$resultadoEstudiante) {
            $this->conexion->close(); // Cambio a $this->conexion
            return false;
        }
    }


    // Verifica si el rol es 'Estudiante' y, si es así, inserta en la tabla 'estudiante'
    if ($this->Rol == "Coordinador") {
        $sqlEstudiante = "INSERT INTO coordinador (idcoordinador, Nombre_apellido, Correo, Contraseña) 
        VALUES ('$this->Idusuarios', '$this->Nombre_apellido', '$this->Correo', '$this->Contraseña')";

        $resultadoEstudiante = $this->conexion->query($sqlEstudiante); // Cambio a $this->conexion

        if (!$resultadoEstudiante) {
            $this->conexion->close(); // Cambio a $this->conexion
            return false;
        }
    }

    $this->conexion->close(); // Cambio a $this->conexion
    return true;
}


	public function modificarUsuario($Idusuarios)
	{	
		$this->Conexion=Conectarse();
		$sql="update  set idusuario =$this->Idusuarios', Nombre_apellido=$this->Nombre_apellido', Correo='$this->Correo', Contraseña='$this->Contraseña', Rol = $this->Rol' where idusuarios = '$this->Idusuarios";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	
		}
		public function actualizarUsuario($Idusuarios)
	{	
		$this->Conexion=Conectarse();
		$sql="update  set idusuario =$this->Idusuarios', Nombre_apellido=$this->Nombre_apellido', Correo='$this->Correo', Contraseña='$this->Contraseña', Rol = $this->Rol' where idusuarios = '$this->Idusuarios";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	
		}

	public function eliminarUsuario($Idusuarios)
{	
    $this->Conexion = Conectarse();
    $sql = "DELETE FROM usuarios WHERE idusuarios = '$Idusuarios'";
    $resultado = $this->Conexion->query($sql);
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
	
	public function consultarUsuarioContraseña($Idusuarios, $Contraseña)
	{
		$this->Conexion = Conectarse();
		$sql = "SELECT * FROM usuarios WHERE idusuarios = '$Idusuarios' AND contraseña = '$Contraseña'";
	
		$resultado = $this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;
	}
	public function __construct()
{
    // Inicializar la conexión aquí, por ejemplo:
    $this->conexion = new mysqli("localhost", "root", "", "digiworm");
    if ($this->conexion->connect_error) {
        die("Error de conexión: " . $this->conexion->connect_error);
    }
}
	
	public function obtenerDatosUsuario($Idusuarios, $Contraseña) {
		$Idusuarios = (int)$Idusuarios; // Convierte $Idusuarios a entero
		// No es necesario modificar la contraseña aquí, simplemente úsala tal como está
		
		// Realiza la consulta SQL para verificar el inicio de sesión
		$sql = "SELECT * FROM usuarios WHERE idusuarios = $Idusuarios AND contraseña = '$Contraseña'";
		$resultado = $this->conexion->query($sql);
		
		if ($resultado && $resultado->num_rows > 0) {
			// El inicio de sesión es exitoso, devuelve todos los datos del usuario
			return $resultado->fetch_assoc();
		} else {
			// El inicio de sesión falló, devuelve falso
			return false;
		}
	}
	}
	
	
	
	
	
?>