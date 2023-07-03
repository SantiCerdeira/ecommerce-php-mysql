<?php
$dataForm = $_SESSION['data-form'] ?? [];
?>

<section class="container my-3">
    <h1>Solicitar restablecimiento de contraseña.</h1>

    <p>Ingresá tu email para recibir un correo con los pasos para restablecer tu contraseña</p>
    <p>En caso de no ver el correo en tu casilla, revisá la casilla de spam.</p>

    <form action="acciones/auth-enviar-email-password.php" method="post">
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?= $dataForm['email'] ?? null;?>">
        </div>
        <button type="submit" class="btn btn-primary my-3">Solicitar restablecimiento</button>
    </form>
</section>