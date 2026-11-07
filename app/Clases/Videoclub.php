<?php
namespace Clases;
include_once "Resumible.php";
include_once "Soporte.php";
include_once "CintaVideo.php";
include_once "Dvd.php";
include_once "Juego.php";
include_once "Cliente.php";
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
            echo $producto->muestraResumen() ."<br>";
        }
    }

    public function listarSocios() : void{
        foreach ($this->socios as $socio){
            echo $socio->muestraResumen() ."<br>";
        }
    }

    public function alquilaSocioProducto(int $numeroCliente, int $numSoporte): bool {

        $socio = $this->socios[$numeroCliente] ?? null;
        $soporte = $this->productos[$numSoporte] ?? null;
        if ($socio === null || $soporte === null) {
            echo "No se ha podido alquilar el producto <br>";
            return false;
        }
        return $socio->alquilar($soporte);

    }
}