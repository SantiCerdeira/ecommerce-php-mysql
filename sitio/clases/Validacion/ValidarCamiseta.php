<?php

namespace FutHistory\Validacion;

class ValidarCamiseta {
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
        if(empty($this->data['titulo'])) {
            $this->errores['titulo'] = "La camiseta debe tener un título.";
        } else if(strlen($this->data['titulo']) < 10) {
            $this->errores['titulo'] = "El título de la camiseta debe tener al menos 10 caracteres";
        }

        if(empty($this->data['precio'])) {
            $this->errores['precio'] = "La camiseta debe tener un precio.";
        }

        if($this->data['imagen']['size'] == 0) {
            $this->errores['imagen'] = "La camiseta debe tener una imagen.";
        }
    }
}