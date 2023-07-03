<?php
use FutHistory\Modelos\Remera;

$busqueda = [];
if(!empty($_GET['n'])) {
    $busqueda['titulo'] = $_GET['n'];
}

$remerasFactory = (new Remera);
$remeras = $remerasFactory->remeras(3);
$paginador = $remerasFactory->getPaginador();
?>

<section>
    <h1 class="fs-1 text-center mt-3 p-3">Catálogo de camisetas de futbol</h1>
    <h2 class="visually-hidden">Lista de camisetas</h2>
        <div class="d-flex justify-content-lg-around row my-4 mx-auto">
        <?php
        foreach($remeras as $remera):
        ?>
            <article class="col-10 col-md-5 col-xl-3 mx-auto mx-xl-3 my-4 card p-3 d-flex text-center fondo items d-flex flex-column justify-content-around">
                <div class="flex-column align-items-center">
                    <h2 class=""><a href="index.php?seccion=items-detalle&id=<?= $remera->getRemeraId();?>" class="text-decoration-none text-dark"><?= htmlspecialchars($remera->getTitulo());?></a></h2>
                    <img src="<?= 'img/'. htmlspecialchars($remera->getImagen());?>" alt="<?=htmlspecialchars($remera->getTitulo());?>" width="80%" height="80%" class="m-2">
                </div>
                <div class="d-flex justify-content-between m-1 p-2">
                    <p class="fs-4 fw-bold mt-2">$<?= htmlspecialchars($remera->getPrecio());?></p>                
                    <form action="acciones/agregar-carrito.php" method="post">
                        <div class="infoProducto">
                            <input type="hidden" name="link" id="link" value="<?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>"/>
                            <input type="hidden" name="id" id="id" value="<?= $remera->getRemeraId();?>"/>
                            <input type="hidden" name="imagen" id="imagen" value="<?= htmlspecialchars($remera->getImagen());?>"/>
                            <input type="hidden" name="titulo" id="titulo" value="<?= htmlspecialchars($remera->getTitulo());?>"/>
                            <input type="hidden" name="precio" id="precio" value="<?= htmlspecialchars($remera->getPrecio());?>"/>
                            <input type="hidden" name="cantidad" id="cantidad" value="1"/>
                            <button class="btn btn-dark px-2 py-1 fs-5">Comprar</button>
                        </div>
                    </form>
                </div>
            </article>
        <?php
        endforeach;
        ?>
        </div>
    <?php
    $paginador->generarPaginacion();
    ?>
</section>