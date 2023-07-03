<?php
use FutHistory\Auth\Autenticacion;
use FutHistory\Modelos\Remera;
use FutHistory\Validacion\ValidarCamiseta;


require_once __DIR__ . '/../../bootstrap/autoload.php';

$autenticacion = new Autenticacion;

if(!$autenticacion->estaAutenticado() || !$autenticacion->esAdmin()) {
    $_SESSION['mensaje-error'] = "Se requiere haber iniciado sesión para acceder a esa pantalla.";
    header("Location: index.php?seccion=iniciar-sesion");
    exit;
}

$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$pais = $_POST['pais'];
$equipo = $_POST['equipo'];
$continente_fk = $_POST['continente_fk'];
$imagen = $_FILES['imagen'];

$validador = new ValidarCamiseta([
    'titulo' => $titulo,
    'descripcion' => $descripcion,
    'precio' => $precio,
    'equipo' => $equipo,
    'pais' => $pais,
    'imagen' => $imagen,
]);

if($validador->hayErrores()) {
    $_SESSION['errores'] = $validador->getErrores();
    $_SESSION['data-form'] = $_POST;

    header("Location: ../index.php?seccion=camiseta-nueva");
    exit;
};

$nombreImagen = date('YmdHis_') . $imagen['name'];
move_uploaded_file($imagen['tmp_name'], '../../img/' . $nombreImagen);

try {
    (new Remera)->crear([
        'usuario_fk' => $autenticacion->getId(),
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'precio' => $precio,
        'pais' => $pais,
        'equipo' => $equipo,
        'continente_fk' => $continente_fk,
        'imagen' => $nombreImagen,
    ]);

    $_SESSION['mensaje-exito'] = "<b>" . $titulo . "</b> fue agregada exitosamente";

    header("Location: ../index.php?seccion=items");
    exit;
} catch (Exception $e) {
    $_SESSION['mensaje-error'] = "Ocurrió un error al intentar agregar la camiseta.";
    $_SESSION['data-form'] = $_POST;
    header("Location: ../index.php?seccion=camiseta-nueva");
    exit;
}
