<?php

namespace App\Interfaces;

use App\Models\ModelCategoria;

interface InterfaceCategoria
{
	public function categoriaCriar(ModelCategoria $modelCategoria);

	public function categoriaListar();

	public function categoriaAtualizar(ModelCategoria $modelCategoria);

	public function categoriaDeletar(int $idCategoria);

	public function categoriaBuscar(array $requestCategoria);
}