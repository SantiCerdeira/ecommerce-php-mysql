<?php

namespace FutHistory\Modelos;

use FutHistory\DB\DBConexion;
use PDO;

class Usuario extends ModeloBase {
    protected int $usuario_id;
    protected int $rol_fk;
    protected string $nombre;
    protected string $apellido;
    protected string $email;
    protected string $password;
    protected string $table = "usuarios";
    protected string $primaryKey = "usuario_id";

    protected array $properties = ['usuario_id', 'rol_fk', 'nombre', 'apellido', 'password', 'email'];

    public function obtenerPorEmail(string $email): ?self {
        $db = DBConexion::getConexion();
        $query = "SELECT * FROM usuarios
                WHERE email = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$email]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        $usuario = $stmt->fetch();

        return $usuario ? $usuario : null;
    }
    
    public function crear(array $data) {
        $db = DBConexion::getConexion();
        $query = "INSERT INTO usuarios(nombre,apellido,email,password,rol_fk)
                VALUES(:nombre, :apellido, :email, :password, :rol_fk)";
        $db->prepare($query)->execute([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'password' => $data['password'],
            'rol_fk' => $data['rol_fk'],
        ]);
    }

    public function editarPassword(string $password) {
        $db = DBConexion::getConexion();
        $query = "UPDATE usuarios
                SET password = :password
                WHERE usuario_id = :usuario_id";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'password' => $password,
            'usuario_id' => $this->usuario_id,
        ]);
    }


    public function getNombre() : string {
        return $this->nombre;
    }

    public function getApellido() : string {
        return $this->apellido;
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function getPassword() : string {
        return $this->password;
    }

    public function getUsuarioId() : int {
        return $this->usuario_id;
    }

    public function getRolFK() : int {
        return $this->rol_fk;
    }
}