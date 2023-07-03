<?php

namespace FutHistory\Modelos;

use FutHistory\DB\DBConexion;
use PDO;

class Continente extends ModeloBase {
    protected int $continente_id;
    protected string $nombre;
    protected string $table = "continentes";
    protected string $primaryKey = "continente_id";

    protected array $properties = ['continente_id', 'nombre'];

    public function getContinenteId(): int {
        return $this->continente_id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }
}