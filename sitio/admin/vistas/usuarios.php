<?php
use FutHistory\Modelos\Usuario;

$usuarios = (new Usuario)->todo();
?>

<section class="container my-3">
<h1>Listado de usuarios</h1>
    
<table class="table table-hover table-bordered mb-2">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Rol de usuario</th>
                <th>Compras</th>
            </tr>    
        </thead>
        <tbody>
            <?php
            foreach ($usuarios as $usuario):
            ?>
                <tr>
                    <td><?= htmlspecialchars($usuario->getNombre()) ;?></td>
                    <td><?= htmlspecialchars($usuario->getApellido()) ;?></td>
                    <td><?= htmlspecialchars($usuario->getEmail()) ;?></td>
                    <td>
                        <?php
                            if($usuario->getRolFK() === 1):
                        ?>
                            Administrador                            
                        <?php
                            else:
                        ?>
                            Cliente
                        <?php
                            endif;
                        ?>
                    </td>
                    <td>
                        <?php
                            if($usuario->getRolFK() === 1):
                        ?>

                        <?php
                            else:
                        ?>
                            <a href="index.php?seccion=compras-usuario&id=<?= $usuario->getUsuarioId();?>" class="btn btn-dark my-auto mx-auto">Ver compras</a>
                        <?php
                            endif;
                        ?>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</section>