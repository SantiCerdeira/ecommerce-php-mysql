<?php

require_once __DIR__ . '/../bootstrap/autoload.php';

unset($_SESSION['carrito']);
try {
    $_SESSION['mensaje-exito'] = "El carrito fue vaciado exitosamente.";
    header("Location: ../index.php?seccion=items");
    exit;
} catch (Exception $e) {
    $_SESSION['mensaje-error'] = "Ocurrió un error al intentar vaciar el carrito.";
    header("Location: ../index.php?seccion=carrito");
    exit;
}

