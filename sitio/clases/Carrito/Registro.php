<?php

namespace FutHistory\Carrito;

use FutHistory\DB\DBConexion;
use PDO;

class Registro {
    protected int $articulo_compra_id;
    protected int $compra_fk;
    protected int $articulo_id;
    protected int $cantidad;

    protected string $table = "articulos_compras";
    protected string $primaryKey = "articulo_compra_id";

    protected array $properties = ['articulo_compra_id', 'compra_fk', 'articulo_id', 'cantidad'];


    public function registrar(array $data) : void
    {
        $db = DBConexion::getConexion();
        $query = "INSERT INTO articulos_compras (compra_fk, articulo_id, cantidad)
                VALUES (:compra_fk, :articulo_id, :cantidad)";
        $stmt = $db->prepare($query);
        $stmt->execute([
        'compra_fk' => $data['compra_fk'],
        'articulo_id' => $data['articulo_id'],
        'cantidad' => $data['cantidad']
        ]);
    }

    public function obtenerPorCompra(int $compra_id): array
    {
        $db = DBConexion::getConexion();
        $query = "SELECT * FROM articulos_compras
                WHERE compra_fk = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$compra_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);

        return $stmt->fetchAll();
    }


    public function getRegistroId(): int 
    {
        return $this->articulo_id;
    }

    public function getCantidad(): int 
    {
        return $this->cantidad;
    }
}