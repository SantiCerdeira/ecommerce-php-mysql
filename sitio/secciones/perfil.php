<?php

use FutHistory\Auth\Autenticacion;

$autenticacion = new Autenticacion;
$usuario = $autenticacion->getUsuario();
?>
<section class="container my-3">
    <h1>Mi perfil</h1>
    <?php
    if($autenticacion->esAdmin()):
    ?>
        <a href="admin" class="btn btn-dark text-decoration-none my-2">Ir al panel de administración</a>
    <?php
    endif;
    ?>

    <table class="table table-hover table-bordered my-3">
        <thead>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <?php
            if(!$autenticacion->esAdmin()):
            ?>
                <th>Compras</th>
            <?php
            endif;
            ?>
        </thead>
        <tbody>
            <td><?= $usuario->getNombre();?></td>
            <td><?= $usuario->getApellido();?></td>
            <td><?= $usuario->getEmail();?></td>
            <?php
            if(!$autenticacion->esAdmin()):
            ?>
                <td>
                    <a href="index.php?seccion=mis-compras" class="btn btn-dark my-auto mx-auto">Ver mis compras</a>
                </td>
            <?php
            endif;
            ?>
        </tbody>
    </table>

</section>