<?php

require '../vendor/autoload.php';

try {
	// Verificar se o arquivo .env existe
	if (file_exists(dirname(__DIR__) . '/.env')) {
		echo 'Arquivo .env localizado' . PHP_EOL;
	} else {
		echo 'Arquivo .env não existe.' . PHP_EOL;
	}

	// Carregar as variáveis de ambiente
	$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__)); // Subindo um nível do diretório tests
	$dotenv->load();

	// Depuração
	var_dump($_ENV);

} catch (Exception $e) {
	echo 'Erro ao carregar .env: ' . $e->getMessage();
}
