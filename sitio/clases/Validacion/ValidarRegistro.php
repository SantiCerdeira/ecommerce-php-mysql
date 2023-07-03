<?php

namespace FutHistory\Validacion;

class ValidarRegistro {
    protected array $data = [];

    protected array $errores = [];

    public function __construct(array $data) {
        $this->data = $data;
        $this->validar();
    }
 
    public function hayErrores(): bool {
        return !empty($this->errores);
    }

    public function getErrores(): array {
        return $this->errores;
    }

    protected function validar(): void {
        if(empty($this->data['nombre'])) {
            $this->errores['nombre'] = "Tenés que ingresar un nombre.";
        }

        if(empty($this->data['apellido'])) {
            $this->errores['apellido'] = "Tenés que ingresar un apellido.";
        }

        if(empty($this->data['email'])) {
            $this->errores['email'] = "Tenés que ingresar un email.";
        }

        if(empty($this->data['password'])) {
            $this->errores['password'] = "Tenés que ingresar tu contraseña.";
        }

        if(empty($this->data['password_confirmacion'])) {
            $this->errores['password_confirmacion'] = "Tenés que ingresar la confirmación de tu contraseña.";
        }

        if($this->data['password'] != $this->data['password_confirmacion']) {
            $this->errores['password_error'] = "Las contraseñas no coinciden";
        }
    }
}