<?php
namespace Clases;


class CintaVideo extends Soporte
{
    public static int $contador = 0;
    public function __construct(
        public string $titulo,
        public int    $numero = 0,
        public float  $precio,
        protected int $duracion
    )
    {
        parent::__construct($titulo, $numero, $precio);
       self ::$contador ++;
    }


    public function muestraResumen() : string{
        return "La cinta ".$this->titulo." con duración de ".$this->duracion." minutos, tiene un precio con IVA de: ".$this->getPrecioConIva();
    }
}