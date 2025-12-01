<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../REST API/vendor/autoload.php';


$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$app->get('/user', function (Request $request, Response $response) {
    $response->getBody()->write("Саламалеку малек шалям кутакбасс");
    return $response;
});
$app->post('/user/{id}', function (Request $request, Response $response, array $args) {
    $data = $args['id'];
    return $response;
});
$app->get('/user/{id}', function (Request $request, Response $response, array $args) {
    $userid = $args['id'];
    $response->getBody()->write("Саламалеку малек шалям кутакбасс " . $userid);
    return $response;
});
$app->run();
?>