<?php
namespace App\Util;

require __DIR__ . '/../../vendor/autoload.php';

Use PDO;

class UtilConectaDB
{
    private static $pdo;

    public static function getConnection()
    {
        if (self::$pdo === null) {
            $host = '127.0.0.1:3306';
            $dbname = 'loja404';
            $user = 'root';
            $pass = 'root';

            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

            try {
                self::$pdo = new PDO($dsn, $user, $pass);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Conectado com sucesso!";
            } catch (\PDOException $e) {
                echo json_encode(['mensagem' => 'Houve um erro ao conectar-se ao bando de dados',
                                  'erro' => $e->getMessage()]);
                exit;
            }
        }

        return self::$pdo;
    }
}