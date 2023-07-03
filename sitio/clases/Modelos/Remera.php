<?php

namespace FutHistory\Modelos;

use FutHistory\DB\DBConexion;
use FutHistory\Paginacion\Paginador;
use PDO;


class Remera extends ModeloBase {
    protected int $camiseta_id;
    protected int $usuario_fk;
    protected int $continente_fk;
    protected string $titulo;
    protected string $imagen;
    protected int $precio;
    protected ?string $descripcion;
    protected ?string $pais;
    protected ?string $equipo;
    protected Continente $continente;
    protected string $table = "camisetas";
    protected string $primaryKey = "camiseta_id";
    protected Paginador $paginador;

    protected array $properties = ['camiseta_id', 'usuario_fk', 'continente_fk', 'titulo', 'imagen', 'precio', 'descripcion', 'pais', 'equipo'];

    /**
     * Devuelve las remeras
     * 
     * @param int $registrosPorPagina
     * @param array $registrosPorPagina
     * @return Remera[] 
     */

    public function remeras(int $registrosPorPagina = 10): array {
        $this->paginador = new Paginador($registrosPorPagina);

        $db = DBConexion::getConexion();
        $query = "SELECT camisetas.*, continentes.continente_id, continentes.nombre AS 'continente' FROM camisetas
                    INNER JOIN continentes 
                    ON camisetas.continente_fk = continentes.continente_id
                    LIMIT {$this->paginador->getRegistrosPorPagina()} OFFSET {$this->paginador->getRegistroInicial()}";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $salida= [];
        while($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new self;
            $obj->loadProperties($fila); 

            $continente = new Continente;
            $continente->loadProperties([
                'continente_id' => $fila['continente_id'],
                'nombre' => $fila['continente'],
            ]);
            $obj->setContinente($continente);

            $salida[] = $obj;
        }

        $queryPaginacion = "SELECT COUNT(*) AS 'total' FROM camisetas";
        $stmtPag = $db->prepare($queryPaginacion);
        $stmtPag->execute();
        $filaPag = $stmtPag->fetch();
        $this->paginador->setRegistrosTotales($filaPag['total']);
    
        return $salida;
    }

    /**
     * Agrega una nueva camiseta a la base de datos
     * 
     * @params array $data
     * @throws PDOException
     */
    public function crear(array $data): void {
        $db = DBConexion::getConexion();
        $query = "INSERT INTO camisetas (usuario_fk, titulo, descripcion, precio, imagen, pais, equipo, continente_fk)
                VALUES (:usuario_fk, :titulo, :descripcion, :precio, :imagen, :pais, :equipo, :continente_fk)";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'usuario_fk' => $data['usuario_fk'],
            'titulo' => $data['titulo'],
            'descripcion' => $data['descripcion'],
            'precio' => $data['precio'],
            'imagen' => $data['imagen'],
            'pais' => $data['pais'],
            'equipo' => $data['equipo'],
            'continente_fk' => $data['continente_fk']
        ]);
    }


    /**
     * Edita una camiseta
     * 
     * 
     * @throws PDOException
     */
    public function editar(int $id, array $data) : void {
        $db = DBConexion::getConexion();
        $query = "UPDATE camisetas
                  SET usuario_fk    = :usuario_fk,
                      titulo        = :titulo,
                      descripcion   = :descripcion,
                      precio        = :precio,
                      imagen        = :imagen,
                      pais          = :pais,
                      equipo        = :equipo,
                      continente_fk = :continente_fk
                  WHERE camiseta_id = :camiseta_id";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'camiseta_id'       => $id,
            'usuario_fk'        => $data['usuario_fk'],
            'titulo'            => $data['titulo'],
            'descripcion'       => $data['descripcion'],
            'precio'            => $data['precio'],
            'imagen'            => $data['imagen'],
            'pais'              => $data['pais'],
            'equipo'            => $data['equipo'],
            'continente_fk'     => $data['continente_fk']
        ]);
    }

    /**
     * Elimina una camiseta
     * 
     * 
     * @throws PDOException
     */
    public function eliminar() : void {
        $db = DBConexion::getConexion();
        $query = "DELETE FROM camisetas
                WHERE camiseta_id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$this->getRemeraId()]);
    }

    // Setters & Getters

    public function setRemeraId(int $camiseta_id) : void {
        $this->camiseta_id = $camiseta_id;
    }

    public function getRemeraId() : int {
        return $this->camiseta_id;
    }


    public function setTitulo(string $titulo) : void {
        $this->titulo = $titulo;
    }

    public function getTitulo() : string {
        return $this->titulo;
    }


    public function setImagen(string $imagen) : void {
        $this->imagen = $imagen;
    }

    public function getImagen() : string {
        return $this->imagen;
    }


    public function setPrecio(int $precio) : void {
        $this->precio = $precio;
    }

    public function getPrecio() : int {
        return $this->precio;
    }

    public function setDescripcion(?string $descripcion) : void {
        $this->descripcion = $descripcion;
    }

    public function getDescripcion() : ?string {
        return $this->descripcion;
    }


    public function setPais(?string $pais) : void {
        $this->pais = $pais;
    }

    public function getPais() : ?string {
        return $this->pais;
    }

    public function setEquipo(?string $equipo) : void {
        $this->equipo = $equipo;
    }

    public function getEquipo() : ?string {
        return $this->equipo;
    }


    public function setUsuarioFK(int $usuario_fk) : void {
        $this->usuario_fk = $usuario_fk;
    }

    public function getUsuarioFK() : int {
        return $this->usuario_fk;
    }


    public function setContinenteFK(int $continente_fk) : void {
        $this->continente_fk = $continente_fk;
    }

    public function getContinenteFK() : int {
        return $this->continente_fk;
    }

    public function setContinente(Continente $continente) : void {
        $this->continente = $continente;
    }

    public function getContinente() : Continente {
        return $this->continente;
    }

    public function getPaginador() : Paginador {
        return $this->paginador;
    }
}