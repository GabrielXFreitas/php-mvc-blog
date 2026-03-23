<?php

namespace sistema\Modelo;

use sistema\Nucleo\Modelo;

/**
 * Classe CategoriaModelo
 *
 * @author Gabriel Xavier
 */
class CategoriaModelo extends Modelo
{
    public function __construct()
    {
        parent::__construct('categorias');
    }
    
    public function posts(int $id): ?array
    {
        $busca = (new PostModelo())->busca("categoria_id = {$id}")->resultado(true);
        return $busca;
    }
}
