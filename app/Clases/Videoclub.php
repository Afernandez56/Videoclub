<?php
namespace Clases;
class Videoclub{

    public function __construct(
        protected string $nombre,
        /** @param Soporte[] $productos */
        protected array $productos,
        protected int $numProductos,
        /** @param Cliente[] $socios */
        protected array $socios,
        protected int $numSocios
    ){}

    public function incluirProducto (Soporte $producto) : void{
        if (!in_array($producto, $this->productos)){
            $this->productos[] = $producto;
            echo "Producto incluido: ".$this->nombre."\n";
        }else{
            echo "No se ha podido incluir el producto ".$this->nombre."\n";
        }
    }

    public function incluirCintaVideo (string $titulo, float  $precio, int $duracion) : void{
        $nuevaCinta = new CintaVideo($titulo, $precio, $duracion);
        if (!in_array($nuevaCinta, $this->productos)){
            $this->productos[] = $nuevaCinta;
            echo "Producto incluido: ".$this->nombre."\n";
        }else{
            echo "No se ha podido incluir el producto ".$this->nombre."\n";
        }
    }

    public function incluirDvd (string $titulo, float $precio, string $idiomas, string $pantalla) : void{
        $nuevoDvd = new Dvd($titulo, $precio, $idiomas, $pantalla);
        if (!in_array($nuevoDvd, $this->productos)){
            $this->productos[] = $nuevoDvd;
            echo "Producto incluido: ".$this->nombre."\n";
        }else{
            echo "No se ha podido incluir el producto ".$this->nombre."\n";

        }
    }
}