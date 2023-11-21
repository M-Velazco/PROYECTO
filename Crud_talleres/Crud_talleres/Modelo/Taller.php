<?php
class Taller {
    private $idtalleres;
    private $Nom_taller;
    private $Materia_taller;
    private $Docente;
    private $Archivo;

    public function CrearTaller($idtalleres = null, $Nom_taller = null, $Materia_taller = null, $Docente = null, $Archivo = null) {
        $this->idtalleres = $idtalleres;
        $this->Nom_taller = $Nom_taller;
        $this->Materia_taller = $Materia_taller;
        $this->Docente = $Docente;
        $this->Archivo = $Archivo;
    }

    public function getIdtalleres() {
        return $this->idtalleres;
    }

    public function setIdtalleres($idtalleres) {
        $this->idtalleres = $idtalleres;
    }

    public function getNomTaller() {
        return $this->Nom_taller;
    }

    public function setNomTaller($Nom_taller) {
        $this->Nom_taller = $Nom_taller;
    }

    public function getMateriaTaller() {
        return $this->Materia_taller;
    }

    public function setMateriaTaller($Materia_taller) {
        $this->Materia_taller = $Materia_taller;
    }

    public function getDocente() {
        return $this->Docente;
    }

    public function setDocente($Docente) {
        $this->Docente = $Docente;
    }

    public function getArchivo() {
        return $this->Archivo;
    }

    public function setArchivo($Archivo) {
        $this->Archivo = $Archivo;
    }

    // Método para agregar un nuevo taller a la base de datos
    public function agregarTaller() {
        $this->Conexion = Conectarse();
        $sql = "INSERT INTO talleres (idtalleres, Nom_taller, Materia_taller, Docente, Archivo) VALUES ('$this->idtalleres', '$this->Nom_taller', '$this->Materia_taller', '$this->Docente', '$this->Archivo')";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }

    // Método para actualizar los datos de un taller en la base de datos
    public function modificarTaller() {
        $this->Conexion = Conectarse();
        $sql = "UPDATE talleres SET Nom_taller='$this->Nom_taller', Materia_taller='$this->Materia_taller', Docente='$this->Docente', Archivo='$this->Archivo' WHERE idtalleres='$this->idtalleres'";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }

    // Método para consultar talleres en la base de datos
    public function consultarTalleres() {
        $this->Conexion = Conectarse();
        $sql = "SELECT * FROM talleres";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }
}
?>
