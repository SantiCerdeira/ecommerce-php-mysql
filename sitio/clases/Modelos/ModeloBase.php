<?php

namespace FutHistory\Modelos;

use FutHistory\DB\DBConexion;
use PDO;
use PDOException;

class ModeloBase {

    protected string $table = "";
    protected string $primaryKey = "";
    protected array $properties = [];

    /**
     * Carga los valores de data que estén dentro de properties
     * 
     * @param array $data
     */

    public function loadProperties(array $data) {
        foreach($data as $key => $value) {
            if(in_array($key, $this->properties)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * Obtiene un objeto según su id
     * 
     * @return static|null
     */

    public function obtenerPorId(int $id): ?self {
        $db = DBConexion::getConexion();
        $query = "SELECT * FROM {$this->table}
                WHERE {$this->primaryKey} = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);
        $obj = $stmt->fetch();

        return $obj ? $obj : null;
    }


    /**
     * @return static|null
     */
    public function todo(): array {
        $db = DBConexion::getConexion();
        $query = "SELECT * FROM {$this->table}";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);

        return $stmt->fetchAll();
    }
}