<?php

namespace App\Controllers;

use App\Models\ModelProduto;

class ControllerProduto
{
	private $produtoModel;

	public function __construct() {
		$this->produtoModel = new ModelProduto();
	}

	// POST: Cria produto e retorna um json com id do produto criado
	public function produtoCriar() {
		$data = json_decode(file_get_contents('php://input'), TRUE);

		if (!isset($data['nome'], $data['preco'])) {
			http_response_code(400);
			echo json_encode(['error' => 'Dados incompletos. Nome e preço são obrigatórios.']);
			return;
		}

		$nome = $data['nome'];
		$preco = $data['preco'];

		$id = $this->produtoModel->produtoCriar($nome, $preco);

		echo json_encode(['id' => $id, 'message' => 'Produto criado com sucesso!']);
	}

	// DELETE: Cria produto e retorna um json com id do produto Deletado
	public function produtoDeletar() {
		if (!isset($_GET['id'])) {
			http_response_code(400);
			echo json_encode(['error' => 'ID do produto é obrigatório.']);
			return;
		}

		$id = $_GET['id'];

		$rowsDeleted = $this->produtoModel->produtoDeletar($id);

		if ($rowsDeleted > 0) {
			echo json_encode(['message' => 'Produto deletado com sucesso!']);
		} else {
			http_response_code(404);
			echo json_encode(['error' => 'Produto não encontrado']);
		}
	}

	// GET: Lista todos os produtos
	public function produtoListar() {
		echo "Listar";
	}

	// PUT: Atualiza um produto baseado no id
	public function produtoAtualizar() {
		echo "Atualizar";
	}
}