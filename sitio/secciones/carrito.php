<?php

if(isset($_SESSION['carrito'])){
    $carrito = $_SESSION['carrito'];
}
?>

<section class="container my-3">
    <h1 class="fs-1 my-2">Mi carrito:</h1>
    <?php
    if(!isset($_SESSION['carrito'])):
    ?>
        <h2 class="fs-1 text-center my-2">Tu carrito está vacío.</h2>
        <a href="index.php?seccion=items" class="btn btn-dark p-2 my-2 fs-3 w-100 mx-auto">Ir al catálogo</a>
    <?php
    else:
    ?>
        <table class="table table-hover table-bordered my-4">
            <thead>
                <th>Producto</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Eliminar</th>
            </thead>
            <?php
            $total = 0;
            foreach($carrito as $producto):
            $subtotal = $producto['precio'] * $producto['cantidad'];
            $total += $subtotal;
            ?>  
            <tbody>
                <td class="my-auto fs-5"><?= $producto['titulo'] ;?></td>
                <td class="my-auto fs-5">
                    <img src="<?= 'img/' . $producto['imagen'] ;?>" alt="<?=$producto['titulo'];?>" height="70" width="70" class="ml-3">
                </td>
                <td class="my-auto fs-5">$<?= $producto['precio'] ;?></td>
                <td class="d-flex justify-content-between">
                    <form action="acciones/restar-producto.php" method="post">
                        <input type="hidden" name="id" id="id" value="<?= $producto['id'];?>"/>
                        <button class="btn btn-dark px-2 py-1 fs-5"> &#45; </button>
                    </form>
                    <p class="my-auto fs-5">
                        <?= $producto['cantidad'] ;?>
                    </p>
                    <form action="acciones/sumar-producto.php" method="post">
                        <input type="hidden" name="id" id="id" value="<?= $producto['id'];?>"/>
                        <button class="btn btn-dark px-2 py-1 fs-5"> &#43; </button>
                    </form>
                </td>
                <td class="my-auto fs-5">$<?= $subtotal;?></td>
                <td>
                    <form action="acciones/eliminar-producto.php" method="post">
                        <input type="hidden" name="id" id="id" value="<?= $producto['id'];?>">
                        <button class="btn btn-danger p-2">Eliminar</button>
                    </form>
                </td>
            </tbody>
            <?php
            endforeach;
            ?>
        </table>
    <?php
    endif;
    ?>

    <?php
    if(isset($_SESSION['carrito'])):
    ?>
    <p class="fs-3 fw-bold">Total de la compra: $<?=$total;?></p>
    <div class="d-flex justify-content-center row">
        <form action="acciones/registro-compra.php" method="post" class="col-11 col-xl-5 mx-auto">
            <input type="hidden" id="total" name="total" value="<?= $total ;?>">
            <input type="hidden" id="carrito" name="carrito" value="<?= $carrito ;?>">
            <button class="btn btn-dark fs-4 p-3 text-center my-2 w-100">Confirmar compra</button>
        </form>
        <form action="acciones/vaciar-carrito.php" method="post" class="col-11 col-xl-5 mx-auto">
            <button class="btn btn-dark fs-4 p-3 text-center my-2 w-100">Vaciar carrito</button>
        </form>
    </div>
    <?php
    endif;
    ?>
</section>