<?php

use FutHistory\Auth\Autenticacion;

require_once __DIR__ . '/../bootstrap/autoload.php';

$carrito = $_SESSION['carrito'];
$producto = $_POST;
$link = $_POST['link'];
$enCarrito = false;
$autenticacion = new Autenticacion;

if($autenticacion->estaAutenticado()) {
    if(!$autenticacion->esAdmin()){
        try {
            if(isset($_POST['titulo'])) {
                $id = $_POST['id'];
                $titulo = $_POST['titulo'];
                $imagen = $_POST['imagen'];
                $precio = $_POST['precio'];
                $cantidad = $_POST['cantidad'];
            
                if(isset($_SESSION['carrito'])){
                    foreach($carrito as $producto){
                        if($producto['id'] == $id){
                            $indice = array_search($producto, $carrito);
                            $carrito[$indice]['cantidad'] ++;
                            $enCarrito = true;
                        }
                    }
                }
                
                if($enCarrito === false){
                    $carrito[] = array(
                        "id" => $id,
                        "titulo" => $titulo,
                        "imagen" => $imagen,        
                        "precio" => $precio,        
                        "cantidad" => $cantidad,
                    );
                }
                $enCarrito = false;
                $_SESSION['mensaje-exito'] = "Se agregó el producto al carrito.";
            }
            $_SESSION['carrito'] = $carrito;
            header("Location:" . $link);
            exit;
        } catch (Exception $e) {
            $_SESSION['mensaje-error'] = "Ocurrió un error al intentar agregar el producto al carrito.";
            header("Location:" . $link);
            exit;
        }
    } else {
        $_SESSION['mensaje-error'] = "Necesitas haber iniciado sesión como cliente para agregar productos al carrito.";
        header("Location:" . $link);
        exit;
    }
} else {
    $_SESSION['mensaje-error'] = "Necesitas iniciar sesión para agregar productos al carrito.";
    header("Location:" . $link);
    exit;
}
