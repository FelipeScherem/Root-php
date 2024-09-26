<?php

require '../vendor/autoload.php';

try {
	// Verificar se o arquivo .env existe
	if (file_exists(dirname(__DIR__) . '/.env')) {
		echo '.env file exists.' . PHP_EOL;
	} else {
		echo '.env file does not exist.' . PHP_EOL;
	}

	// Carregar as variáveis de ambiente
	$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__)); // Subindo um nível do diretório tests
	$dotenv->load();

	// Depuração
	var_dump(getenv('DB_HOST'));
	var_dump(getenv('DB_PORT'));
	var_dump(getenv('DB_NAME'));
	var_dump(getenv('DB_USER'));
	var_dump(getenv('DB_PASS'));
} catch (Exception $e) {
	echo 'Error loading .env: ' . $e->getMessage();
}
