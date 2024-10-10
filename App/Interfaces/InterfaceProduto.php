<?php

namespace App\Interfaces;

use App\Models\ModelProduto;

interface InterfaceProduto
{
	public function produtoCriar(ModelProduto $modelProduto);

	public function produtoListar();

	public function produtoAtualizar(ModelProduto $modelProduto);

	public function produtoDeletar(int $idProduto);

	public function produtoBuscar(array $requestProduto);
}