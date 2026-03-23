<?php

namespace sistema\Modelo;

use sistema\Nucleo\Conexao;
use sistema\Modelo\CategoriaModelo;
use sistema\Modelo\UsuarioModelo;
use sistema\Nucleo\Modelo;

/**
 * Classe PostModelo
 *
 * @author Gabriel Xavier
 */
class PostModelo extends Modelo
{
    
    public function __construct()
    {
        parent::__construct('posts');
    }

    public function categorias(): ?CategoriaModelo
    {
        if($this->categoria_id){
            return (new CategoriaModelo())->buscaPorId($this->categoria_id);
        }
        return null;
    }

    public function usuario(): ?UsuarioModelo
    {
        if($this->usuario_id){
            return (new UsuarioModelo())->buscaPorId($this->usuario_id);
        }
        return null;
    }

    public function salvar(): bool
    {
        $this->slug();
        return parent::salvar();
    }

}
