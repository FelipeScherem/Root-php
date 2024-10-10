<?php

namespace App\Repositories;

use App\Interfaces\InterfaceProduto;
use App\Models\ModelProduto;

class RepositoryProduto implements InterfaceProduto
{
	public function produtoCriar(ModelProduto $modelProduto) {
		try {
			$modelProduto->save();
		} catch (\Exception $exception) {
			throw $exception;
		}

		// Retorna o ID do produto criado
		return $modelProduto->id_produto;
	}

	public function produtoListar() {
		try {
			return ModelProduto::all();
		} catch (\Exception $exception) {
			throw $exception;
		}
	}

	public function produtoAtualizar(ModelProduto $modelProduto) {
		try {
			$modelProduto->save();
		} catch (\Exception $exception) {
			throw $exception;
		}

		return NULL; // Retorna null se a operação for bem-sucedida
	}

	public function produtoDeletar(int $idProduto) {
		try {
			ModelProduto::where('id_produto', $idProduto)->delete();
		} catch (\Exception $exception) {
			throw $exception;
		}
	}

	public function produtoBuscar(array $requestProduto) {
		// Mapea os dados do request para uma variavel
		$tipoDeBusca = $requestProduto['tipo_de_busca'];
		$parametroDeBusca = $requestProduto['parametro_de_busca'];

		// Verifica qual o tipo de busca esperado
		if ($tipoDeBusca == 1) {
			$campoDeBusca = 'id_produto';
		} else if ($tipoDeBusca == 2) {
			$campoDeBusca = 'nome_produto';
		} else {
			throw new \Exception('Esperado 1 - ID / 2 - Nome do produto');
		}

		try {
			$dadosPesquisa = ModelProduto::where($campoDeBusca, 'LIKE', "%{$parametroDeBusca}%")->get();
		} catch (\Exception $exception) {
			throw $exception;
		}

		return $dadosPesquisa;
	}
}