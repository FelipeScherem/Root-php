<?php

namespace App\Controllers;

use App\Util\UtilErros;
use App\Util\UtilTryCatch;
use App\Models\ModelProduto;
use App\Repositories\RepositoryProduto;

class ControllerProduto
{
	private $produtoRepository;
	private $produtoModel;

	public function __construct() {
		$this->produtoRepository = new RepositoryProduto();
		$this->produtoModel = new ModelProduto();
	}

	// Method: POST
	public function produtoCriar(): void {
		$requestProduto = $this->BindJson();
		if (!$this->ValidarRequest($requestProduto)) {
			return;
		}

		$modelProduto = $this->PopulaModel($requestProduto);

		UtilTryCatch::executaComFuncao(function () use ($modelProduto) {
			$this->produtoRepository->produtoCriar($modelProduto);
			http_response_code(201);
			echo json_encode(['message' => 'Produto criado com sucesso!']);
		});
	}

	// Method: GET
	public function produtoListar(): void {
		UtilTryCatch::executaComFuncao(function () {
			$produtos = $this->produtoRepository->produtoListar();
			http_response_code(200);
			echo json_encode($produtos);
		});
	}

	// Method: PUT
	public function produtoAtualizar(): void {
		$requestProduto = $this->BindJson();
		if ($this->ValidarRequest($requestProduto)) {
			return;
		}

		$modelProduto = $this->PopulaModel($requestProduto);

		UtilTryCatch::executaComFuncao(function () use ($modelProduto) {
			$this->produtoRepository->produtoAtualizar($modelProduto);
			http_response_code(200);
			echo json_encode(['message' => 'Produto atualizado com sucesso!']);
		});
	}

	// Method: DELETE
	public function produtoDeletar(): void {
		$requestProduto = $this->BindJson();
		if (!isset($requestProduto['id_produto']) || !is_int($requestProduto['id_produto'])) {
			UtilErros::erroCamposInvalidos(400, 'Campo deve ser um int', 'id_produto');
			return;
		}

		$modelProduto = $this->produtoModel;
		$modelProduto->id_produto = $requestProduto['id_produto'];

		UtilTryCatch::executaComFuncao(function () use ($modelProduto) {
			$this->produtoRepository->produtoDeletar($modelProduto);
			http_response_code(200);
			echo json_encode(['message' => 'Produto deletado com sucesso!']);
		});
	}

	private function ValidarRequest(mixed $requestProduto): bool {
		if (!isset($requestProduto['id_categoria'])) {
			UtilErros::erroCamposInvalidos(400, 'ID de categoria do produto, vazio', 'id_categoria');
			return FALSE;
		}

		if (!is_int($requestProduto['id_categoria'])) {
			UtilErros::erroCamposInvalidos(400, 'ID de categoria do produto, deve ser um inteiro', 'id_categoria');
			return FALSE;
		}

		if (!isset($requestProduto['nome_do_produto'])) {
			UtilErros::erroCamposInvalidos(400, 'Nome do produto, vazio', 'nome_do_produto');
			return FALSE;
		}

		if (!isset($requestProduto['valor_produto'])) {
			UtilErros::erroCamposInvalidos(400, 'Valor do produto, vazio', 'valor_produto');
			return FALSE;
		}

		if (!is_float($requestProduto['valor_produto'])) {
			UtilErros::erroCamposInvalidos(400, 'Valor do produto, deve ser um float', 'valor_produto');
			return FALSE;
		}
		return TRUE;
	}

	private function PopulaModel($requestProduto): ModelProduto {
		$modelProduto = $this->produtoModel;

		$modelProduto->id_categoria_produto = $requestProduto['id_categoria'];
		$modelProduto->nome_produto = $requestProduto['nome_do_produto'];
		$modelProduto->valor_produto = $requestProduto['valor_produto'];
		return $modelProduto;
	}

	private function BindJson() {
		$requestProduto = json_decode(file_get_contents('php://input'), TRUE);

		if ($requestProduto === NULL) {
			UtilErros::erroCamposInvalidos(400, 'Request inválidos', 'JSON body');
			return NULL;
		}

		return $requestProduto;
	}
}
