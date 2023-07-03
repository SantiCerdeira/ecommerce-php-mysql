<?php

use FutHistory\Auth\Autenticacion;
use FutHistory\Carrito\Compra;
use FutHistory\Carrito\Registro;
use FutHistory\Modelos\Remera;

$autenticacion = new Autenticacion;
$usuario = $autenticacion->getUsuario();
$compras = (new Compra)->getPorUsuario($usuario->getUsuarioId());

?>
<section class="container my-3">
    <h1>Listado de compras del usuario: <?= $usuario->getNombre();?>  <?= $usuario->getApellido();?></h1>
    <?php
    if(count($compras) === 0):
    ?>
        <h2 class="text-center my-5">Aún no has realizado ninguna compra</h2>
    <?php
    else:
    ?>
    <table class="table table-hover table-bordered my-4">
        <thead>
                <th>Id de la compra</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Artículos</th>
        </thead>
        <?php
        foreach($compras as $compra):
        $registros = (new Registro)->obtenerPorCompra($compra->getCompraId());
        ?>
        <tbody>
            <td><?= $compra->getCompraId();?></td>
            <td><?= $compra->getFecha();?></td>
            <td>$<?= $compra->getTotal();?></td>
            <td>
                <ul>
                    <?php
                    foreach($registros as $registro):
                    $remera = (new Remera)->obtenerPorId($registro->getRegistroId());
                    $subtotal = $remera->getPrecio() * $registro->getCantidad();
                    ?>
                        <li>
                            <?= $remera->getTitulo() ;?> x  <?= $registro->getCantidad() ;?> ($<?= $subtotal;?>)
                        </li>
                    <?php
                    endforeach;
                    ?>
                </ul>
            </td>
        </tbody>
        <?php
        endforeach;
        ?>
    </table>
    <?php
    endif;
    ?>
</section>