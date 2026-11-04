<?php
namespace Clases;
class Soporte{
    public static int $contador = 0;
    private static $IVA = 21;
    public function __construct(
        public string   $titulo,
        protected int   $numero,
        protected float $precio
    ){
        self::$contador++;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function getPrecioConIva(): float{
        $precioFinal = ($this->precio)+($this->precio*self::$IVA/100);
        $resultado = number_format($precioFinal,2);
        return $resultado;
    }

    public function muestraResumen() : string{
        return "El producto ".$this->titulo."con numero ".$this->getNumero()." tiene un precio con IVA de: ".$this->getPrecioConIva();
    }
}

?>