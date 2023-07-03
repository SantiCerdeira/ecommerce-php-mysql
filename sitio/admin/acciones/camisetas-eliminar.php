<?php

use FutHistory\Auth\Autenticacion;
use FutHistory\Modelos\Remera;


require_once __DIR__ . '/../../bootstrap/autoload.php';

$autenticacion = new Autenticacion;

if(!$autenticacion->estaAutenticado() || !$autenticacion->esAdmin()) {
    $_SESSION['mensaje-error'] = "Se requiere haber iniciado sesión para acceder a esa pantalla.";
    header("Location: index.php?seccion=iniciar-sesion");
    exit;
}

$id = $_GET['id'];

$remera = (new Remera)->obtenerPorId($id);

if(!$remera) {
    $_SESSION['mensaje-error'] = "La camiseta que estás intentando eliminar no existe.";
    header("Location: ../index.php?seccion=items");
    exit;
}

try {
    $remera->eliminar();
    if(!empty($remera->getImagen()) && file_exists('../../img/' . $remera->getImagen())) {
        unlink('../../img/' . $remera->getImagen());
    }

    $_SESSION['mensaje-exito'] = "La camiseta \"" . $remera->getTitulo() . "\"se eliminó correctamente.";
    header("Location: ../index.php?seccion=items");
    exit;
} catch (Exception $e) {
    $_SESSION['mensaje-error'] = "Ocurrió un error al intentar eliminar la camiseta.";
    header("Location: ../index.php?seccion=items");
    exit;
}