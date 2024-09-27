<?php
namespace App\Models;

use  Illuminate\Database\Eloquent\Model;

// ModelCategoria
//  Define tabela e colunas para as categorias de produtos
class ModelCategoria extends Model {

	// Define a tabela associada ao model
	protected $table = 'tb_categoria_produto';

	// Chave primária
	protected $primaryKey = 'id_categoria_produto';

    public $incrementing = true;

	// Campos que podem ser preenchidos
	protected $fillable = [
		'nome_categoria'
	];

	// Desativa os timestamps
	public $timestamps = false;
}