<?php

namespace App\Repositories;

use App\Models\ModelProduto;

class RepositoryProduto
{
	public function produtoCriar(ModelProduto $modelProduto) {

	}

	public function produtoListar() {
		try {
			return ModelProduto::all();
		} catch (\Exception $exception) {
			return $exception->getMessage();
		}
	}

	public function produtoAtualizar(ModelProduto $modelProduto) {

	}

	public function produtoDeletar(ModelProduto $modelProduto) {

	}

	public function produtoBuscar(ModelProduto $modelProduto) {

	}
}