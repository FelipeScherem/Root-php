<?php

namespace App\Util;

class UtilErros
{
	public static function erroSQL(int $codigoHttp, \Exception $e) {
		// Prepara os dados do erro
		$data = array("Código do erro" => $e->getCode(), "Mensagem de erro" => $e->getMessage());

		// Define o código de resposta HTTP
		http_response_code($codigoHttp);

		// Retorna o JSON
		echo json_encode($data);
	}

	public static function erroCamposInvalidos(int $codigoHttp, string $mensagem, ?string $campo = NULL): void {
		http_response_code($codigoHttp);
		$resposta = ['mensagem' => $mensagem];

		if ($campo) {
			$resposta['campo'] = $campo;
		}

		echo json_encode($resposta);
		exit;
	}
}