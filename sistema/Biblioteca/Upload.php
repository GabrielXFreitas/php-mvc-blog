<?php 

namespace sistema\Biblioteca;

class Upload {

    public $arquivo;
    public $subDiretorio;
    public $nome;
    public $diretorio;

    public function __construct(string $diretorio)
    {
        $this->diretorio = $diretorio ?? 'uploads';

        if(!file_exists($this->diretorio.DIRECTORY_SEPARATOR.$this->arquivo) && !is_dir($this->diretorio.DIRECTORY_SEPARATOR.$this->arquivo)){
            mkdir($this->diretorio, 0755);
        }
    }

    public function arquivo(array $arquivo, string $subDiretorio = null): void
    {
        $this->arquivo = $arquivo;
        $this->subDiretorio = $subDiretorio ?? 'arquivos';

        $this->criarSubDiretorio();
        $this->moverArquivo();
    }

    public function criarSubDiretorio()
    {
        if(!file_exists($this->diretorio.DIRECTORY_SEPARATOR.$this->subDiretorio) && !is_dir($this->diretorio.DIRECTORY_SEPARATOR.$this->subDiretorio)){
            mkdir($this->diretorio.DIRECTORY_SEPARATOR.$this->subDiretorio, 0755);
        }
    }

    public function moverArquivo()
    {
        if(move_uploaded_file($this->arquivo['tmp_name'], $this->diretorio.DIRECTORY_SEPARATOR.$this->subDiretorio.DIRECTORY_SEPARATOR.$this->arquivo['name'])){
            echo $this->arquivo['name']. ' foi movido com sucesso!';
        }else{
            echo 'Erro no upload!';
        }
    }
}