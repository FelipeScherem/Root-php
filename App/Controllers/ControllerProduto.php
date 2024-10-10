<?php

namespace App\Controllers;

use App\Util\Util;
use App\Util\UtilErros;
use App\Models\ModelProduto;
use App\Repositories\RepositoryProduto;

class ControllerProduto
{
	// ###################### Construct #######################
	private $produtoRepository;
	private $produtoModel;

	public function __construct() {
		$this->produtoRepository = new RepositoryProduto();
		$this->produtoModel = new ModelProduto();
	}

	//  ################ Funções de validação ######################
	private function ValidarRequest(mixed $requestProduto): void {
		if (!isset($requestProduto['id_categoria'])) {
			UtilErros::erroCamposInvalidos(400, 'ID de categoria do produto, vazio', 'id_categoria');
		}

		if (!is_int($requestProduto['id_categoria'])) {
			UtilErros::erroCamposInvalidos(400, 'ID de categoria do produto, deve ser um inteiro', 'id_categoria');
		}

		if (!isset($requestProduto['nome_do_produto'])) {
			UtilErros::erroCamposInvalidos(400, 'Nome do produto, vazio', 'nome_do_produto');
		}

		if (!isset($requestProduto['valor_produto'])) {
			UtilErros::erroCamposInvalidos(400, 'Valor do produto, vazio', 'valor_produto');
		}

		if (!is_float($requestProduto['valor_produto'])) {
			UtilErros::erroCamposInvalidos(400, 'Valor do produto, deve ser um float', 'valor_produto');
		}
	}

	private function PopulaModel($requestProduto): ModelProduto {
		$modelProduto = $this->produtoModel;

		$modelProduto->id_categoria_produto = $requestProduto['id_categoria'];
		$modelProduto->nome_produto = $requestProduto['nome_do_produto'];
		$modelProduto->valor_produto = $requestProduto['valor_produto'];
		return $modelProduto;
	}

	// #################### END-POINTS ####################
	// Method: POST
	public function produtoCriar(): void {
		$requestProduto = Util::bindJson();
		$this->ValidarRequest($requestProduto);

		$modelProduto = $this->PopulaModel($requestProduto);

		Util::tryCatchChamaRepository(function () use ($modelProduto) {
			$idProdutp = $this->produtoRepository->produtoCriar($modelProduto);
			http_response_code(201);
			echo json_encode(['id' => $idProdutp, 'message' => 'Produto criado com sucesso!']);
		});
	}

	// Method: GET
	public function produtoListar(): void {
		Util::tryCatchChamaRepository(function () {
			$produtos = $this->produtoRepository->produtoListar();
			http_response_code(200);
			echo json_encode($produtos);
		});
	}

	// Method: PUT
	public function produtoAtualizar(): void {
		$requestProduto = Util::bindJson();
		$this->ValidarRequest($requestProduto);

		// Busca o produto existente
		$produtoExistente = $this->produtoModel->find($requestProduto['id_produto']);
		if (!$produtoExistente) {
			UtilErros::erroCamposInvalidos(404, 'Produto não encontrado');
		}

		// Preenche os campos que serão atualizados
		$produtoExistente->fill(['id_categoria_produto' => $requestProduto['id_categoria'], 'nome_produto' => $requestProduto['nome_do_produto'], 'valor_produto' => $requestProduto['valor_produto'],]);

		Util::tryCatchChamaRepository(function () use ($produtoExistente) {
			$produtoExistente->save(); // Atualiza o produto
		});

		http_response_code(200);
		echo json_encode(['message' => 'Produto atualizado com sucesso!']);
	}

	// Method: DELETE
	public function produtoDeletar(): void {
		$requestProduto = Util::bindJson();
		if (!isset($requestProduto['id_produto']) || !is_array($requestProduto['id_produto'])) {
			UtilErros::erroCamposInvalidos(400, 'Campo deve ser um  array de int', 'id_produto');
			return;
		}

		foreach ($requestProduto['id_produto'] as $id) {
			if (!is_numeric($id)) {
				UtilErros::erroCamposInvalidos(400, 'Campo deve ser um  array de int', 'id_produto');
			}
		}

		$id_produto = $requestProduto['id_produto'];

		foreach ($id_produto as $id) {
			Util::tryCatchChamaRepository(function () use ($id) {
				$this->produtoRepository->produtoDeletar($id);
				http_response_code(200);
				echo json_encode(['message' => 'Produto deletado com sucesso!']);
			});
		}

	}

	public function produtoBuscar(): void {
		$requestBusca = Util::bindJson();
		Util::validaBusca($requestBusca);

		Util::tryCatchChamaRepository(function () use ($requestBusca) {
			$resultadoDaBusca = $this->produtoRepository->produtoBuscar($requestBusca);
			http_response_code(200);
			echo json_encode($resultadoDaBusca);
		});
	}
}
