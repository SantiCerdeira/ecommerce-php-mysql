<?php

use FutHistory\Modelos\Usuario;
use FutHistory\Validacion\ValidarInicioSesion;

require_once __DIR__ . '/../../bootstrap/autoload.php';

$email = $_POST['email'];

$usuario = (new Usuario)->obtenerPorEmail($email);

if(!$usuario) {
    $_SESSION['mensaje-error'] = "No existe ningún usuario con ese email";
    $_SESSION['data-form'] = $_POST;
    header("Location: ../index.php?seccion=restablecer-password");
    exit;
}

$recuperar = new FutHistory\Auth\RecuperarPassword;
$recuperar->setUsuario($usuario);

try {
    $recuperar->enviarEmailRecuperacion();
    $_SESSION['mensaje-exito'] = "Email enviado correctamente.";
    header("Location: ../index.php?seccion=iniciar-sesion");
    exit;
} catch (Exception $e) {
    echo $e;
    $_SESSION['mensaje-error'] = "El email no pudo ser enviado, intentá de nuevo más tarde.";
    $_SESSION['data-form'] = $_POST;
    header("Location: ../index.php?seccion=restablecer-password");
    exit;
}