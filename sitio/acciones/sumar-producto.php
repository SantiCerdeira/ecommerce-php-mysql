<?php

require_once __DIR__ . '/../bootstrap/autoload.php';

$carrito = $_SESSION['carrito'];
$id = $_POST['id'];

try{
    foreach($carrito as $producto){
        if($producto['id'] == $id){
            $indice = array_search($producto, $carrito);
            $carrito[$indice]['cantidad'] ++;
        }
    }
    $_SESSION['carrito'] = $carrito;
    $_SESSION['mensaje-exito'] = "La cantidad del producto se ha actualizado corrrectamente.";
    header("Location: ../index.php?seccion=carrito");
    exit;
} catch(Exception $e){
    $_SESSION['mensaje-error'] = "Ocurrió un error al intentar modificar la cantidad del producto.";
    header("Location: ../index.php?seccion=carrito");
    exit;
}