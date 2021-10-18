<?php


class Hamster 


{
    
    protected $id_hamster;


    protected $id_usuario;


    protected $nombre_hamster;
    protected $sexo_hamster;
    protected $fechaNac_hamster;


    public function __construct(
       $nombre_hamster, $sexo_hamster, $fechaNac_hamster,  $id_usuario = null  , $id_hamster = null)
    
    {
        
       
        $this->id_hamster = $id_hamster;

        $this->id_usuario = $id_usuario;


        $this->nombre_hamster = $nombre_hamster;
        $this->sexo_hamster = $sexo_hamster;
        $this->fechaNac_hamster = $fechaNac_hamster;



    }

    public function getId_hamster() {return $this->id_hamster;}
    public function setId_hamster($id_hamster) {$this->id_hamster = $id_hamster;}
  
    public function getId_usuario() {return $this->id_usuario;}
    public function setId_usuario($id_usuario) {$this->id_usuario = $id_usuario;}


    public function getNombre_hamster() {return $this->nombre_hamster;}
    public function getSexo_hamster() {return $this->sexo_hamster;}
    public function getFechaNac_hamster() {return $this->fechaNac_hamster;}



}




