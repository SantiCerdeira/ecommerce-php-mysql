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

$camiseta_id = $_POST['camiseta_id'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$pais = $_POST['pais'];
$equipo = $_POST['equipo'];
$continente_fk = $_POST['continente_fk'];
$imagen = $_FILES['imagen'];

$remera = (new Remera)->obtenerPorId($camiseta_id);


if(!$remera) {
    $_SESSION['mensaje-error'] = "La camiseta que estás intentando editar no existe.";
    header("Location: ../index.php?seccion=items");
    exit;
}

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

    header("Location: ../index.php?seccion=camiseta-editar&id=" . $camiseta_id);
    exit;
};

$nombreImagen = date('YmdHis_') . $imagen['name'];
move_uploaded_file($imagen['tmp_name'], '../../img/' . $nombreImagen);

try {
    // Al editar una camiseta, como no puedo traer el valor que ya tiene la imagen
    // como hago con el resto de campos, el input de la imagen queda vacío. 
    // Y si bien yo podría hacer que se guarde la imagen que ya tiene asignada, no puedo
    // hacer submit en el form de editar sin que tenga cargada una imagen, ya que 
    // especifiqué que el campo de imagen no puede estar vacío. Es por eso que al editar, elimino
    // la imagen que había anteriormente ya que de cualquier modo va a tener que ser cargada nuevamente.
    if(!empty($remera->getImagen()) && file_exists('../../img/' . $remera->getImagen())) {
        unlink('../../img/' . $remera->getImagen());
    }

    (new Remera)->editar($camiseta_id, [
        'usuario_fk' => $autenticacion->getId(),
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'precio' => $precio,
        'pais' => $pais,
        'equipo' => $equipo,
        'imagen' => $nombreImagen,
        'continente_fk' => $continente_fk
    ]);

    $_SESSION['mensaje-exito'] = "<b>" . $titulo . "</b> fue editada exitosamente";

    header("Location: ../index.php?seccion=items");
    exit;
} catch (Exception $e) {
    $_SESSION['mensaje-error'] = "Ocurrió un error al intentar editar la camiseta.";
    $_SESSION['data-form'] = $_POST;
    header("Location: ../index.php?seccion=camiseta-editar&id=" . $camiseta_id);
    exit;
}
