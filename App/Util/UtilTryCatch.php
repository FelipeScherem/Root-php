<?php

namespace App\Util;

use Exception;

class UtilTryCatch
{
	public static function executaComFuncao(callable $funcao): void {
		try {
			$funcao();
		} catch (Exception $erro) {
			UtilErros::erroSQL(404, $erro);
		}
	}
}