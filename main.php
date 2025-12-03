<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../REST API/vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("work");

    return $response;
});

$app->get('/user', function (Request $request, Response $response) {
    $response->getBody()->write("Сайт работает");
    return $response;
});
$app->post('/user/{id}', function (Request $request, Response $response) {
    $id = $request->getQueryParams();
    $userId = $id['id'];
    $response->getBody()->write($userId);
    return $response;
});
$app->get('/user/{id}', function (Request $request, Response $response, array $args) {
    $userid = $args['id'];
    $response->getBody()->write("Ваш id:" . $userid);
    return $response;
});
$app->run();
