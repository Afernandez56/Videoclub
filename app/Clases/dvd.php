<?php
namespace Clases;


class Dvd extends Soporte{
    public function __construct(public string $titulo, public int $numero, public float $precio, protected string $idiomas, protected string $formatoPantalla )
    {
        parent::__construct($titulo, $numero, $precio);
    }

    public function muestraResumen() : string{
        return "El DVD ".$this->titulo." con los idiomas (".$this->idiomas.") y el formato (".$this->formatoPantalla.") tiene un precio con IVA de: ".$this->getPrecioConIva();
    }
}