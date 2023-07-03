<?php

require_once __DIR__ . '/bootstrap/autoload.php';

$rutas = [
    'home' => [
        'title' => 'Inicio',
    ],
    'error' => [
        'title' => 'Mantenimiento',
    ],
    'items' => [
        'title' => 'Catálogo',
    ],
    'items-detalle' => [
        'title' => 'Detalle',
    ],
    'carrito' => [
        'title' => 'Carrito de compras',
        'requiereAutenticacion' => true,
        'requiereCliente' => true,
    ],
    'iniciar-sesion' => [
        'title' => 'Inicia sesión en tu cuenta',
    ],
    'registro' => [
        'title' => 'Crea una cuenta nueva',
    ],
    'perfil' => [
        'title' => 'Mi perfil',
        'requiereAutenticacion' => true,
    ],
    'mis-compras' => [
        'title' => 'Mis compras',
        'requiereAutenticacion' => true,
    ],
    'form' => [
        'title' => 'Contacto',
    ],
    '404' => [
        'title' => 'Página no encontrada',
    ],
];

$seccion = $_GET['seccion'] ?? 'home';

if(!isset($rutas[$seccion])) {
    $seccion = '404';
}

$rutaConfig = $rutas[$seccion];

$autenticacion = new \FutHistory\Auth\Autenticacion;

$requiereAutenticacion = $rutaConfig['requiereAutenticacion'] ?? false;

if($requiereAutenticacion && !$autenticacion->estaAutenticado()) {
    $_SESSION['mensaje-error'] = "Se requiere haber iniciado sesión para acceder a esa pantalla.";
    header("Location: index.php?seccion=iniciar-sesion");
    exit;
}

$requiereCliente = $rutaConfig['requiereCliente'] ?? false;

if($requiereCliente && $autenticacion->esAdmin()) {
    $_SESSION['mensaje-error'] = "Se requiere ser cliente para poder realizar compras.";
    header("Location: index.php?seccion=iniciar-sesion");
    exit;
}


$mensajeExito = $_SESSION['mensaje-exito'] ?? null;
$mensajeError = $_SESSION['mensaje-error'] ?? null;

unset($_SESSION['mensaje-exito'], $_SESSION['mensaje-error']);

if(isset($_SESSION['carrito'])){$carrito = $_SESSION['carrito'];}else{$carrito = '';}
$cantidadTotal = 0;

if(isset($_SESSION['carrito'])){
    foreach($carrito as $producto){
        $cantidadTotal += $producto['cantidad'];
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $rutaConfig['title'] ?? '';?> | FutHistory</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caudex&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/fontello-426f74db/css/fontello.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <a href="#main" class="visually-hidden-focusable bg-dark fs-5 text-decoration-none text-white p-2">Ir al contenido principal</a>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark bg-gradient text-light">
            <div class="container-fluid ">
                <img class="navbar-brand" src="img/logo.png" alt="Logo FutHistory" width="50" height="50">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav w-75 mx-auto d-flex justify-content-evenly">
                        <li class="nav-item">
                            <a class="nav-link  text-light" href="index.php?seccion=home">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  text-light" href="index.php?seccion=items">Catálogo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  text-light" href="index.php?seccion=form">Contacto</a>
                        </li>

                        <?php
                        if($autenticacion->estaAutenticado()): 
                        ?>
                            <li class="nav-item">
                                <a class="nav-link  text-light" href="index.php?seccion=perfil">Mi perfil</a>
                            </li>
                            <li class="nav-item">
                                <form action="acciones/auth-cerrar-sesion.php" method="post">
                                    <button type="submit" class="btn btn-dark">Cerrar sesión (<?= $autenticacion->getUsuario()->getNombre();?> <?= $autenticacion->getUsuario()->getApellido();?> )</button>
                                </form>
                            </li>
                        <?php
                        else: 
                        ?>
                            <li class="nav-item">
                                <a class="nav-link  text-light" href="index.php?seccion=iniciar-sesion">Iniciar sesión</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  text-light" href="index.php?seccion=registro">Registrarme</a>
                            </li>
                        <?php
                        endif; 
                        ?>

                        <?php
                        if($autenticacion->estaAutenticado() && !$autenticacion->esAdmin()): 
                        ?>
                            <li class="">
                                <a href="index.php?seccion=carrito" class="btn btn-dark p-2">Carrito <?=isset($_SESSION['carrito']) ? "(" . $cantidadTotal . ")" : ""; ?></a>
                            </li>
                        <?php
                        endif; 
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main id="main">
        <?php
        if($mensajeExito):
        ?>
            <div class="m-2 p-2 bg-success text-white rounded "><?=$mensajeExito;?></div>
        <?php
        endif;
        ?>
        <?php
        if($mensajeError):
        ?>
           <div class="m-2 p-2 bg-danger text-white rounded"><?=$mensajeError;?></div>
        <?php
        endif;
        ?>

        <?php
        $filename = __DIR__ . '/secciones/' . $seccion . '.php' ;
        if (file_exists($filename)) {
            require $filename;
        } else {
            require __DIR__ . '/secciones/404.php' ;
        }
        ?>
    </main>

    <footer class=" mt-0 p-3 bg-dark bg-gradient text-light">
        <p class="fs-2 text-center fw-bold ">Seguinos en nuestras redes!</p>
        <ul class="m-0 p-2 list-unstyled text-center">
            <li class="list-inline-item"><i class="iconos icon-instagram"><a href="#"></a></i></li>
            <li class="list-inline-item"><i class="iconos icon-twitter-circled"><a href="#"></a></i></li>
            <li class="list-inline-item"><i class="iconos icon-facebook-circled"><a href="#"></a></i></li>
        </ul>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>