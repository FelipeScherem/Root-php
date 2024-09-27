<?php

namespace App\Repositories;

use PDO;

class RepositoryProduto
{
	public function produtoCriar(array $dadosq) {

	}

	public function produtoListar() {
		return "Lista de produtos!";
	}

	public function produtoAtualizar() {
		return "Atualizado com sucesso!";
	}

	public function produtoDeletar() {
		return "Deletado com sucesso!";
	}

	public function produtoBuscar() {
		return "Buscado com sucesso!";
	}
}