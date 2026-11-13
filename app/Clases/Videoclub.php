<?php
namespace Clases;
use Util\VideoClubException;

include_once "autoload.php";
class Videoclub
{
    /** @param Soporte[] $productos */
    protected array $productos = [];
    protected int $numProductos = 0;
    /** @param Cliente[] $socios */
    protected array $socios = [];
    protected int $numSocios = 0;
    protected int $numProductosAlquilados = 0;
    protected int $numTotalAlquileres = 0;

    public function getNumTotalAlquileres(): int
    {
        return $this->numTotalAlquileres;
    }

    public function getNumProductosAlquilados(): int
    {
        return $this->numProductosAlquilados;
    }

    public function __construct(
        protected string $nombre,

    )
    {
    }

    private function incluirProducto(Soporte $producto): bool
    {

        $this->productos[] = $producto;
        $this->numProductos++;
        echo "Producto incluido: " . $producto->titulo . "<br>";
        return true;

    }

    public function incluirCintaVideo(string $titulo, float $precio, int $duracion): bool
    {
        $nuevaCinta = new CintaVideo($titulo, $this->numProductos, $precio, $duracion);
        return $this->incluirProducto($nuevaCinta);
    }

    public function incluirDvd(string $titulo, float $precio, string $idiomas, string $pantalla): bool
    {
        $nuevoDvd = new Dvd($titulo, $this->numProductos, $precio, $idiomas, $pantalla);
        return $this->incluirProducto($nuevoDvd);
    }

    public function incluirJuego(string $titulo, float $precio, string $consola, int $minNumJugadores, int $maxNumJugadores): bool
    {
        $nuevoJuego = new Juego($titulo, $this->numProductos, $precio, $consola, $minNumJugadores, $maxNumJugadores);
        return $this->incluirProducto($nuevoJuego);
    }

    public function incluirSocio(string $nombre, int $numeroMaxAlquileres = 3): void
    {
        $nuevoSocio = new Cliente($nombre, $this->numSocios, $numeroMaxAlquileres);
        $this->socios[] = $nuevoSocio;
        $this->numSocios++;
    }

    public function listarProductos(): void
    {
        foreach ($this->productos as $producto) {
            echo "<br>" . $producto->muestraResumen();
        }
    }

    public function listarSocios(): void
    {
        foreach ($this->socios as $socio) {
            echo "<br>" . $socio->muestraResumen();
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
            try {
                $clienteEncontrado->alquilar($soporteEncontrado);
            } catch (VideoClubException $e) {
                echo $e->getMessage();
            }

        } else {
            echo "<br>No se ha encontrado el cliente o el soporte.";
        }
    }

    public function alquilaSocioProductos(int $numeroCliente, array $numerosProductos): void
    {
        $clienteEncontrado = null;
        $productosAlquilables = [];

        //busco al cliente
        foreach ($this->socios as $socio) {
            if ($socio->getNumero() === $numeroCliente) {
                $clienteEncontrado = $socio;
                break;
            }
        }
        if ($clienteEncontrado === null) {
            echo "<br>No se ha encontrado el cliente";
            return;
        }
            //veo si tiene espacio suficiente para alquilar los productos
            if(($clienteEncontrado -> getMaxAlquilerConcurrente() - $clienteEncontrado -> getNumSoportesAlquilados()) < (count($numerosProductos))) {
                return;
            }
            //recorro el array para comprobar que se pueden alquilar todos
                foreach ($numerosProductos as $numeroProducto) {
                    $encontrado = false;
                foreach ($this->productos as $producto) {
                    //si el producto existe
                    if ($producto->getNumero() === $numeroProducto) {
                        $soporteEncontrado = $producto;
                        $encontrado = true;
                        //si está alquilado
                        if ($soporteEncontrado -> alquilado) {
                            return;
                            //no está alquilado
                        }
                            $productosAlquilables[] = $soporteEncontrado;
                            break;
                    }
                }

                if (!$encontrado) {
                    return;
                }
            }
                foreach($productosAlquilables as $producto){
                    $clienteEncontrado -> alquilar($producto);
                    $this->numProductosAlquilados++;
                }
                $this->numTotalAlquileres++;
    }


    function devolverSocioProducto(int $numeroCliente, int $numeroProducto): Videoclub {

        $clienteEncontrado = null;
        $soporteEncontrado = null;

        foreach ($this->socios as $socio) {
            if ($socio->getNumero() === $numeroCliente) {
                $clienteEncontrado = $socio;
                break;
            }
        }
        foreach ($this->productos as $producto) {
            if ($producto->getNumero() === $numeroProducto) {
                $soporteEncontrado = $producto;
                break;
            }
        }
        if ($clienteEncontrado !== null && $soporteEncontrado !== null) {
            try{
                $clienteEncontrado->devolver($soporteEncontrado);

            }catch (VideoClubException $e){
                echo $e->getMessage();
            }
        }else{
            echo "<br>No se ha encontrado el cliente o el producto.";

        }
        return $this;
    }

    function devolverSocioProductos(int $numeroCliente, array $numerosProductos): void {
        $clienteEncontrado = null;
        $productosDevolver = [];

        //busco al cliente
        foreach ($this->socios as $socio) {
            if ($socio->getNumero() === $numeroCliente) {
                $clienteEncontrado = $socio;
                break;
            }
        }
        if ($clienteEncontrado === null) {
            echo "<br>No se ha encontrado el cliente";
            return;
        }
        //veo si tiene espacio suficiente para devolver los productos
        if(($clienteEncontrado -> getNumSoportesAlquilados()<(count($numerosProductos)))) {
            return;
        }
        //recorro el array para comprobar que se pueden alquilar todos
        foreach ($numerosProductos as $numeroProducto) {
            $encontrado = false;
            foreach ($this->productos as $producto) {
                //si el producto existe
                if ($producto->getNumero() === $numeroProducto) {
                    $soporteEncontrado = $producto;
                    $encontrado = true;
                    //si no está alquilado
                    if (!$soporteEncontrado -> alquilado || !in_array($soporteEncontrado, $clienteEncontrado->soportesAlquilados)) {
                        return;
                    }
                    $productosDevolver[] = $soporteEncontrado;
                    break;
                }
            }

            if (!$encontrado) {
                return;
            }
        }
        foreach($productosDevolver as $producto){
            $clienteEncontrado -> devolver($producto->getNumero());
            $this->numProductosAlquilados--;
        }
        $this->numTotalAlquileres--;
    }
}