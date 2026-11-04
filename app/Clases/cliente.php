<?php
namespace Clases;

class Cliente {
    public static int $contador = 0;
    public function __construct(
        protected string $nombre,
        protected int $numero,
        /** @param Soporte[] $soportesAlquilados */
        protected array $soportesAlquilados = [],
        protected int $numSoportesAlquilados = 0,
        protected ?int $maxAlquilerConcurrente = 3
    )
    {
        self::$contador = 0;
    }

    public function getNumSoportesAlquilados(): int
    {
        return count($this->soportesAlquilados);
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    public function muestraResumen() : string{
        return "Tu nombre es: ".$this->nombre." y tienes un total de ".count($this->soportesAlquilados)." soportes alquilados";
    }

    public function tieneAlquilado(Soporte $s): bool {
        return (in_array($s, $this->soportesAlquilados));
    }

    public function alquilar(Soporte $s): bool {
        if (in_array($s, $this->soportesAlquilados)) {
            echo "El soporte ya esta alquilado<br>";
            return false;
        }else{
            if (count($this->soportesAlquilados)<$this->maxAlquilerConcurrente) {
                array_push($this->soportesAlquilados, $s);
                echo "El soporte se acaba de alquilar <br>";
                return true;
            }else{
                echo "Has llegado al máximo de alquileres simultáneos <br>";
                return false;
            }

        }
    }

    public function devolver(int $numSoporte): bool {
        if ($numSoporte < $this->getNumSoportesAlquilados() && $numSoporte >= 0) {
            unset($this->soportesAlquilados[$numSoporte]);
            echo "El soporte ha sido devuelto con éxito<br>";
            return true;
        }else{
            echo "El soporte no se puede devolver <br>";
            return false;
        }
}
public function listaAlquileres() : void {
        echo $this->nombre." tienes ".count($this->soportesAlquilados)." soportes alquilados <br>";
        foreach ($this->soportesAlquilados as $soporte) {
            echo $soporte->muestraResumen()."<br>";
        }
}

}