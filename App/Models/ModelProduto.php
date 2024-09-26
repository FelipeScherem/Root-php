<?php
namespace App\Models;

use  Illuminate\Database\Eloquent\Model;

// ModelProduto
//  Define tabela e colunas para os produtos
class ModelProduto
{
    // Tabela associada ao model
	protected $table = 'tb_produto';
	// Chave primaria
	protected $primaryKey = 'id_produto';

	protected $modelProduto = [
		'id_categoria_produto',
		'data_cadastro',
		'nome_produto',
		'valor_produto',
	];
}