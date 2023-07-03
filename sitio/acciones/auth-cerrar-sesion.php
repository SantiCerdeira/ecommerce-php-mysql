<?php

use FutHistory\Auth\Autenticacion;

require_once __DIR__ . '/../bootstrap/autoload.php';

$autenticacion = new Autenticacion;

$autenticacion->cerrarSesion();

unset($_SESSION['carrito']);

$_SESSION['mensaje-exito'] = "La sesión se cerró correctamente.";
header("Location: ../index.php?seccion=iniciar-sesion");
exit;