<?php

use FutHistory\Auth\Autenticacion;
use FutHistory\Carrito\Compra;
use FutHistory\Carrito\Registro;
use FutHistory\Modelos\Usuario;
use FutHistory\Modelos\Remera;

$autenticacion = new Autenticacion;
$usuarios = (new Usuario)->todo();
$usuario = $autenticacion->getUsuario();
$usuarioNombre = (new Usuario)->obtenerPorId($_GET['id']);
$id = $_GET['id'];
$compras = (new Compra)->getPorUsuario($_GET['id']);

?>
<section class="container my-3">
    <h1>Listado de compras del usuario: <?= $usuarioNombre->getNombre();?>  <?= $usuarioNombre->getApellido();?></h1>
    <?php
    if(count($compras) === 0):
    ?>
        <h2 class="text-center my-5">Este usuario aún no ha realizado compras</h2>
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
        if($compra->getUsuarioCompra() === $id):
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
        endif;
        endforeach;
        ?>
        </table>
    <?php
    endif;
    ?>
</section>