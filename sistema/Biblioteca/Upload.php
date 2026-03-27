<?php

namespace sistema\Biblioteca;

class Upload
{

    private ?array $arquivo = null;
    private ?string $subDiretorio;
    private ?string $nome;
    private ?string $diretorio;
    private ?int $tamanho;
    private ?string $resultado = null;
    private ?string $erro;

    public function __construct(string $diretorio)
    {
        $this->diretorio = $diretorio ?? 'uploads';

        if (!file_exists($this->diretorio . DIRECTORY_SEPARATOR . $this->arquivo) && !is_dir($this->diretorio . DIRECTORY_SEPARATOR . $this->arquivo)) {
            mkdir($this->diretorio, 0755);
        }
    }

    public function getResultado(): ?string
    {
        return $this->resultado;
    }

    public function getErro(): ?string
    {
        return $this->erro;
    }

    public function arquivo(array $arquivo, string $nome = null, string $subDiretorio = null, int $tamanho = null): void
    {
        $this->arquivo = $arquivo;
        $this->nome = $nome ?? pathinfo($arquivo['name'], PATHINFO_FILENAME);
        $this->subDiretorio = $subDiretorio ?? 'arquivos';
        $this->tamanho = $tamanho ?? 1;

        //$tiposValidos = ['aplication/pdf', 'text/plain', 'Arquivo JPEG (.jpeg)'];
        $extensoesValidas = ['png', 'jpg', 'jpeg'];
        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);

        if(!in_array($extensao, $extensoesValidas)){
            $this->erro = 'Extensão inválida do arquivo! Apenas: '. implode(',', $extensoesValidas);
        //}elseif(!in_array($arquivo['type'], $tiposValidos )){
        //    $this->erro = 'Tipo de arquivo inválido!';
        }elseif($arquivo['size'] > $this->tamanho*(1024*1024)){
            $this->erro = "Tamanho do arquivo maior que {$this->tamanho}MB";
        }else{
            $this->criarSubDiretorio();
            $this->renomearArquivo();
            $this->moverArquivo();
        }
    }

    private function criarSubDiretorio()
    {
        if (!file_exists($this->diretorio . DIRECTORY_SEPARATOR . $this->subDiretorio) && !is_dir($this->diretorio . DIRECTORY_SEPARATOR . $this->subDiretorio)) {
            mkdir($this->diretorio . DIRECTORY_SEPARATOR . $this->subDiretorio, 0755);
        }
    }

    private function renomearArquivo()
    {
        $arquivo = $this->nome . strrchr($this->arquivo['name'], '.');
        if (file_exists($this->diretorio . DIRECTORY_SEPARATOR . $this->subDiretorio . DIRECTORY_SEPARATOR . $this->nome)) {
            $arquivo = $this->nome . '-' . uniqid() . strrchr($this->arquivo['name'], '.');
        }
        $this->nome = $arquivo;
    }

    private function moverArquivo()
    {
        if (move_uploaded_file($this->arquivo['tmp_name'], $this->diretorio . DIRECTORY_SEPARATOR . $this->subDiretorio . DIRECTORY_SEPARATOR . $this->nome)) {
            $this->resultado = $this->nome;
        } else {
            $this->resultado = null; 
            $this->erro = 'Erro ao enviar arquivo';
        }
    }
}
