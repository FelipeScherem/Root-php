<?php

namespace App\Controllers;

use App\Models\ModelCategoria;
use App\Repositories\RepositoryCategoria;

class ControllerCategoria {
	private $repositoryCategoria;

	// Corrigido de __contruct para __construct
	public function __construct() {
		// Instancia o repositório no construtor
		$this->repositoryCategoria = new RepositoryCategoria();
	}

	// POST
	public function categoriaCriar(): void {
		$requestCategoria = json_decode(file_get_contents('php://input'), TRUE);

		// Valida dados do request
		if (!isset($requestCategoria['nome_categoria'])) {
			http_response_code(400);
			echo json_encode(['error' => 'Dados invalidos',
				'campo' => 'nome_categoria']);
			return; // Adicionei um return aqui para interromper a execução
		}

		// Instancia e popula model de categoria
		$modelCategoria = new ModelCategoria();
		$modelCategoria->nome_categoria = $requestCategoria['nome_categoria'];

		// Chama o repository para criar a categoria
		try {
			$idCategoria = $this->repositoryCategoria->categoriaCriar($modelCategoria);
			echo json_encode(['id' => $idCategoria, 'message' => 'Categoria criada com sucesso!']);
		} catch (\Exception $e) {
			http_response_code(500);
			echo json_encode(['mensagem'=> 'Erro ao criar a categoria',
				'error' => $e->getMessage()]);
		}
	}

	// DELETE
	public function categoriaListar() {
		echo "Deletou";
	}
	// GET
	public function categoriaAtualizar() {
		echo "Listou";
	}
	// PUT
	public function categoriaDeletar() {
		echo "Atualizou";
	}
}
