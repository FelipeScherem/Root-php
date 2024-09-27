<?php
namespace App\Util;

require __DIR__ . '/../../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

class UtilConectaDB
{
	public static function setConnection() {
		$capsule = new Capsule;

		$host = '127.0.0.1'; // Apenas o IP
		$port = '3306'; // Porta separada
		$dbname = 'loja404';
		$user = 'root';
		$pass = 'root';

		try {
			$capsule->addConnection([
				'driver' => 'mysql',
				'host' => $host,
				'port' => $port, // Passando a porta aqui
				'database' => $dbname,
				'username' => $user,
				'password' => $pass,
				'charset' => 'utf8mb4',
				'collation' => 'utf8mb4_unicode_ci',
				'prefix' => '',
			]);

			echo json_encode(['mensagem' => 'Conectado ao DB com sucesso!']);

			// Configura o Eloquent para usar o Capsule
			$capsule->setAsGlobal();
			$capsule->bootEloquent();

		} catch (\PDOException $e) {
			echo json_encode(['mensagem' => 'Houve um erro ao conectar-se ao banco de dados',
				'erro' => $e->getMessage()]);
			exit;
		}
	}
}
