<?php

use FutHistory\Carrito\Compra;
use FutHistory\Carrito\Registro;

require_once __DIR__ . '/../bootstrap/autoload.php';

$carrito = $_SESSION['carrito'];

$compra = new Compra;
$registro = new Registro;
try {
    foreach($carrito as $producto){
        $registro->registrar([
            'compra_fk' => $compra->ultimaCompra()->ultimaCompra,
            'articulo_id' => $producto['id'],
            'cantidad' => $producto['cantidad']
        ]);
    }

    $_SESSION['mensaje-exito'] = "Compra realizada exitosamente.";

    unset($_SESSION['carrito']);
    
    header("Location: ../index.php?seccion=items");
    exit;
} catch (Exception $e) {
    $_SESSION['mensaje-error'] = "Ocurrió un error al intentar confirmar tu compra.";
    header("Location: ../index.php?seccion=items");
    exit;
}
