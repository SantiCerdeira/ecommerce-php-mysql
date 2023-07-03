<?php

namespace FutHistory\Validacion;

class ValidarInicioSesion {
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
        if(empty($this->data['email'])) {
            $this->errores['email'] = "Tenés que ingresar un email.";
        }

        if(empty($this->data['password'])) {
            $this->errores['password'] = "Tenés que ingresar tu contraseña.";
        }
    }
}