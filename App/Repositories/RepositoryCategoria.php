<?php

namespace App\Repositories;

use App\Models\ModelCategoria;

class RepositoryCategoria {

	public function categoriaCriar(ModelCategoria $modelCategoria) {

		// Salva o produto no banco de dados
		$modelCategoria->save();

		// Retorna o ID do produto criado
		return $modelCategoria->id_categoria_produto;
	}

	public function categoriaListar() {
		return "Lista de Categoria";
	}

	public function categoriaAtualizar() {
		return "Atualizar Categoria";
	}

	public function categoriaDeletar() {
		return "Deletar Categoria";
	}

	public function categoriaBuscar() {
		return "Buscar Categoria";
	}
}