<?php
class Docentes
{
    private $Docidentificacion;
    private $DocNombres;
    private $Correo;
    private $Contraseña;
    private $Curso_pr;
    private $Materia;
    private $Conexion;

    
    public function getIDdocentes()
    {
        return $this->Docidentificacion;
    }

    public function getDocNombres()
    {
        return $this->DocNombres;
    }

    public function getCorreo()
    {
        return $this->Correo;
    }

    public function getContraseña()
    {
        return $this->Contraseña;
    }

    public function getCurso_pr()
    {
        return $this->Curso_pr;
    }

    public function getMateria()
    {
        return $this->Materia;
    }

    /**
	 * 
	 * @param newVal
	 */
    public function setIDdocente($newVal)
    {
        $this->Docidentificacion = $newVal;
    }

    /**
	 * 
	 * @param newVal
	 */
    public function setDocNombres($newVal)
    {
        $this->DocNombres = $newVal;
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
    public function setContraseña($newVal)
    {
        $this->Contraseña = $newVal;
    }

    public function setCurso_pr($newVal)
    {
        $this->Curso_pr = $newVal;
    }

    /**
	 * 
	 * @param newVal
	 */
    public function setMateria($newVal)
    {
        $this->Materia = $newVal;
    }
    
    public function crearDocente($Docidentificacion, $DocNombres, $Correo, $Contraseña, $Curso_pr, $Materia)
    {
        $this->Docidentificacion = $Docidentificacion;
        $this->DocNombres = $DocNombres;
        $this->Correo = $Correo;
        $this->Contraseña = $Contraseña;
        $this->Curso_pr = $Curso_pr;
        $this->Materia = $Materia;
    }

    public function agregarDocente()
    {
        $this->Conexion = Conectarse();
    
        // Convertir valores a enteros y escaparlos
        $Docidentificacion = (int)$this->Docidentificacion;
        $Curso_pr = (int)$this->Curso_pr;
        $Materia = (int)$this->Materia;
    
        $Docidentificacion = mysqli_real_escape_string($this->Conexion, $Docidentificacion);
        $Curso_pr = mysqli_real_escape_string($this->Conexion, $Curso_pr);
        $Materia = mysqli_real_escape_string($this->Conexion, $Materia);
    
        // Escapar los valores de cadena
        $DocNombres = mysqli_real_escape_string($this->Conexion, $this->DocNombres);
        $Correo = mysqli_real_escape_string($this->Conexion, $this->Correo);
        $Contraseña = mysqli_real_escape_string($this->Conexion, $this->Contraseña);
    
        // Construir la consulta SQL con los valores escapados
        $sql = "INSERT INTO `docente`(`iddocente`, `Nombre_apellido`, `Correo`, `Contraseña`, `Curso_pr`, `Materia`) 
                VALUES ('$Docidentificacion', '$DocNombres', '$Correo', '$Contraseña', '$Curso_pr', '$Materia')";
    
        // Ejecutar la consulta
        $resultado = $this->Conexion->query($sql);
    
        // Cerrar la conexión
        $this->Conexion->close();
    
        return $resultado;
    }
    


    public function modificarDocentes($Docidentificacion)
    {
        $this->Conexion = Conectarse();
        $sql = "UPDATE docente SET IDdocente = '$this->Docidentificacion', Nombre_apellido = '$this->DocNombres', Correo = '$this->Correo' 
                WHERE IDdocente = '$Docidentificacion' AND Contraseña = '$this->Contraseña'";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }

    public function eliminarDocentes($Docidentificacion)
    {
        $this->Conexion = Conectarse();
        $sql = "DELETE FROM docente WHERE IDdocente = '$Docidentificacion'";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }

    public function consultarDocentes_id($Docidentificacion)
    {
        $this->Conexion = Conectarse();
        $sql = "SELECT * FROM docente WHERE iddocente = '$Docidentificacion'";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
        
    }
    public function consultarDocentes()
    {
        $this->Conexion = Conectarse();
        $sql = "select * from docente";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }
}
?>
