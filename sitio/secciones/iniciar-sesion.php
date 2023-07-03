<?php
$errores = $_SESSION['errores'] ?? [];
$dataForm = $_SESSION['data-form'] ?? [];

unset($_SESSION['errores'], $_SESSION['data-form']);
?>

<section class="container my-3">
    <h1>Iniciar sesión</h1>
    <p>Completá el formulario con tus datos para iniciar sesión</p>
    <form action="acciones/auth-iniciar-sesion.php" method="post">
        <div class="mb-3">
            <label class="mb-1" for="email">Email</label>
            <input id="email" name="email" type="text" class="form-control mb-2" value="<?= $dataForm['email'] ?? null;?>"
                <?php if(isset($errores['email'])): ?> aria-describedby="error-email" <?php endif;?>>
                <?php
                if(isset($errores['email'])):
                ?>
                    <div class="msg-error mb-2 fs-4" id="error-email"> <span class="visually-hidden">Error:</span> <?= $errores['email'];?></div>
                <?php
                endif;
                ?>
        </div>
        <div class="mb-3">
            <label class="mb-1" for="password">Contraseña</label>
            <input id="password" name="password" type="password" class="form-control mb-2" value="<?= $dataForm['password'] ?? null;?>"
                <?php if(isset($errores['password'])): ?> aria-describedby="error-password" <?php endif;?>>
                <?php
                if(isset($errores['password'])):
                ?>
                    <div class="msg-error mb-2 fs-4" id="error-password"> <span class="visually-hidden">Error:</span> <?= $errores['password'];?></div>
                <?php
                endif;
                ?>
        </div>

        <button type="submit" class="btn btn-primary my-3">Ingresar</button>
    </form>
</section>