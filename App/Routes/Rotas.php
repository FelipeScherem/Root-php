<?php

use FastRoute\RouteCollector;

return function (RouteCollector $r) {
	// Rotas para produtos
	$r->post('/produtos', 'ControllerProduto:produtoCriar');
	$r->get('/produtos', 'ControllerProduto:produtoListar');
	$r->put('/produtos', 'ControllerProduto:produtoAtualizar');
	$r->delete('/produtos', 'ControllerProduto:produtoDeletar');
	//$r->get('/produtos/{id:\d+}', 'ControllerProduto:produtoBuscar');

	####################################### CATEGORIAS #######################################

	// Ajuste as rotas de categorias
	$r->post('/categorias', 'ControllerCategoria:categoriaCriar'); // Cria nova categoria
	$r->get('/categorias', 'ControllerCategoria:categoriaListar'); // Lista categorias
	$r->put('/categorias', 'ControllerCategoria:categoriaAtualizar'); // Atualiza categoria por ID
	$r->delete('/categorias', 'ControllerCategoria:categoriaDeletar'); // Deleta categoria por ID
	//$r->get('/categorias/{id:\d+}', 'ControllerCategoria:categoriaBuscar');

	// ######################################## USUARIOS ########################################
	// $r->addRoute('POST', '/usuario', 'ControllerUsuario:usuarioCriar');
	// $r->addRoute('GET', '/usuario', 'ControllerUsuario:usuarioListar');
	// $r->addRoute('PUT', '/usuario', 'ControllerUsuario:usuarioAtualizar');
	// $r->addRoute('DELETE', '/usuario', 'ControllerUsuario:usuarioDeletar');
};
