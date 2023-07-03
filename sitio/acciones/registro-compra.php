<?php

use FutHistory\Carrito\Compra;
use FutHistory\Auth\Autenticacion;

require_once __DIR__ . '/../bootstrap/autoload.php';

$total = $_POST['total'];
$carrito = $_SESSION['carrito'];


$autenticacion = new Autenticacion;
$compra = new Compra;

try {
    $compra->crear([
        'usuario_fk' => $autenticacion->getId(),
        'total' => $total,
        'fecha' => date('Y-m-d h:i:s')
    ]);
    
    header("Location: registrar-productos.php");
    exit;
} catch (Exception $e) {
    $_SESSION['mensaje-error'] = "Ocurrió un error al intentar confirmar tu compra.";
    header("Location: ../index.php?seccion=items");
    exit;
}
