<?php

/**
 * Devuelve las remeras
 * 
 * @return Remera[] 
 */

function remeras(): array {
    $filename = __DIR__ . '/../json/camisetas.json';
    $jsonContent = file_get_contents($filename);
    $data= json_decode($jsonContent, true);

    $salida= [];
    foreach($data as $valor) {
        $remera = new Remera;
        $remera->setRemeraId($valor['id']);
        $remera->setTitulo($valor['titulo']);
        $remera->setImagen($valor['imagen']);
        $remera->setPrecio($valor['precio']);
        $remera->setAño($valor['año']);
        $remera->setDescripcion($valor['descripcion']);
        $remera->setPais($valor['pais']);
    
        $salida[] = $remera;
    }

    return $salida;
}


/**
 * Devuelve la remera que se seleccione según el id
 * 
 * @return Remera|null
 */

function remeraPorId(int $id): ?Remera {
    $remeras = remeras();
    foreach($remeras as $remera)  {
        if($remera->getRemeraId() == $id) {
            return $remera;
        }
    }

    return null;
}