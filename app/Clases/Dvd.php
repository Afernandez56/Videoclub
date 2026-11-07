<?php
namespace Clases;


class Dvd extends Soporte{

    public function __construct(public string $titulo, public int $numero, public float $precio, protected string $idiomas, protected string $formatoPantalla )
    {
        parent::__construct($titulo, $numero, $precio);
    }

    public function muestraResumen() : string{
        return "Película en DVD: " . parent::muestraResumen()
            . ". Idiomas: " . $this->idiomas . ". Formato de pantalla: " . $this->formatoPantalla;
    }
}