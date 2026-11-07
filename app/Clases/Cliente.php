<?php
namespace Clases;

class Cliente implements Resumible {
    /** @param Soporte[] $soportesAlquilados */
    protected array $soportesAlquilados = [];
    protected int $numSoportesAlquilados = 0;

    public function __construct(
        protected string $nombre,
        protected int $numero,
        protected ?int $maxAlquilerConcurrente = 3
    )
    {

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
                $this->soportesAlquilados [] = $s;
                $this->numSoportesAlquilados++;
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
            array_splice($this->soportesAlquilados, $numSoporte, 1);
            $this->numSoportesAlquilados--;
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