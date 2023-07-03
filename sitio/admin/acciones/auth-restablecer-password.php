<?php

use FutHistory\Modelos\Usuario;
use FutHistory\Auth\RecuperarPassword;

require_once __DIR__ . '/../../bootstrap/autoload.php';

$id = $_POST['id'];
$token = $_POST['token'];
$password = $_POST['password'];
$password_confirmado = $_POST['password_confirmado'];

$usuario = (new Usuario)->obtenerPorId($id);

if(!$usuario) {
    $_SESSION['mensaje-error'] = "El usuario cuyo password estás intentando actualizar no existe.";
    $_SESSION['data-form'] = $_POST;
    header("Location: ../index.php?seccion=actualizar-password&token=" . $token . "&id=" . $id);
    exit;
}

$recuperar = new FutHistory\Auth\RecuperarPassword;
$recuperar->setUsuario($usuario);
$recuperar->setToken($token);

if(!$recuperar->existe()) {
    $_SESSION['mensaje-error'] = "Este enlace de restablecimiento de contraseña no es válido o ha expirado.";
    $_SESSION['data-form'] = $_POST;
    header("Location: ../index.php?seccion=restablecer-password");
    exit;
}

if($recuperar->expirado()) {
    $_SESSION['mensaje-error'] = "Este enlace de restablecimiento de contraseña ha expirado.";
    $_SESSION['data-form'] = $_POST;
    header("Location: ../index.php?seccion=restablecer-password");
    exit;
}

try {
    $recuperar->actualizarPassword(password_hash($password, PASSWORD_DEFAULT));
    $_SESSION['mensaje-exito'] = "La contraseña se actualizó correctamente.";
    $_SESSION['data-form'] = $_POST;
    header("Location: ../index.php?seccion=iniciar-sesion");
    exit;
} catch (Exception $e) {
    $_SESSION['mensaje-error'] = "Ocurrió un error al intentar actualizar la contraseña.";
    $_SESSION['data-form'] = $_POST;
    header("Location: ../index.php?seccion=actualizar-password&token=" . $token . "&id=" . $id);
    exit;
}