<?php
$dataForm = $_SESSION['data-form'] ?? [];
?>

<section class="container my-3">
    <h1>Restablecimiento de contraseña.</h1>

    <p>Ingresa y confirma tu nueva contraseña</p>

    <form action="acciones/auth-restablecer-password.php" method="post">
        <input type="hidden" name="id" value="<?= $_GET['id'];?>">
        <input type="hidden" name="token" value="<?= $_GET['token'];?>">
        <div class="mb-3">
            <label for="password">Nueva contraseña</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="password_confirmado">Confirmar nueva contraseña</label>
            <input type="password" id="password_confirmado" name="password_confirmado" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary my-3">Solicitar restablecimiento</button>
    </form>
</section>