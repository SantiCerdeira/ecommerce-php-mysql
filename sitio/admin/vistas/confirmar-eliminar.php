<?php
use FutHistory\Modelos\Remera;

$remera = (new Remera)->obtenerPorId($_GET['id']);
?>


<section class="container my-3">
    <h1>Confirmar eliminación de camiseta</h1>

    <table class="table table-hover table-bordered my-4">
        <thead>
            <th>Id</th>
            <th>Título</th>
            <th>Precio</th>
            <th>País</th>
        </thead>
        <tbody>
            <td><?= $remera->getRemeraId();?></td>
            <td><?= $remera->getTitulo();?></td>
            <td>$<?= $remera->getPrecio();?></td>
            <td><?= $remera->getPais();?></td>
        </tbody>
    </table>

    <form action="acciones/camisetas-eliminar.php?id=<?= $remera->getRemeraId();?>" method="post">
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>
</section>

