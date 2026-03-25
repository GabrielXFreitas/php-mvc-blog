<?php

namespace sistema\Biblioteca;

class Upload
{

    public $arquivo;
    public $subDiretorio;
    public $nome;
    public $diretorio;

    public function __construct(string $diretorio)
    {
        $this->diretorio = $diretorio ?? 'uploads';

        if (!file_exists($this->diretorio . DIRECTORY_SEPARATOR . $this->arquivo) && !is_dir($this->diretorio . DIRECTORY_SEPARATOR . $this->arquivo)) {
            mkdir($this->diretorio, 0755);
        }
    }

    public function arquivo(array $arquivo, string $nome = null, string $subDiretorio = null): void
    {
        $this->arquivo = $arquivo;
        $this->nome = $nome ?? pathinfo($arquivo['name'], PATHINFO_FILENAME);
        $this->subDiretorio = $subDiretorio ?? 'arquivos';

        $this->criarSubDiretorio();
        $this->renomearArquivo();
        $this->moverArquivo();
    }

    public function criarSubDiretorio()
    {
        if (!file_exists($this->diretorio . DIRECTORY_SEPARATOR . $this->subDiretorio) && !is_dir($this->diretorio . DIRECTORY_SEPARATOR . $this->subDiretorio)) {
            mkdir($this->diretorio . DIRECTORY_SEPARATOR . $this->subDiretorio, 0755);
        }
    }

    public function renomearArquivo()
    {
        $arquivo = $this->nome . strrchr($this->arquivo['name'], '.');
        if (file_exists($this->diretorio . DIRECTORY_SEPARATOR . $this->subDiretorio . DIRECTORY_SEPARATOR . $this->nome)) {
            $arquivo = $this->nome . '-' . uniqid() . strrchr($this->arquivo['name'], '.');
        }
        $this->nome = $arquivo;
    }

    public function moverArquivo()
    {
        if (move_uploaded_file($this->arquivo['tmp_name'], $this->diretorio . DIRECTORY_SEPARATOR . $this->subDiretorio . DIRECTORY_SEPARATOR . $this->nome)) {
            echo $this->nome . ' foi movido com sucesso!';
        } else {
            echo 'Erro no upload!';
        }
    }
}
