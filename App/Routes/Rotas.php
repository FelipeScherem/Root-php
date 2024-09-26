<?php

use FastRoute\RouteCollector;

return function (RouteCollector $r) {
	$r->post('/produtos', 'ControllerProduto:produtoCriar');
	$r->put('/produtos', 'ControllerProduto:produtoAtualizar');
	$r->get('/produtos', 'ControllerProduto:produtoListar');
	$r->get('/produtos/{id:\d+}', 'ControllerProduto:produtoBuscar');
	$r->delete('/produtos/{id:\d+}', 'ControllerProduto:produtoDeletar');

	// ####################################### CATEGORIAS #######################################
	// $r->addRoute('POST', '/categoria', 'ControllerCategoria:categoriaCriar');
	// $r->addRoute('GET', '/categoria', 'ControllerCategoria:categoriaListar');
	// $r->addRoute('PUT', '/categoria', 'ControllerCategoria:categoriaAtualizar');
	// $r->addRoute('DELETE', '/categoria', 'ControllerCategoria:categoriaDeletar');

	// ######################################## USUARIOS ########################################
	// $r->addRoute('POST', '/usuario', 'ControllerUsuario:usuarioCriar');
	// $r->addRoute('GET', '/usuario', 'ControllerUsuario:usuarioListar');
	// $r->addRoute('PUT', '/usuario', 'ControllerUsuario:usuarioAtualizar');
	// $r->addRoute('DELETE', '/usuario', 'ControllerUsuario:usuarioDeletar');
};