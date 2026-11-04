<?php
namespace Clases;


class Dvd extends Soporte{
    public static int $contador = 0;
    public function __construct(public string $titulo, public int $numero, public float $precio, protected string $idiomas, protected string $formatoPantalla )
    {
        parent::__construct($titulo, $numero, $precio);
        self::$contador++;
    }

    public function muestraResumen() : string{
        return "El DVD ".$this->titulo." con los idiomas (".$this->idiomas.") y el formato (".$this->formatoPantalla.") tiene un precio con IVA de: ".$this->getPrecioConIva();
    }
}