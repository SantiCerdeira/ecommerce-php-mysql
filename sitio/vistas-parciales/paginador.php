<?php
/** @var FutHistory\Paginacion\Paginador; */
    if($paginador->getPaginas() > 1):
    ?>
    <!-- HACER TODO EL CSS -->
    <nav class=""> 
        <p class="mx-4">Páginas</p>
        <ul class=" paginador d-flex justify-content-around list-unstyled w-25 mx-4">
            <?php
            if($paginador->getPagina() > 1):
            ?>
            <li>
                <a href="<?= "index.php?seccion=items&p=1";?>" class="text-dark text-decoration-none">
                    <span class="visually-hidden">Primer página</span>
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li>
                <a href="<?= "index.php?seccion=items&p=" . ($paginador->getPagina() - 1);?>" class="text-dark text-decoration-none">
                    <span class="visually-hidden">Anterior</span>
                    <span aria-hidden="true">&lsaquo;</span>
                </a>
            </li>
            <?php
            else:
            ?>
            <li aria-hidden="true" class="disabled">
                <span>&laquo;</span>
            </li>
            <li aria-hidden="true" class="disabled">
                <span>&lsaquo;</span>
            </li>
            <?php
            endif;
            ?>

        <?php
        for($i = 1; $i <= $paginador->getPaginas(); $i++):
        ?>

            <?php
            if($i === $paginador->getPagina()):
            ?>
            <li class="text-white bg-dark" aria-current="page"><span class="p-3"><?= $i;?></span></li>
            <?php
            else:
            ?>
            <li class="text-dark"><a href="<?= 'index.php?seccion=items&p=' . $i;?>" class="text-dark text-decoration-none"><?= $i;?></a></li>
            <?php
            endif;
            ?>
        <?php
        endfor;
        ?>  

            <?php
            if($paginador->getPagina() < $paginador->getPaginas()):
            ?>
            <li>
                <a href="<?= "index.php?seccion=items&p=" . ($paginador->getPagina() + 1);?>" class="text-dark text-decoration-none">
                    <span class="visually-hidden">Siguiente</span>
                    <span aria-hidden="true">&rsaquo;</span>
                </a>
            </li>
            <li>
                <a href="<?= "index.php?seccion=items&p=" . $paginador->getPaginas();?>" class="text-dark text-decoration-none">
                    <span class="visually-hidden">Última página</span>
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            <?php
            else:
            ?>
            <li aria-hidden="true" class="disabled">
                <span>&rsaquo;</span>
            </li>
            <li aria-hidden="true" class="disabled">
                <span>&raquo;</span>
            </li>
            <?php
            endif;
            ?>

        </ul>
        </nav>
    <?php
    endif;
    ?>