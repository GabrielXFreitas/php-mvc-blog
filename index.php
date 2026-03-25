<?php

//Arquivo index responsável pela inicialização do sistema
require 'vendor/autoload.php';

//require 'rotas.php';
use sistema\Biblioteca\Upload;

$upload = new Upload('upload');

if(!empty($arquivo = $_FILES)){
    $arquivo = $_FILES['arquivo'];
    $upload->arquivo($arquivo, 'textos');
}
if($upload->getResultado()){
    echo 'Arquivo enviado com sucesso!';
}else{
    $upload->getErro();
}


?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="arquivo"> 
    <button>Enviar Arquivo</button>
</form>