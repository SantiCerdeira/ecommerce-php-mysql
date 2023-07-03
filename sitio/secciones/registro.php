<?php
$errores = $_SESSION['errores'] ?? [];
$dataForm = $_SESSION['data-form'] ?? [];

unset($_SESSION['errores'], $_SESSION['data-form']);
?>

<section class="container my-3">
    <h1 class="mb-3">Registrarse</h1>
    <form action="acciones/auth-registro.php" method="post">
        <div class="mb-3">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control mb-2" value="<?= $dataForm['nombre'] ?? null;?>"
                <?php if(isset($errores['nombre'])): ?> aria-describedby="error-nombre" <?php endif;?>>
                <?php
                if(isset($errores['nombre'])):
                ?>
                    <div class="msg-error mb-2 fs-4" id="error-nombre"> <span class="visually-hidden">Error:</span> <?= $errores['nombre'];?></div>
                <?php
                endif;
                ?>
        </div>
        <div class="mb-3">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" class="form-control mb-2" value="<?= $dataForm['apellido'] ?? null;?>"
                <?php if(isset($errores['apellido'])): ?> aria-describedby="error-apellido" <?php endif;?>>
                <?php
                if(isset($errores['apellido'])):
                ?>
                    <div class="msg-error mb-2 fs-4" id="error-apellido"> <span class="visually-hidden">Error:</span> <?= $errores['apellido'];?></div>
                <?php
                endif;
                ?>
        </div>
        </div>
       <div class="mb-3">
            <label for="email">Email:</label>
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
            <label for="password">Contraseña:</label>
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
       <div class="mb-3">
            <label for="password_confirmacion">Confirmar contraseña:</label>
            <input id="password_confirmacion" name="password_confirmacion" type="password" class="form-control mb-2" value="<?= $dataForm['password_confirmacion'] ?? null;?>"
                <?php if(isset($errores['password_confirmacion'])): ?> aria-describedby="error-password_confirmacion" <?php endif;?>
                <?php if(isset($errores['password_error'])): ?> aria-describedby="error-password_error" <?php endif;?>>
                <?php
                if(isset($errores['password_confirmacion'])):
                ?>
                    <div class="msg-error mb-2 fs-4" id="error-password"> <span class="visually-hidden">Error:</span> <?= $errores['password_confirmacion'];?></div>
                <?php
                endif;
                ?>
                <?php
                if(isset($errores['password_error'])):
                ?>
                    <div class="msg-error mb-2 fs-4" id="error-password_error"> <span class="visually-hidden">Error:</span> <?= $errores['password_error'];?></div>
                <?php
                endif;
                ?>
        </div>

        <button type="submit" class="btn btn-primary my-3">Crear cuenta</button>
    </form>
</section>