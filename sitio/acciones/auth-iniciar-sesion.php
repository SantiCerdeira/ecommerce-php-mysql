<?php

use FutHistory\Auth\Autenticacion;
use FutHistory\Validacion\ValidarInicioSesion;

require_once __DIR__ . '/../bootstrap/autoload.php';

$email = $_POST['email'];
$password = $_POST['password'];

$validador = new ValidarInicioSesion([
    'email' => $email,
    'password' => $password
]);

if($validador->hayErrores()) {
    $_SESSION['errores'] = $validador->getErrores();
    $_SESSION['data-form'] = $_POST;

    header("Location: ../index.php?seccion=iniciar-sesion");
    exit;
};

$autenticacion = new Autenticacion();

if(!$autenticacion->iniciarSesion($email, $password)) {
    $_SESSION['mensaje-error'] = "Los datos ingresados no coinciden con los de ninguno de nuestros administradores";
    $_SESSION['data-form'] = $_POST;
    header("Location: ../index.php?seccion=iniciar-sesion");
    exit;
} 

$_SESSION['mensaje-exito'] = "Sesión iniciada exitosamente. Bienvenido/a";
header("Location: ../index.php?seccion=perfil");
exit;


