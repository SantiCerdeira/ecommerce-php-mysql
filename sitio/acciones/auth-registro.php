<?php

use FutHistory\Modelos\Usuario;
use FutHistory\Validacion\ValidarRegistro;

require_once __DIR__ . '/../bootstrap/autoload.php';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirmacion = $_POST['password_confirmacion'];

$validador = new ValidarRegistro([
    'nombre' => $nombre,
    'apellido' => $apellido,
    'email' => $email,
    'password' => $password,
    'password_confirmacion' => $password_confirmacion
]);

if($validador->hayErrores()) {
    $_SESSION['errores'] = $validador->getErrores();
    $_SESSION['data-form'] = $_POST;

    header("Location: ../index.php?seccion=registro");
    exit;
};


try {
    (new Usuario)->crear([
        'nombre' => $nombre,
        'apellido' => $apellido, 
        'email' => $email, 
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'rol_fk' => 2,
    ]);
    $_SESSION['mensaje-exito'] = "Cuenta creada exitosamente. Iniciá sesión para continuar";
    header("Location: ../index.php?seccion=iniciar-sesion");
    exit;
} catch (Exception $e) {
    $_SESSION['mensaje-error'] = "Ocurrió un error al intentar crear tu cuenta.";
    $_SESSION['data-form'] = $_POST;
    header("Location: ../index.php?seccion=registro");
    exit;
}


