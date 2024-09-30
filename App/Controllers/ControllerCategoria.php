<?php

namespace App\Controllers;

use App\Models\ModelCategoria;
use App\Repositories\RepositoryCategoria;

class ControllerCategoria
{
	private $repositoryCategoria;

	public function __construct() {
		// Instancia o repositório no construtor
		$this->repositoryCategoria = new RepositoryCategoria();
	}

	// Method: POST
	public function categoriaCriar(): void {

		// Decodifica o JSON
		$requestCategoria = json_decode(file_get_contents('php://input'), TRUE);

		// Valida dados do request
		if (!isset($requestCategoria['nome_categoria'])) {
			http_response_code(400);
			echo json_encode(['error' => 'Dados invalidos', 'campo' => 'nome_categoria']);
			return;
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
			echo json_encode(['mensagem' => 'Erro ao criar a categoria', 'error' => $e->getMessage()]);
		}
	}

	// Method: GET
	public function categoriaListar() {
		try {
			$categorias = $this->repositoryCategoria->categoriaListar();
		} catch (\Exception $e) {
			http_response_code(500);
			// TODO: IMPLEMENTAR O TRATAMENTO DE ERRRO
		}
		echo json_encode($categorias);
	}

	// Method: PUT
	public function categoriaAtualizar() {
		echo "Listou";
	}

	// Method: DELETE
	public function categoriaDeletar() {
		// Recebe os dados do request
		$requestCategoria = json_decode(file_get_contents('php://input'), TRUE);

		// Valida dados do request
		if (!is_array($requestCategoria)) {
			http_response_code(400);
			echo json_encode(['mensagem' => 'Formato inválido. Esperado um array de dados.']);
			return;
		}

		// Valida se a chave existe e é um array
		if (!isset($requestCategoria['id_categoria_produto']) || !is_array($requestCategoria['id_categoria_produto'])) {
			http_response_code(400);
			echo json_encode(['mensagem' => 'Formato inválido. Esperado um array de IDs.', 'campo' => 'id_categoria_produto']);
			return;
		}

		// Verifica se todos os IDs são inteiros
		foreach ($requestCategoria['id_categoria_produto'] as $id) {
			if (!is_numeric($id)) {
				http_response_code(400);
				echo json_encode(['mensagem' => 'Todos os IDs devem ser inteiros.', 'campo' => 'id_categoria_produto']);
				return;
			}
		}

		$modelCategoria = new ModelCategoria();
		$idsQueNaoForamDeletados = [];
		$idsQueForamDeletados = 0;

		foreach ($requestCategoria['id_categoria_produto'] as $id) {
			// Popula o campo para deletar
			$modelCategoria->id_categoria_planejamento = $id;

			// Começa a tentativa de deletar
			try {
				if ($this->repositoryCategoria->categoriaDeletar($modelCategoria)) {
					$idsQueForamDeletados++;
				}
			} catch (\Exception $e) {
				// Apenas registra o erro e continua
				error_log('Erro ao deletar categoria com ID ' . $id . ': ' . $e->getMessage());
				// Adiciona o ID que falhou na deleção
				$idsQueNaoForamDeletados[] = $id;
			}
		}

		http_response_code(200);
		if (!empty($idsQueNaoForamDeletados)) {
			echo json_encode(['mensagem' => 'Categorias deletadas', 'falhas' => $idsQueNaoForamDeletados]);
		} else {
			echo json_encode(['mensagem' => $idsQueForamDeletados . ' categorias deletadas']);
		}


		return;
	}

	// Method: GET
	public function categoriaBuscar() {
		// Decodifica o JSON
		$requestCategoria = json_decode(file_get_contents('php://input'), TRUE);

		// Verifica request
		if (!is_array($requestCategoria)) {
			http_response_code(400);
			echo json_encode(['error' => 'buscar_categoria deve ser um array', 'campo' => 'buscar_categoria']);

			return;
		}
		// Verifica se
		if (!isset($requestCategoria['tipo_de_busca'])) {
			http_response_code(400);
			echo json_encode(['error' => 'Um tipo de busca deve ser definido', 'campo' => 'tipo_de_busca']);
		}

		//

	}
}
