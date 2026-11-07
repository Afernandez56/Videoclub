<?php
namespace Clases;


class CintaVideo extends Soporte
{

    public function __construct(
        public string $titulo,
        public int    $numero,
        public float  $precio,
        protected int $duracion
    )
    {
        parent::__construct($titulo, $numero, $precio);

    }


    public function muestraResumen() : string{
        return "Película en VHS: " . parent::muestraResumen()
            . ". Duración: " . $this->duracion . " minutos";
    }
}