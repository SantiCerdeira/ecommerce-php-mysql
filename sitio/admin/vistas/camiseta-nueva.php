<?php

use FutHistory\Modelos\Continente;

$estados = (new Continente)->todo();

$errores = $_SESSION['errores'] ?? [];
$dataForm = $_SESSION['data-form'] ?? [];

unset($_SESSION['errores'], $_SESSION['data-form']);

?>

<section class="container my-3">
    <h1>Agregar una nueva camiseta</h1>
    <p>Completá los datos de la camiseta que quieras agregar</p>

    <form action="acciones/camisetas-crear.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="mb-1" for="titulo">Título (*)</label>
            <input id="titulo" name="titulo" type="text" class="form-control mb-2" value="<?= $dataForm['titulo'] ?? null;?>" aria-describedby="help-titulo <?= isset($errores['titulo']) ? 'error-titulo' : '';?>"
                <?php if(isset($errores['titulo'])): ?> aria-describedby="error-titulo" <?php endif;?>>
                    <div class="form-help" id="help-titulo">Debe tener al menos 10 caracteres</div>
                <?php
                if(isset($errores['titulo'])):
                ?>
                    <div class="msg-error mb-2 fs-4" id="error-titulo"> <span class="visually-hidden">Error:</span> <?= $errores['titulo'];?></div>
                <?php
                endif;
                ?>
        </div>
        <div class="mb-3">
            <label class="mb-1" for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" type="text" class="form-control mb-2"><?= $dataForm['descripcion'] ?? null;?></textarea>
        </div>   
        <div class="mb-3">
            <label class="mb-1" for="precio">Precio (*)</label>
            <input id="precio" name="precio" type="text" class="form-control mb-2" value="<?= $dataForm['precio'] ?? null;?>"
                <?php if(isset($errores['precio'])): ?> aria-describedby="error-precio" <?php endif;?>>
                <?php
                if(isset($errores['precio'])):
                ?>
                    <div class="msg-error mb-2 fs-4" id="error-precio"> <span class="visually-hidden">Error:</span> <?= $errores['precio'];?></div>
                <?php
                endif;
                ?>
        </div>
        <div class="mb-3">
            <label class="mb-1" for="pais">País</label>
            <input id="pais" name="pais" type="text" class="form-control mb-2" value="<?= $dataForm['pais'] ?? null;?>">
        </div>
        <div class="mb-3">
            <label class="mb-1" for="equipo">Equipo</label>
            <input id="equipo" name="equipo" type="text" class="form-control mb-2" value="<?= $dataForm['equipo'] ?? null;?>">
        </div>
        <div class="mb-3">
            <label class="mb-1" for="continente_fk">Continente</label>
            <select name="continente_fk" id="continente_fk" class="form-control mb-2">
                <?php
                foreach($estados as $estado): 
                ?>
                    <option value="<?= $estado->getContinenteId();?>"
                    <?= $estado->getContinenteId() == ($dataForm['continente_fk'] ?? null)
                    ? "selected" : "" ;?>>
                        <?= $estado->getNombre();?>
                    </option>
                <?php
                endforeach; 
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="mb-1" for="imagen">Imagen (*)</label>
            <input id="imagen" name="imagen" type="file" class="form-control mb-2" 
                <?php if(isset($errores['imagen'])): ?> aria-describedby="error-imagen" <?php endif;?>>
                <?php
                if(isset($errores['imagen'])):
                ?>
                    <div class="msg-error mb-2 fs-4" id="error-imagen"> <span class="visually-hidden">Error:</span> <?= $errores['imagen'];?></div>
                <?php
                endif;
                ?>
        </div>

        <p>* Los campos son obligatorios.</p>

        <button type="submit" class="btn btn-primary my-3">Agregar</button>
    </form>
</section>