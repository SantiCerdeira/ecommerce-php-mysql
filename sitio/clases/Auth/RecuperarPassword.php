<?php

namespace FutHistory\Auth;

use FutHistory\Modelos\Usuario;
use FutHistory\DB\DBConexion;
use DateTime;
use PHPMailer\PHPMailer\PHPMailer;


class RecuperarPassword{
    private Usuario $usuario;
    private string $token;
    private DateTime $expiracion;


    public function setUsuario(Usuario $usuario) {
        $this->usuario = $usuario;
    }

    public function enviarEmailRecuperacion() {
        $this->token = $this->generarToken();
        $this->almacenarToken();
        $this->enviarEmail();
    }

    private function generarToken(): string {
        $token = openssl_random_pseudo_bytes(32);

        return bin2hex($token);
    }

    private function almacenarToken() {
        $this->eliminarToken();
        $this->guardarToken();
    }

    private function guardarToken() {
        $db = DBConexion::getConexion();
        $query= "INSERT INTO recuperar_passwords (usuario_fk, token, expiracion)
                VALUES (:usuario_fk, :token, :expiracion)";
        $stmt = $db->prepare($query);
        $this->expiracion = new DateTime();
        $this->expiracion->modify("+1 hour");

        $stmt->execute([
            'usuario_fk' => $this->usuario->getUsuarioId(),
            'token' =>$this->token,
            'expiracion' =>$this->expiracion->format('Y-m-d H:i:s'),
        ]); 
    }
    

    private function getMailInstance(): PHPMailer {
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;    
        $phpmailer->Username = '31c051d1fdcd78';
        $phpmailer->Password = '5146153984eefe';
        $phpmailer->CharSet = 'UTF-8';

        return $phpmailer;
    }

    public function getMailBody(): string {
        $cuerpo = file_get_contents(__DIR__ . '/../../emails-templates/restablecer-password.html');
        $link = ' http://localhost/programacion/ecommerce/admin/index.php?seccion=actualizar-password&token=' . $this->token . '&id=' . $this->usuario->getUsuarioId();
        $cuerpo = str_replace([
            '@@LINK@@',
            '@@USUARIO@@',
        ], [
            $link,
            $this->usuario->getNombre(),
        ], $cuerpo);

        return $cuerpo;
    }

    private function enviarEmail() {
        try {
            $mail = $this->getMailInstance();
            $mail->setFrom('no-responder@futhistory.com');
            $mail->addAddress($this->usuario->getEmail());
            $mail->Subject = "Restablecer contraseña FutHistory";
            $mail->Body = $this->getMailBody();
            $mail->send();
        } catch (Exception $e) {
                $filename = date('YmdHis_') . $this->usuario->getEmail() . "_restablecer-password.html";
                file_put_contents(__DIR__ . '/../../emails-fallidos/' . $filename, $cuerpo);
        }
    }


    private function enviarEmailHtmlExterno() {
        $destinatario = $this->usuario->getEmail();
        $asunto = "Restablecer contraseña FutHistory";
        $cuerpo = file_get_contents(__DIR__ . '/../../emails-templates/restablecer-password.html');
        $link = ' http://localhost/programacion/ecommerce/admin/index.php?seccion=actualizar-password&token=' . $this->token . '&id=' . $this->usuario->getUsuarioId();
        $cuerpo = str_replace([
            '@@LINK@@',
            '@@USUARIO@@',
        ], [
            $link,
            $this->usuario->getNombre(),
        ], $cuerpo);

        $headers= "From: no-responder@futhistory.com" . "\r\n";
        $headers.= "MIME-Version: 1.0" . "\r\n";
        $headers.= "Content-Type: text/html; charset=utf-8" . "\r\n";

        if(!mail($destinatario, $asunto, $cuerpo, $headers)) {
            $filename = date('YmdHis_') . $this->usuario->getEmail() . "_restablecer-password.html";
            file_put_contents(__DIR__ . '/../../emails-fallidos/' . $filename, $cuerpo);
        }
    }


    private function enviarEmailTextoPlano() {
        $destinatario = $this->usuario->getEmail();
        $asunto = "Restablecer contraseña FutHistory";
        $cuerpo = "Querido/a " . $this->usuario->getNombre() . ",
        recibimos una solicitud desde tu correo para restablecer la contraseña de tu cuenta de FutHistory.
        Para restablecer la contraseña, por favor ingresá al siguiente enlace:
        http://localhost/programacion/ecommerce/admin/index.php?seccion=actualizar-password&token=" . $this->token . "&id=" . $this->usuario->getUsuarioId() . "
        

        Ante cualquier consulta, estamos a tu disposición.
        FutHistory";

        $headers= "From: no-responder@futhistory.com" . "\r\n";


        if(!mail($destinatario, $asunto, $cuerpo, $headers)) {
            $filename = date('YmdHis_') . $this->usuario->getEmail() . "_restablecer-password.html";
            file_put_contents(__DIR__ . '/../../emails-fallidos/' . $filename, $cuerpo);
        }
    }

    
    public function setToken(string $token) {
        $this->token = $token;
    }

    public function existe() : bool {
        $db = DBConexion::getConexion();
        $query= "SELECT * FROM recuperar_passwords
                WHERE usuario_fk = :id
                AND   token = :token";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'id' => $this->usuario->getUsuarioId(),
            'token' => $this->token,
        ]); 

        $fila = $stmt->fetch();
        if(!$fila) {
            return false;
        }
        $this->expiracion = new DateTime($fila['expiracion']);
        return true;
    }

    public function expirado() : bool {
        $fechaActual = new DateTime;

        if($fechaActual >= $this->expiracion) {
            $this->eliminarToken();
            return true;
        }
        return false;
    }

    public function actualizarPassword(string $password) {
        $this->usuario->editarPassword($password);

        $this->eliminarToken();
    }

    public function eliminarToken() {
        $db = DBConexion::getConexion();
        $query= "DELETE FROM recuperar_passwords
                WHERE usuario_fk = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$this->usuario->getUsuarioId()]); 
    }

}