<?php

namespace App\Repositories;

use App\Models\ModelCategoria;

class RepositoryCategoria
{
	public function categoriaCriar(ModelCategoria $modelCategoria) {

		// Salva o produto no banco de dados
		$modelCategoria->save();

		// Retorna o ID do produto criado
		return $modelCategoria->id_categoria_produto;
	}

	public function categoriaListar() {
		return ModelCategoria::all();
	}

	public function categoriaAtualizar() {
		return "Atualizar Categoria";
	}

	public function categoriaDeletar(ModelCategoria $modelCategoria) {

		// Mapeia id para uma variavel, para ficar mais legivel
		$id = $modelCategoria->id_categoria_planejamento;

		try {
			ModelCategoria::where('id_categoria_planejamento', $id)->delete(); // Usa o ID para deletar
			return TRUE;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function categoriaBuscar() {
		return "Buscar Categoria";
	}
}