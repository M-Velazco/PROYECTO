<?php
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


	public function crearUsuario($Idusuarios,$Nombres,$Apellidos,$Email,$Telefono,$Pasword,$img ,$Rol,$Estado,$Curso , $Materia, $Jornada )
	{
		$this->Idusuarios=$Idusuarios;
		$this->Nombres=$Nombres;
		$this->Apellidos=$Apellidos;
		$this->Email=$Email;
		$this->Telefono=$Telefono;
		$this->Pasword=$Pasword ;
		$this->img=$img;
		$this->Rol=$Rol;
		$this->Estado=$Estado;
		$this->Curso=$Curso;
		$this->Materia=$Materia;
		$this->Jornada=$Jornada;
		
	}
	public function agregarUsuario()
{
    // Preparar la consulta para insertar en la tabla 'usuarios'
    $sqlUsuarios = "INSERT INTO usuarios (Idusuarios, Nombres, Apellidos, Email, Telefono, Pasword, img, Rol, Estado) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Ejecutar la consulta para insertar en la tabla 'usuarios'
    $stmtUsuarios = $this->conexion->prepare($sqlUsuarios);

    // Verificar si la preparación fue exitosa
    if (!$stmtUsuarios) {
        echo "Error en la preparación de la consulta para usuarios: " . $this->conexion->error;
        return false;
    }

    // Enlazar los parámetros
    $stmtUsuarios->bind_param("isssissss", $this->Idusuarios, $this->Nombres, $this->Apellidos, $this->Email, $this->Telefono, $this->Pasword, $this->img, $this->Rol, $this->Estado);

    // Ejecutar la sentencia
    $resultadoUsuarios = $stmtUsuarios->execute();

    // Verificar si la inserción en la tabla 'usuarios' fue exitosa
    if (!$resultadoUsuarios) {
        echo "Error al insertar en la tabla usuarios: " . $stmtUsuarios->error;
        $stmtUsuarios->close();
        $this->conexion->close();
        return false;
    }

    echo "Inserción en la tabla usuarios exitosa.";

    // Insertar datos específicos según el rol del usuario
    switch ($this->Rol) {
        case "Docente":
            $resultadoInsercion = $this->insertarDocente();
            break;

        case "Estudiante":
            $resultadoInsercion = $this->insertarEstudiante();
            break;

        case "Coordinador":
            $resultadoInsercion = $this->insertarCoordinador();
            break;
        case "Padre_de_Familia":
            $resultadoInsercion = $this->insertarPadre_F();
            break;

        // Agregar más casos según los diferentes roles

        default:
            // No es necesario agregar ningún dato adicional para otros roles
            $resultadoInsercion = true;
            break;
    }

    if ($resultadoInsercion) {
        echo "Datos adicionales insertados correctamente.";
    } else {
        echo "Error al insertar datos adicionales.";
    }

    $stmtUsuarios->close();
    $this->conexion->close();

    return $resultadoUsuarios && $resultadoInsercion;
}




private function insertarDocente()
{
    // Preparar e insertar en la tabla 'docente'
    $sqlDocente = "INSERT INTO docente (idDocente, Nombres, Apellidos, Email, Pasword, Curso, Materia) 
                   VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtDocente = $this->conexion->prepare($sqlDocente);
    $stmtDocente->bind_param("isssssi", $this->Idusuarios, $this->Nombres, $this->Apellidos, $this->Email, $this->Pasword, $this->Curso, $this->Materia);
    $resultadoDocente = $stmtDocente->execute();
    $stmtDocente->close();

    return $resultadoDocente;
}

private function insertarEstudiante()
{
    // Preparar e insertar en la tabla 'estudiante'
    $sqlEstudiante = "INSERT INTO estudiante (idEstudiante, Nombres, Apellidos, Email, Pasword, Curso, Estado) 
                      VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtEstudiante = $this->conexion->prepare($sqlEstudiante);
    $stmtEstudiante->bind_param("issssis", $this->Idusuarios, $this->Nombres, $this->Apellidos, $this->Email, $this->Pasword, $this->Curso, $this->Estado);
    $resultadoEstudiante = $stmtEstudiante->execute();
    $stmtEstudiante->close();

    return $resultadoEstudiante;
}

private function insertarCoordinador()
{
    // Asegúrate de obtener la jornada del formulario y validarla correctamente
    $jornada = $_POST['Jornada'];

    // Preparar e insertar en la tabla 'coordinador'
    $sqlCoordinador = "INSERT INTO coordinador (idCoordinador, Nombres, Apellidos, Email, Pasword, Jornada) 
                       VALUES (?, ?, ?, ?, ?, ?)";
    $stmtCoordinador = $this->conexion->prepare($sqlCoordinador);
    $stmtCoordinador->bind_param("isssss", $this->Idusuarios, $this->Nombres, $this->Apellidos, $this->Email, $this->Pasword, $jornada);
    $resultadoCoordinador = $stmtCoordinador->execute();
    $stmtCoordinador->close();

    return $resultadoCoordinador;
}

private function insertarPadre_F()
{
    // Asegúrate de obtener la jornada del formulario y validarla correctamente
    $estado = $_POST['Estado'];

    // Preparar e insertar en la tabla 'coordinador'
    $sqlPadre_F = "INSERT INTO padre_familia (idPadre_Familia, Estado_representante, Estado	) 
                       VALUES (?, ?, ?)";
    $stmtPadre_F = $this->conexion->prepare($sqlPadre_F);
    $stmtPadre_F->bind_param("iss", $this->Idusuarios, $this->Estado, $this->Estado);
    $resultadoPadre_F = $stmtPadre_F->execute();
    $stmtPadre_F->close();

    return $resultadoPadre_F;
}

public function obtenerRolUsuario($Idusuario) {
	// Query para obtener el rol del usuario basado en su ID
	$query = "SELECT Rol FROM usuarios WHERE Idusuarios = ?";

	// Preparar la sentencia
	$stmt = $this->conexion->prepare($query);

	// Vincular parámetros
	$stmt->bind_param("i", $Idusuario);

	// Ejecutar la consulta
	$stmt->execute();

	// Obtener el resultado
	$stmt->bind_result($rol);

	// Obtener el rol del usuario
	if ($stmt->fetch()) {
		return $rol;
	} else {
		return null; // Si no se encuentra el usuario, devolver null o manejar el caso adecuadamente
	}

	// Cerrar la sentencia
	$stmt->close();
}

function obtenerRutaImagenUsuario($Idusuario) {
    // Conecta a la base de datos
    require_once "conexion.php";
    $objConexion = Conectarse();

    // Prepara la consulta SQL para obtener la ruta de la imagen del usuario
    $consulta = $objConexion->prepare("SELECT img FROM usuarios WHERE Idusuarios = ?");
    $consulta->bind_param("i", $Idusuario);
    $consulta->execute();
    $consulta->bind_result($imagen);
    
    // Obtiene el resultado
    $consulta->fetch();
    
    // Devuelve la ruta de la imagen
    return $imagen;
}

public function obtenerNombreUsuario($Idusuarios) {
        // Preparar la consulta SQL
        $consulta = $this->conexion->prepare("SELECT Nombres, Apellidos FROM usuarios WHERE Idusuarios = ?");
        
        // Vincular parámetros y ejecutar la consulta
        $consulta->bind_param("i", $Idusuarios);
        $consulta->execute();

        // Obtener el resultado de la consulta
        $resultado = $consulta->get_result();
        
        // Verificar si se encontraron resultados
        if ($resultado->num_rows > 0) {
            // Obtener el nombre del primer usuario (asumiendo que el ID es único)
            $fila = $resultado->fetch_assoc();
            return $fila['Nombres'] . ' ' . $fila['Apellidos'];
        } else {
            return "Usuario no encontrado";
        }
    }

	public function modificarUsuario($Idusuarios)
	{	
		$this->Conexion=Conectarse();
		$sql="update  set Idusuarios =$this->Idusuarios','$this->Nombres','$this->Apellidos','$this->Email','$this->Telefono','$this->Pasword',$this->img','$this->Rol','$this->Estado' where Idusuarios = '$this->Idusuarios";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	
		}
		public function actualizarDatosUsuario($idUsuario, $nombres, $apellidos, $email, $telefono, $password, $img, $rol, $estado, $status, $Conexion) {
			// Encriptar la contraseña antes de almacenarla en la base de datos (puedes usar la función password_hash)
			$hashedPassword = md5($password);
	
			// Construir la consulta SQL para actualizar los datos del usuario
			$sql = "UPDATE usuarios SET Nombres='$nombres', Apellidos='$apellidos', Email='$email', Telefono='$telefono', Pasword='$hashedPassword', img='$img', Rol='$rol', Estado='$estado', status='$status' WHERE Idusuarios=$idUsuario";
	
			// Ejecutar la consulta y verificar si la actualización fue exitosa
			if ($Conexion->query($sql) === TRUE) {
				return true; // La actualización fue exitosa
			} else {
				return false; // Hubo un error al ejecutar la consulta
			}
		}
	
	 
		// Nota: Recuerda encriptar la contraseña antes de almacenarla en la base de datos
		
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
