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
        return "La cinta ".$this->titulo." con duración de ".$this->duracion." minutos, tiene un precio con IVA de: ".$this->getPrecioConIva();
    }
}