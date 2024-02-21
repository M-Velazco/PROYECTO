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
	Private $Curso;
	Private $Materia;
	Private $Jornada;
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
	public function getCurso()
	{
		return $this->Curso;
	}
	public function getMateria()
	{
		return $this->Materia;
	}
	public function getJornada()
	{
		return $this->Jornada;
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
	public function setCurso($newVal)
	{
		$this->Curso = $newVal;
	}
	public function setMateria($newVal)
	{
		$this->Materia = $newVal;
	}
	public function setJornada($newVal)
	{
		$this->Jornada = $newVal;
	}

	
	public function __construct()
    {
        // Inicializar la conexión desde el archivo de conexión
        $this->conexion = Conectarse();
    }


	public function crearUsuario($Idusuarios,$Nombres,$Apellidos,$Email,$Telefono,$Contraseña,$img,$Rol,$Estado,$Curso , $Materia, $Jornada )
	{
		$this->Idusuarios=$Idusuarios;
		$this->Nombres=$Nombres;
		$this->Apellidos=$Apellidos;
		$this->Email=$Email;
		$this->Telefono=$Telefono;
		$this->Contraseña=$Contraseña ;
		$this->img=$img;
		$this->Rol=$Rol;
		$this->Estado=$Estado;
		$this->Curso=$Curso;
		$this->Materia=$Materia;
		$this->Jornada=$Jornada;
		
	}
	
	public function agregarUsuario()
{
    // Preparamos la consulta para insertar en la tabla 'usuarios'
    $sqlUsuarios = "INSERT INTO usuarios (Idusuarios, Nombres, Apellidos, Email, Telefono, Contrasena, img, Rol, Estado) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparamos la sentencia
    $stmtUsuarios = $this->conexion->prepare($sqlUsuarios);

    // Enlazamos los parámetros
    $stmtUsuarios->bind_param("isssissss", $this->Idusuarios, $this->Nombres, $this->Apellidos, $this->Email, $this->Telefono, $this->Contraseña, $this->img, $this->Rol, $this->Estado);


    // Ejecutamos la sentencia
    $resultadoUsuarios = $stmtUsuarios->execute();

    // Verificamos si la inserción fue exitosa
    if (!$resultadoUsuarios) {
        $this->conexion->close();
        return false;
    }

    // Insertamos datos específicos según el rol del usuario
    switch ($this->Rol) {
        case "Docente":
            // Preparamos la consulta para insertar en la tabla 'docente'
            $sqlDocente = "INSERT INTO docente (idDocente, Nombres, Apellidos, Email, Pasword, Curso, Materia) 
                           VALUES (?, ?, ?, ?, ?, ?, ?)";

            // Preparamos la sentencia
            $stmtDocente = $this->conexion->prepare($sqlDocente);

            // Enlazamos los parámetros
            $stmtDocente->bind_param("issssii", $this->Idusuarios, $this->Nombres, $this->Apellidos, $this->Email, $this->Contraseña, $this->Curso, $this->Materia);

            // Ejecutamos la sentencia
            $resultadoDocente = $stmtDocente->execute();

            // Verificamos si la inserción fue exitosa
            if (!$resultadoDocente) {
                $this->conexion->close();
                return false;
            }
            break;

        case "Estudiante":
            // Preparamos la consulta para insertar en la tabla 'estudiante'
            $sqlEstudiante = "INSERT INTO estudiante (idEstudiante, Nombres, Apellidos, Email, Pasword, Curso) 
                              VALUES (?, ?, ?, ?, ?, ?)";

            // Preparamos la sentencia
            $stmtEstudiante = $this->conexion->prepare($sqlEstudiante);

            // Enlazamos los parámetros
            $stmtEstudiante->bind_param("issssi", $this->Idusuarios, $this->Nombres, $this->Apellidos, $this->Email, $this->Contraseña, $this->Curso);

            // Ejecutamos la sentencia
            $resultadoEstudiante = $stmtEstudiante->execute();

            // Verificamos si la inserción fue exitosa
            if (!$resultadoEstudiante) {
                $this->conexion->close();
                return false;
            }
            break;

        case "Coordinador":
            // Asegúrate de obtener la jornada del formulario y validarla correctamente
            $jornada = $_POST['Jornada'];

            // Preparamos la consulta para insertar en la tabla 'coordinador'
            $sqlCoordinador = "INSERT INTO coordinador (idCoordinador, Nombres, Apellidos, Email, Pasword, Jornada) 
                               VALUES (?, ?, ?, ?, ?, ?)";

            // Preparamos la sentencia
            $stmtCoordinador = $this->conexion->prepare($sqlCoordinador);

            // Enlazamos los parámetros
            $stmtCoordinador->bind_param("isssss", $this->Idusuarios, $this->Nombres, $this->Apellidos, $this->Email, $this->Contraseña, $jornada);

            // Ejecutamos la sentencia
            $resultadoCoordinador = $stmtCoordinador->execute();

            // Verificamos si la inserción fue exitosa
            if (!$resultadoCoordinador) {
                $this->conexion->close();
                return false;
            }
            break;

        // Agrega más casos según los diferentes roles

        default:
            // No es necesario agregar ningún dato adicional para otros roles
            break;
    }

    // Cerramos la conexión
    $this->conexion->close();
    return true;
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

	
	
	}
	
	
	
	
	
?>