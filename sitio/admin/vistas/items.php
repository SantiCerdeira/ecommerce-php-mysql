<?php
use FutHistory\Modelos\Remera;

$remerasFactory = (new Remera);
$remeras = $remerasFactory->remeras([], 9);
$paginador = $remerasFactory->getPaginador();

?>

<section class="container my-3">
    <h1>Administrar catálogo de camisetas</h1>
    <a href="index.php?seccion=camiseta-nueva" class="btn btn-dark fs-4 fw-bold my-3 text-decoration-none text-white">Agregar una camiseta</a>

    <table class="table table-hover table-bordered mb-2">
        <thead>
            <tr>
                <th>Id</th>
                <th>Título</th>
                <th>País</th>
                <th>Equipo</th>
                <th>Continente</th>
                <th>Precio</th>
                <th>Imagen</th> 
                <th>Acciones</th> 
            </tr>    
        </thead>
        <tbody>
            <?php
            foreach ($remeras as $remera):
            ?>
                <tr>
                    <td><?= $remera->getRemeraId() ;?></td>
                    <td><?= htmlspecialchars($remera->getTitulo()) ;?></td>
                    <td><?=htmlspecialchars($remera->getPais());?></td> 
                    <td><?=htmlspecialchars($remera->getEquipo());?></td>
                    <td><?=$remera->getContinente()->getNombre();?></td>
                    <td>$<?= $remera->getPrecio() ;?></td>
                    <td><img src="<?= '../img/' . $remera->getImagen() ;?>" alt="<?=$remera->getTitulo();?>" height="70" width="70"></td>
                    <td class="d-flex justify-content-evenly">
                        <a href="index.php?seccion=camiseta-editar&id=<?= $remera->getRemeraId();?>" class="btn btn-dark my-auto">Editar</a>
                        <a href="index.php?seccion=confirmar-eliminar&id=<?= $remera->getRemeraId();?>" class="btn btn-danger my-auto">Eliminar</a>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
 
    <?php
    $paginador->generarPaginacion();
    ?>
</section>

