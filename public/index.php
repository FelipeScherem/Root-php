<?php
// ####################################### INICIALIZAÇÃO #######################################
// Carrega o arquivo de bootstrap
require_once __DIR__ . '/../bootstrap.php';

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;


// ####################################### ROTAS #######################################
// Carregar as rotas do arquivo
$dispatcher = simpleDispatcher(function (RouteCollector $r) {
	// Incluindo o arquivo de rotas
	$routes = require __DIR__ . '/../App/Routes/Rotas.php';
	$routes($r); // Registrando as rotas
});

// Obter o metodo da requisição e o caminho
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Recuperar a rota, removendo a query string
if (FALSE !== strpos($uri, '?')) {
	$uri = explode('?', $uri, 2)[0];
}

// Despachar a requisição
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

// Manipulação da rota
switch ($routeInfo[0]) {
	case FastRoute\Dispatcher::NOT_FOUND:
		handleNotFound();
		break;
	case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
		handleMethodNotAllowed();
		break;
	case FastRoute\Dispatcher::FOUND:
		$handler = $routeInfo[1];
		list($controller, $method) = explode(':', $handler);
		$controller = "App\\Controllers\\$controller";
		if (class_exists($controller) && method_exists($controller, $method)) {
			(new $controller())->$method();
		} else {
			handleNotFound();
		}
		break;
}

// ####################################### HANDLERS #######################################
function handleRoot(): void {
	echo json_encode(['message' => 'Welcome to the API!']);
}

function handleNotFound(): void {
	http_response_code(404);
	echo json_encode(['error' => 'Not Found']);
}

function handleMethodNotAllowed(): void {
	http_response_code(405);
	echo json_encode(['error' => 'Method Not Allowed']);
}
