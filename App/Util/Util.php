<?php

namespace App\Util;

use Exception;

class Util
{
	public static function tryCatchChamaRepository(callable $funcao): void {
		try {
			$funcao();
		} catch (\Exception $erro) {
			UtilErros::erroSQL(404, $erro);
			exit;
		}
	}

	public static function bindJson() {
		$requestProduto = json_decode(file_get_contents('php://input'), TRUE);

		if ($requestProduto === NULL) {
			UtilErros::erroCamposInvalidos(400, 'Request inválidos', 'JSON body');
			return NULL;
		}

		return $requestProduto;
	}

	public static function validaBusca($requestBusca) {
		if (!isset($requestBusca['tipo_de_busca'])) {
			UtilErros::erroCamposInvalidos(400, 'O tipo de busca deve ser informado', 'tipo_de_busca');
		} else if (!is_int($requestBusca['tipo_de_busca'])) {
			UtilErros::erroCamposInvalidos(400, 'O tipo de busca deve ser um inteiro', 'tipo_de_busca');
		}

		if (!isset($requestBusca['parametro_de_busca'])) {
			UtilErros::erroCamposInvalidos(400, 'Um parametro para busca deve ser informado', 'parametro_de_busca');
		}
	}
}