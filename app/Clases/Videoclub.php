<?php
namespace Clases;
class Videoclub{

    public function __construct(
        protected string $nombre,
        /** @param Soporte[] $productos */
        protected array $productos = [],
        protected int $numProductos = 0,
        /** @param Cliente[] $socios */
        protected array $socios = [],
        protected int $numSocios = 0
    ){}

    public function incluirProducto (Soporte $producto) : bool{
        if (!in_array($producto, $this->productos)){
            $this->productos[] = $producto;
            $this->numProductos++;
            echo "Producto incluido: ".$this->nombre."\n";
            return true;
        }else{
            echo "No se ha podido incluir el producto ".$this->nombre."\n";
            return false;
        }
    }

    public function incluirCintaVideo (string $titulo, float  $precio, int $duracion) : bool{
        $nuevaCinta = new CintaVideo($titulo, $this->numProductos, $precio, $duracion);
        if (!in_array($nuevaCinta, $this->productos)){
            $this->productos[] = $nuevaCinta;
            $this->numProductos++;
            echo "Producto incluido: ".$this->nombre."\n";
            return true;
        }else{
            echo "No se ha podido incluir el producto ".$this->nombre."\n";
            return false;
        }
    }

    public function incluirDvd (string $titulo, float $precio, string $idiomas, string $pantalla) : bool{
        $nuevoDvd = new Dvd($titulo, $this->numProductos,$precio, $idiomas, $pantalla);
        if (!in_array($nuevoDvd, $this->productos)){
            $this->productos[] = $nuevoDvd;
            $this->numProductos++;
            echo "Producto incluido: ".$this->nombre."\n";
            return true;
        }else{
            echo "No se ha podido incluir el producto ".$this->nombre."\n";
            return false;

        }
    }

    public function incluirJuego(string $titulo, float $precio, string $consola, int $minNumJugadores, int $maxNumJugadores) : bool{
        $nuevoJuego = new Juego($titulo, $this->numProductos,$precio, $consola, $minNumJugadores, $maxNumJugadores);
        if (!in_array($nuevoJuego, $this->productos)){
            $this->productos[] = $nuevoJuego;
            $this->numProductos++;
            return true;
        }else{
            echo "No se ha podido incluir el producto ".$this->nombre."\n";
            return false;
        }
    }

    public function incluirSocio (string $nombre) : void{
        $nuevoSocio = new Cliente($nombre, $this->numSocios);
        if (!in_array($nuevoSocio, $this->socios)){
            $this->socios[] = $nuevoSocio;
            $this->numSocios++;
        }else{
            echo "No se ha podido incluir el socio ".$this->nombre."\n";
        }

    }

    public function listarProductos() : void{
        foreach ($this->productos as $producto){
            echo $producto->muestraResumen() ."\n";
        }
    }

    public function listarSocios() : void{
        foreach ($this->socios as $socio){
            echo $socio->muestraResumen() ."\n";
        }
    }

    public function alquilaSocioProducto(int $numeroCliente, int $numSoporte): bool {

        $socio = $this->socios[$numeroCliente];
        $soporte = $this->productos[$numSoporte];
        if ($socio == null || $soporte == null) {
            echo "No se ha podido alquilar el producto ";
            return false;
        }
        return $socio->alquilar($soporte);

    }
}