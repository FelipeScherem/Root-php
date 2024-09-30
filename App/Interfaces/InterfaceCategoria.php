<?php

namespace App\Interfaces;

use App\Models\ModelCategoria;

interface InterfaceCategoria
{
	public function categoriaCriar();

	public function categoriaListar();

	public function categoriaAtualizar();

	public function categoriaDeletar();
}