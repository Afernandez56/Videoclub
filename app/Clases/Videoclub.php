<?php
namespace Clases;
include_once "autoload.php";
class Videoclub{
    /** @param Soporte[] $productos */
    protected array $productos = [];
    protected int $numProductos = 0;
        /** @param Cliente[] $socios */
        protected array $socios = [];
        protected int $numSocios = 0;
    public function __construct(
        protected string $nombre,

    ){}

    private function incluirProducto (Soporte $producto) : bool{

            $this->productos[] = $producto;
            $this->numProductos++;
            echo "Producto incluido: ".$producto->titulo."<br>";
            return true;

    }
    public function incluirCintaVideo (string $titulo, float  $precio, int $duracion) : bool{
        $nuevaCinta = new CintaVideo($titulo, $this->numProductos, $precio, $duracion);
        return $this->incluirProducto($nuevaCinta);
    }

    public function incluirDvd (string $titulo, float $precio, string $idiomas, string $pantalla) : bool{
        $nuevoDvd = new Dvd($titulo, $this->numProductos,$precio, $idiomas, $pantalla);
        return $this->incluirProducto($nuevoDvd);
    }

    public function incluirJuego(string $titulo, float $precio, string $consola, int $minNumJugadores, int $maxNumJugadores) : bool{
        $nuevoJuego = new Juego($titulo, $this->numProductos,$precio, $consola, $minNumJugadores, $maxNumJugadores);
       return $this->incluirProducto($nuevoJuego);
    }

    public function incluirSocio (string $nombre, int $numeroMaxAlquileres = 3) : void{
        $nuevoSocio = new Cliente($nombre, $this->numSocios, $numeroMaxAlquileres);
        $this->socios[] = $nuevoSocio;
        $this->numSocios++;
    }

    public function listarProductos() : void{
        foreach ($this->productos as $producto){
            echo "<br>". $producto->muestraResumen() ;
        }
    }

    public function listarSocios() : void{
        foreach ($this->socios as $socio){
            echo "<br>".$socio->muestraResumen();
        }
    }

    public function alquilaSocioProducto(int $numeroCliente, int $numSoporte)
    {

        $clienteEncontrado = null;
        $soporteEncontrado = null;

        foreach ($this->socios as $socio) {
            if ($socio->getNumero() === $numeroCliente) {
                $clienteEncontrado = $socio;
                break;
            }
        }

        foreach ($this->productos as $producto) {
            if ($producto->getNumero() === $numSoporte) {
                $soporteEncontrado = $producto;
                break;
            }
        }

        if ($clienteEncontrado !== null && $soporteEncontrado !== null) {
            $clienteEncontrado->alquilar($soporteEncontrado);
        } else {
            echo "<br>No se ha encontrado el cliente o el soporte.";
        }
    }
}