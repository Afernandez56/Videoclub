<?php
namespace Clases;

class Juego extends Soporte {

    public function __construct(
        string $titulo,
        int $numero,
        float $precio,
        protected string $consola,
        protected int $minNumJugadores,
        protected int $maxNumJugadores
    )
    {
        parent::__construct($titulo, $numero, $precio);

    }

    function muestraResumen() : string{
        return "Juego para: " . $this->consola . "<br>" . parent::muestraResumen()
            . "<br>" . $this->muestraJugadoresPosibles();
    }
    function muestraJugadoresPosibles() : string {
        if ($this->minNumJugadores != $this->maxNumJugadores){
            return "Se pueden jugar desde ".$this->minNumJugadores." hasta ".$this->maxNumJugadores." jugadores";
        }else if ($this->minNumJugadores ==1 && $this->maxNumJugadores == 1){
            return "Para un jugador";
        }else if ($this->minNumJugadores == $this->maxNumJugadores && $this->maxNumJugadores > 1){
            return "Para ".$this->minNumJugadores. " jugadores";
        }

    }

}