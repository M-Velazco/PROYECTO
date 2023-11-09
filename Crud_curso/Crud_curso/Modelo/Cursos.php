<?php
class Curso {
    private $idcurso;
    private $nom_curso;
    private $estado;

    public function CrearCurso($idcurso = null, $nom_curso = null, $estado = null) {
        $this->idcurso = $idcurso;
        $this->nom_curso = $nom_curso;
        $this->estado = $estado;
    }

    public function getIdcurso() {
        return $this->idcurso;
    }

    public function setIdcurso($idcurso) {
        $this->idcurso = $idcurso;
    }

    public function getNomCurso() {
        return $this->nom_curso;
    }

    public function setNomCurso($nom_curso) {
        $this->nom_curso = $nom_curso;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    // Método para agregar un nuevo curso a la base de datos
    public function agregarCurso() {
        $this->Conexion = Conectarse();
        $sql = "INSERT INTO curso (idcurso, nom_curso, estado) VALUES ('$this->idcurso', '$this->nom_curso', '$this->estado')";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }

    // Método para actualizar los datos de un curso en la base de datos
    public function modificarCurso() {
        $this->Conexion = Conectarse();
        $sql = "UPDATE curso SET nom_curso='$this->nom_curso', estado='$this->estado' WHERE idcurso='$this->idcurso'";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }

    // Método para consultar cursos en la base de datos
    public function consultarCursos() {
        $this->Conexion = Conectarse();
        $sql = "SELECT * FROM curso";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }
}
?>
