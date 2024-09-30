<?php

namespace App\Util;

require __DIR__ . '/../../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Dotenv\Dotenv;

class UtilConectaDB
{
	public static function setConnection() {
		$capsule = new Capsule;

		// Carrega as variáveis de ambiente corretamente
		$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
		$dotenv->load();

		$host   = $_ENV['DB_HOST'];
		$port   = $_ENV['DB_PORT'];
		$dbname = $_ENV['DB_NAME'];
		$user   = $_ENV['DB_USER'];
		$pass   = $_ENV['DB_PASS'];

		try {
			$capsule->addConnection([
				'driver' => 'mysql',
				'host' => $host,
				'port' => $port,
				'database' => $dbname,
				'username' => $user,
				'password' => $pass,
				'charset' => 'utf8mb4',
				'collation' => 'utf8mb4_unicode_ci',
				'prefix' => '',
			]);

			$capsule->setAsGlobal();
			$capsule->bootEloquent();

		} catch (\PDOException $e) {
			echo json_encode(['mensagem' => 'Houve um erro ao conectar-se ao banco de dados',
				'erro' => $e->getMessage()]);
			exit;
		}
	}
}
