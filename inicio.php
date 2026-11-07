<?php
use Clases\CintaVideo;
use Clases\Dvd;
use Clases\Juego;

include_once "autoload.php";
// Soporte es abstracta, esto da error:
// "Cannot instantiate abstract class Clases\Soporte"
// $soporte1 = new Soporte("Tenet", 22, 3);

$miCinta = new CintaVideo("Los cazafantasmas", 23, 3.5, 107);
echo "<strong>" . $miCinta->titulo . "</strong>";
echo "<br>Precio: " . $miCinta->getPrecio() . " euros";
echo "<br>Precio IVA incluido: " . $miCinta->getPrecioConIva() . " euros";
echo "<br>" . $miCinta->muestraResumen();

echo "<br><br>";

$miDvd = new Dvd("Origen", 24, 15, "es,en,fr", "16:9");
echo "<strong>" . $miDvd->titulo . "</strong>";
echo "<br>Precio: " . $miDvd->getPrecio() . " euros";
echo "<br>Precio IVA incluido: " . $miDvd->getPrecioConIva() . " euros";
echo "<br>" . $miDvd->muestraResumen();

echo "<br><br>";

$miJuego = new Juego("The Last of Us Part II", 26, 49.99, "PS4", 1, 1);
echo "<strong>" . $miJuego->titulo . "</strong>";
echo "<br>Precio: " . $miJuego->getPrecio() . " euros";
echo "<br>Precio IVA incluido: " . $miJuego->getPrecioConIva() . " euros";
echo "<br>" . $miJuego->muestraResumen();