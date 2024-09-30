<?php

namespace App\Models;

use  Illuminate\Database\Eloquent\Model;

// Extende o Model do Eloquent
class ModelCategoria extends Model
{
	// Configurações e definições da tabela
	protected $table = 'tb_categoria_produto';
	public $timestamps = FALSE;
	public $incrementing = TRUE;
	// Pk e campos
	protected $primaryKey = 'id_categoria_planejamento';
	protected $fillable = ['nome_categoria'];
}