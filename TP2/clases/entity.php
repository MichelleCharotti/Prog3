<?php

namespace entity;

class Entity{
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $clave;
    public $tipo;

    public function __construct($nombre,$apellido,$telefono,$email,$clave,$tipo){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->clave = $clave;
        $this->tipo = $tipo;
    }

}

?>
