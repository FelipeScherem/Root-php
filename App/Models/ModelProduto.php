<?php

namespace App\Models;

use  Illuminate\Database\Eloquent\Model;

// Extende o Model do Eloquent
class ModelProduto extends Model
{
	// Configurações e definições da tabela
	protected $table = 'tb_produto';
	public $timestamps = FALSE;
	public $incrementing = TRUE;
	// Pk e campos
	protected $primaryKey = 'id_produto';
	protected $fillable = ['id_categoria_produto', 'data_cadastro', 'nome_produto', 'valor_produto',];
}