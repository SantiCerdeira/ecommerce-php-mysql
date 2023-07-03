<?php
namespace FutHistory\Paginacion;

class Paginador {
    protected int $registrosPorPagina;
    protected int $registroInicial;
    protected int $registrosTotales;
    protected int $pagina;
    protected int $paginas;
    
    public function __construct(int $registrosPorPagina){
        $this->registrosPorPagina = $registrosPorPagina;
        $this->pagina = $_GET['p'] ?? 1;
        $this->registroInicial = $this->registrosPorPagina * ($this->pagina - 1);
    }
    
    public function getRegistrosPorPagina():int {
        return $this->registrosPorPagina;
    }    
    
    public function getRegistroInicial():int {
        return $this->registroInicial;
    }
    
    public function setRegistrosTotales(int $registrosTotales){
        $this->registrosTotales = $registrosTotales;
        $this->paginas = ceil($this->registrosTotales / $this->getRegistrosPorPagina());
    }

    public function getRegistrosTotales():int {
        return $this->registrosTotales;
    }

    public function generarPaginacion() {
        PaginacionLinks::generar($this);
    }

    public function getPagina():int {
        return $this->pagina;
    }

    public function getPaginas():int {
        return $this->paginas;
    }
}