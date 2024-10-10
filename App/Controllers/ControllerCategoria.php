<?php

namespace App\Controllers;

use App\Models\ModelCategoria;
use App\Repositories\RepositoryCategoria;
use App\Util\Util;
use App\Util\UtilErros;
use http\Exception;

class ControllerCategoria
{
	// ###################### Construct #######################
	protected $repositoryCategoria;
	protected $modelCategoria;

	public function __construct() {
		$this->repositoryCategoria = new RepositoryCategoria();
		$this->modelCategoria = new ModelCategoria();
	}

	// #################### END-POINTS ####################
	// Method: POST
	public function categoriaCriar(): void {
		$requestCategoria = Util::bindJson();

		if (!isset($requestCategoria['nome_categoria'])) {
			UtilErros::erroCamposInvalidos(400, 'Dados invalidos', 'nome_categoria');
		}

		$modelCategoria = $this->modelCategoria;
		$modelCategoria->nome_categoria = $requestCategoria['nome_categoria'];

		Util::tryCatchChamaRepository(function () use ($modelCategoria) {
			$resultadoDaBusca = $this->repositoryCategoria->categoriaCriar($modelCategoria);
			http_response_code(200);
			echo json_encode($resultadoDaBusca);
		});
	}

	// Method: GET
	public function categoriaListar(): void {
		Util::tryCatchChamaRepository(function () {
			$resultadoDaBusca = $this->repositoryCategoria->categoriaListar();
			http_response_code(200);
			echo json_encode($resultadoDaBusca);
		});
	}

	// Method: PUT
	public function categoriaAtualizar(): void {
		$requestCategoria = Util::bindJson();

		if (!isset($requestCategoria['nome_categoria'])) {
			UtilErros::erroCamposInvalidos(400, 'Dados invalidos', 'nome_categoria');
		}

		$modelCategoria = $this->modelCategoria->find($requestCategoria['id_categoria']);
		if (!$modelCategoria) {
			UtilErros::erroCamposInvalidos(400, 'Categoria não encontrada');
		}

		$modelCategoria->nome_categoria = $requestCategoria['nome_categoria'];

		Util::tryCatchChamaRepository(function () use ($modelCategoria) {
			$resultadoDaBusca = $this->repositoryCategoria->categoriaAtualizar($modelCategoria);
			http_response_code(200);
			echo json_encode($resultadoDaBusca);
		});
	}

	// Method: DELETE
	public function categoriaDeletar(): void {
		// Decodifica o JSON
		$requestCategoria = Util::bindJson();

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
	}

	// Method: GET
	public function categoriaBuscar(): void {
		$requestBusca = Util::bindJson();
		Util::validaBusca($requestBusca);

		Util::tryCatchChamaRepository(function () use ($requestBusca) {
			$resultadoDaBusca = $this->repositoryCategoria->categoriaBuscar($requestBusca);
			http_response_code(200);
			echo json_encode($resultadoDaBusca);
		});
	}
}
