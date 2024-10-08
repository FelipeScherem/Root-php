<?php

namespace App\Controllers;

use App\Models\ModelCategoria;
use App\Repositories\RepositoryCategoria;

class ControllerCategoria
{
	protected $repositoryCategoria;
	protected $modelCategoria;

	public function __construct() {
		$this->repositoryCategoria = new RepositoryCategoria();
		$this->modelCategoria = new ModelCategoria();
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
		$modelCategoria = $this->modelCategoria;
		$modelCategoria->nome_categoria = $requestCategoria['nome_categoria'];

		// Chama o repository para criar a categoria
		try {
			$idCategoria = $this->repositoryCategoria->categoriaCriar($modelCategoria);
			echo json_encode(['id' => $idCategoria, 'message' => 'Categoria criada com sucesso!']);
			return;
		} catch (\Exception $e) {
			http_response_code(500);
			echo json_encode(['mensagem' => 'Erro ao criar a categoria', 'error' => $e->getMessage()]);
			return;
		}
	}

	// Method: GET
	public function categoriaListar(): void {
		try {
			$categorias = $this->repositoryCategoria->categoriaListar();
		} catch (\Exception $e) {
			http_response_code(500);
			echo json_encode(['mensagem' => 'Ocorreu um erro ao listar as categorias', 'error' => $e->getMessage()]);
		}
		echo json_encode($categorias);
		return;
	}

	// Method: PUT
	public function categoriaAtualizar(): void {
		// Decodifica o JSON
		$requestCategoria = json_decode(file_get_contents('php://input'), TRUE);

		// Valida dados do request
		if (!isset($requestCategoria['id_categoria'])) {
			http_response_code(400);
			echo json_encode(['error' => 'Dados inválidos', 'campo' => 'id_categoria']);
			return;
		}

		if (!isset($requestCategoria['nome_categoria'])) {
			http_response_code(400);
			echo json_encode(['error' => 'Dados inválidos', 'campo' => 'nome_categoria']);
			return;
		}

		// Instancia e popula o model de categoria
		$modelCategoria = $this->modelCategoria->find($requestCategoria['id_categoria']);

		if (!$modelCategoria) {
			http_response_code(404);
			echo json_encode(['error' => 'Categoria não encontrada']);
			return;
		}

		$modelCategoria->nome_categoria = $requestCategoria['nome_categoria'];

		// Chama o repository para atualizar a categoria
		try {
			// Aqui você chama o metodo do repositório e não o do controller novamente
			$this->repositoryCategoria->categoriaAtualizar($modelCategoria);
			http_response_code(200);
			echo json_encode(['message' => 'Categoria atualizada com sucesso!']);
		} catch (\Exception $e) {
			http_response_code(400);
			echo json_encode(['mensagem' => 'Erro ao atualizar a categoria', 'error' => $e->getMessage()]);
		}
	}

	// Method: DELETE
	public function categoriaDeletar(): void {
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

		// Variaveis de declaração de model, erros e contagem de deletados
		$modelCategoria = $this->modelCategoria;
		$contadorDeletados = 0;
		$erros = [];

		// Itera no range dos ids para deleta-los
		foreach ($requestCategoria['id_categoria_produto'] as $id) {
			try {
				if ($this->repositoryCategoria->categoriaDeletar($id)) {
					$contadorDeletados++;
				}
			} catch (\Exception $e) {
				// Captura o erro e segue
				$erros[] = ['mensagem' => 'Não foi possivel deletar o id:' . $id, 'erro' => $e->getMessage(),];
			}
		}

		http_response_code(200);
		if (!empty($erros)) { // Verifica se o array de erros não está vazio
			echo json_encode(['mensagem' => $contadorDeletados . ' categorias foram atualizadas', 'erros' => $erros,]);
		} else {
			echo json_encode(['mensagem' => $contadorDeletados . ' categorias deletadas']);
		}
		return;
	}

	// Method: GET
	public function categoriaBuscar(): void {
		// Decodifica o JSON
		$requestCategoria = json_decode(file_get_contents('php://input'), TRUE);

		// Verifica request
		if (!isset($requestCategoria)) {
			http_response_code(400);
			echo json_encode(['error' => 'buscar_categoria deve ser um array', 'campo' => 'buscar_categoria']);
			return;
		}

		// Verifica se tipo de busca foi informadp
		if (!isset($requestCategoria['tipo_de_busca'])) {
			http_response_code(400);
			echo json_encode(['error' => 'O tipo de busca deve ser informado', 'campo' => 'tipo_de_busca']);
			return;
		} else if (!is_int($requestCategoria['tipo_de_busca'])) {
			http_response_code(400);
			echo json_encode(['erro' => 'O tipo de busca deve ser um inteiro 1 - ID /  2 - NomeCategoria', 'campo' => 'tipo_de_busca']);
			return;
		}

		// Verifica se tipo de busca foi informadp
		if (!isset($requestCategoria['parametro_de_busca'])) {
			http_response_code(400);
			echo json_encode(['error' => 'Um parametro para busca deve ser informado', 'campo' => 'parametro_de_busca']);
			return;
		}

		// Chama o respository informando o tipo_de_busca e _parametro_de_busca
		try {
			$resultadoDaBusca = $this->repositoryCategoria->categoriaBuscar($requestCategoria);
			echo json_encode($resultadoDaBusca);
			return;
		} catch (\Exception $e) {
			http_response_code(500);
			echo json_encode(['mensagem' => 'Houve um erro ao buscar os dados', 'error' => $e->getMessage()]);
			return;
		}
	}
}
