<?php
use FutHistory\Modelos\Remera;
use FutHistory\Modelos\Continente;

$remera = (new Remera)->obtenerPorId($_GET['id']);
$continente = (new Continente)->obtenerPorId($remera->getContinenteFK());
?> 
<section>
    <article class="d-flex row justify-content-evenly flex-xl-row col-11 mx-auto my-4 py-2 px-3 py-3 card fondo items rounded">
        <div class="col-12 col-xl-5">
            <h1 class="fs-2 fw-bold text-center"><?= htmlspecialchars($remera->getTitulo());?></h1>
            <img src="<?= 'img/' . htmlspecialchars($remera->getImagen());?>" alt="<?=htmlspecialchars($remera->getTitulo());?>" width="100%" height="80%" class="mt-3 mb-1 pb-0">
        </div>
        <div class="col-12 col-xl-5 m-1 p-2 d-flex flex-column justify-content-center">
            <p class="fs-4 fw-bold">Continente: <?= htmlspecialchars($remera->getContinenteFK() != null ? $continente->getNombre() : "-");?></p>
            <p class="fs-4 fw-bold">País: <?= htmlspecialchars($remera->getPais() != null ? $remera->getPais() : "-");?></p>
            <p class="fs-4">Equipo: <?= htmlspecialchars($remera->getEquipo() != null ? $remera->getEquipo() : "-");?></p>
            <p class="fs-4"><?= htmlspecialchars($remera->getDescripcion());?></p>
            <p class="fs-3 fw-bold mt-2 text-end">$<?= htmlspecialchars($remera->getPrecio());?></p>
            <form action="acciones/agregar-carrito.php" method="post">
                <div class="infoProducto">
                    <input type="hidden" name="link" id="link" value="<?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>"/>
                    <input type="hidden" name="id" id="id" value="<?= $remera->getRemeraId();?>"/>
                    <input type="hidden" name="imagen" id="imagen" value="<?= htmlspecialchars($remera->getImagen());?>"/>
                    <input type="hidden" name="titulo" id="titulo" value="<?= htmlspecialchars($remera->getTitulo());?>"/>
                    <input type="hidden" name="precio" id="precio" value="<?= htmlspecialchars($remera->getPrecio());?>"/>
                    <input type="hidden" name="cantidad" id="cantidad" value="1"/>
                    <button class="btn btn-dark px-2 py-1 fs-3 w-100">Comprar</button>
                </div>
            </form>
        </div>
    </article>
    <a href="index.php?seccion=items" class="btn btn-dark p-2 my-3 fs-2 text-center w-100 mx-auto botonVolver">Volver al catálogo</a>
</section>