<?php
namespace Clases;

use Util\CupoSuperadoException;
use Util\SoporteNoEncontradoException;
use Util\SoporteYaAlquiladoException;

class Cliente implements Resumible {
    /** @param Soporte[] $soportesAlquilados */
    protected array $soportesAlquilados = [];
    protected int $numSoportesAlquilados = 0;

    public function getMaxAlquilerConcurrente(): ?int
    {
        return $this->maxAlquilerConcurrente;
    }

    public function __construct(
        protected string $nombre,
        protected int $numero,
        protected ?int $maxAlquilerConcurrente = 3
    )
    {}

    public function getNumSoportesAlquilados(): int
    {
        return $this->numSoportesAlquilados;
    }
    public function getNumero(): int
    {
        return $this->numero;
    }

    public function muestraResumen() : string{
        return "Tu nombre es: ".$this->nombre." y tienes un total de ".count($this->soportesAlquilados)." soportes alquilados";
    }

    public function tieneAlquilado(Soporte $s): bool {
        foreach ($this->soportesAlquilados as $soporte) {
            if ($soporte->getNumero() === $s->getNumero()) {
                return true;
            }
        }
        return false;
    }

    public function alquilar(Soporte $s): bool {
        if ($this->tieneAlquilado($s)) {
            throw new SoporteYaAlquiladoException("El cliente ya tiene alquilado el soporte");
        }
        if ($this->numSoportesAlquilados >= $this->maxAlquilerConcurrente) {
            throw new CupoSuperadoException("El cupo ha sido superado");
        }

        $this->soportesAlquilados[] = $s;
        $this->numSoportesAlquilados++;
        echo "<br>Soporte alquilado correctamente a " . $this->nombre . ": " . $s->titulo;
        $s->alquilado = true;
        return true;
    }

    public function devolver(int $numSoporte): bool {
        foreach ($this->soportesAlquilados as $key => $soporte) {
            if ($soporte->getNumero() === $numSoporte) {
                unset($this->soportesAlquilados[$key]);
                $this->soportesAlquilados = array_values($this->soportesAlquilados);
                $this->numSoportesAlquilados--;
                $soporte->alquilado = false;
                echo "<br>Soporte devuelto correctamente.";
                return true;
            }
        }
        throw new SoporteNoEncontradoException ("Soporte no encontrado");
}
public function listaAlquileres() : void {
        echo $this->nombre." tienes ".$this->numSoportesAlquilados." soportes alquilados <br>";
        foreach ($this->soportesAlquilados as $soporte) {
            echo $soporte->muestraResumen()."<br>";
        }
}



}