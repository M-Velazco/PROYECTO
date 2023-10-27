<?php
/**
 * @author Johan Santiago VR
 * @version 1.0
 * @created 31-oct-2022 04:28:23 p.m.
 */
class Usuario
{

	Private $idactividades;
	Private $Nom_act;
	Private $Materia_act;
	public $Docente;
	private $Archivo;
	private $conexion;
	
	

	//Constructor
	public function Usuario()
	{
		
	}

	public function getidactividades()
	{
		return $this->idactividades;
	}

	public function getNom_act()
	{
		return $this->Nom_act;
	}

	public function getMateria_act()
	{
		return $this->Materia_act;
	}

	public function getDocente()
	{
		return $this->Docente;
	}

	private function getArchivo()
	{
		return $this->Archivo;
	}

	
	

	/**
	 * 
	 * @param newVal
	 */
	public function setidactividades($newVal)
	{
		$this->idactividades = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setNom_act($newVal)
	{
		$this->Nom_act = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setMateria_act($newVal)
	{
		$this->Materia_act = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDocente($newVal)
	{
		$this->Docente = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setArchivo($newVal)
	{
		$this->Archivo = $newVal;
	}

	
	
	

	public function crearActividad($idactividades,$Nom_act,$Materia_act,$Docente,$Archivo)
	{
		$this->idactividades=$idactividades;
		$this->Nom_act=$Nom_act;
		$this->Materia_act=$Materia_act;
		$this->Docente=$Docente;
		$this->Archivo=$Archivo ;
		
		
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
		$this->Conexion=Conectarse();
		$sql="delete from usuarios where idusuarios = '$this->Idusuario";
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