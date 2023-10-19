<?php

   //CLASE DE CONEXIÓN INCLUIDA 
   include_once('conexion.php');
 
   class Curso{

    //Atributos 
    private $idcurso;
    private $nom_curso;
    private $Estado;

    private $con;


    // Metodos

    public function __construct(){
       $this->con = new conexion  


    }

   }





?>