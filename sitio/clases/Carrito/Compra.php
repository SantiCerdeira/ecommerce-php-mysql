<?php

namespace FutHistory\Carrito;

use FutHistory\DB\DBConexion;
use PDO;

class Compra {
    protected int $compra_id;
    protected int $usuario_fk;
    protected int $total;
    protected string $fecha;
    protected string $table = "compras";
    protected string $primaryKey = "compra_id";

    protected array $properties = ['compra_id', 'usuario_fk', 'total', 'fecha'];


    public function crear(array $data): void {
        $db = DBConexion::getConexion();
        $query = "INSERT INTO compras (usuario_fk, total, fecha)
                VALUES (:usuario_fk, :total, :fecha)";
        $stmt = $db->prepare($query);
        $stmt->execute([
        'usuario_fk' => $data['usuario_fk'],
        'total' => $data['total'],
        'fecha' => $data['fecha']
        ]);
    }

    public function getPorUsuario(int $usuario_id): ?array {
        $db = DBConexion::getConexion();
        $query = "SELECT * FROM compras
                WHERE usuario_fk = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$usuario_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);

        return $stmt->fetchAll();
    }

    public function ultimaCompra(): self {
        $db = DBConexion::getConexion();
        $query = "SELECT MAX(compra_id) 
                AS ultimaCompra 
                FROM compras";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);
        $compra_id = $stmt->fetch();

        return $compra_id ;
    }

    public function getCompraId(): ?int {
        return $this->compra_id;
    }

    public function getTotal(): int {
        return $this->total;
    }

    public function getFecha(): string {
        return $this->fecha;
    }

    public function getUsuarioCompra(): string {
        return $this->usuario_fk;
    }
}   