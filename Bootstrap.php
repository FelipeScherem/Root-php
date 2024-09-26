<?php
// ####################################### ARQUIVOS DE INICIALIZAÇÃO E CONFIGURAÇÃO #######################################
// Configurações de exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Definindo cabeçalhos para JSON
header('Content-Type: application/json');

// Autoloading do Composer
require_once __DIR__ . '/vendor/autoload.php';

// Inicialização do Eloquent ORM
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
	'driver'    => 'mysql',
	'host'      => '127.0.0.1:3306',
	'database'  => 'loja404',
	'username'  => 'root',
	'password'  => 'root',
	'charset'   => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();