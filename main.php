<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Services\Repository\JsonRepository;
require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
const file = 'Repository.json';
$repository = new JsonRepository();

$app->get('/user', function (Request $request,Response $response) {
    global $repository;
    $response->getBody()->write($repository->GetAllNotes());
    return $response;
});

$app->post('/user', function (Request $request, Response $response) {
    $dataRequest = $request->getQueryParams();
    global $repository;
    $response->getBody()->write($repository->CreateNote($dataRequest));
    return $response;
});

$app->delete('/user/{id}', function (Request $request, Response $response, array $args) {
    global $repository;
    $noteId = $args['id'];
    $response->getBody()->write($repository->DeleteNote($noteId));
    return $response;
});

$app->put('/user/{id}', function (Request $request, Response $response, array $args) {
    $noteId = $args['id'];
    $dataRequest = $request->getQueryParams();
    global $repository;
    $response->getBody()->write($repository->PutNote($dataRequest, $noteId));
    return $response; 
    
});

$app->run();
