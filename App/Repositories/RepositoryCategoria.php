<?php

namespace App\Repositories;

use Throwable;
use App\Models\ModelCategoria;
use App\Interfaces\InterfaceCategoria;


class RepositoryCategoria implements InterfaceCategoria
{
	public function categoriaCriar(ModelCategoria $modelCategoria) {
		try {
			// Salva o produto no banco de dados
			$modelCategoria->save();
		} catch (\Exception $exception) {
			return $exception->getMessage();
		}

		// Retorna o ID do produto criado
		return $modelCategoria->id_categoria_planejamento;
	}

	public function categoriaListar() {
		try {
			return ModelCategoria::all();
		} catch (\Exception $exception) {
			return $exception->getMessage();
		}
	}

	public function categoriaAtualizar(ModelCategoria $modelCategoria) {
		try {
			// Atualize apenas os campos necessários
			$modelCategoria->save(['nome_categoria' => $modelCategoria->nome_categoria]);
		} catch (\Exception $exception) {
			return $exception->getMessage();
		}
		return NULL;
	}

	public function categoriaDeletar(int $idCategoria) {
		try {
			ModelCategoria::where('id_categoria_planejamento', $idCategoria)->delete();
			return TRUE;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function categoriaBuscar(array $requestCategoria) {

		// Mapea os dados do request para uma variavel
		$tipoDeBusca = $requestCategoria['tipo_de_busca'];
		$parametroDeBusca = $requestCategoria['parametro_de_busca'];

		// Verifica qual o tipo de busca esperado
		if ($tipoDeBusca == 1) {
			$campoDeBusca = 'id_categoria_planejamento';
		} else if ($tipoDeBusca == 2) {
			$campoDeBusca = 'nome_categoria';
		} else {
			throw new \Exception('Esperado 1 - ID / 2 - NomeCategoria');
		}

		try {
			$dadosPesquisa = ModelCategoria::where($campoDeBusca, 'LIKE', "%{$parametroDeBusca}%")->get();
		} catch (\Exception $e) {
			return $e->getMessage();
		}

		return $dadosPesquisa;
	}
}