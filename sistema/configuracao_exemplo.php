<?php
 
// ============================================================
//  ARQUIVO DE EXEMPLO — copie para "configuracao.php"
//  e preencha com suas credenciais reais.
// ============================================================
 
// Banco de dados
define('DB_HOST',    'localhost');
define('DB_NOME',    'nome_do_banco');
define('DB_USUARIO', 'seu_usuario');
define('DB_SENHA',   'sua_senha');
 
// URL base da aplicação (sem barra no final)
define('BASE_URL', 'http://localhost/blog');
 
// Caminhos internos (normalmente não precisam ser alterados)
define('CAMINHO_RAIZ',             __DIR__ . '/../');
define('CAMINHO_TEMPLATES_SITE',   __DIR__ . '/../templates/site/');
define('CAMINHO_TEMPLATES_ADMIN',  __DIR__ . '/../templates/admin/');
define('CAMINHO_UPLOADS',          __DIR__ . '/../templates/admin/assets/img/uploads/');