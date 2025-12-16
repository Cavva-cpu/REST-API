<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
include 'repository/RepositoryJSON.php';
require __DIR__ . '/../REST API/vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$app->get('/user', function (Request $request, Response $response) {
    $data_request = $request->getQueryParams();
    $data  = Get($data_request);
    $response->getBody()->write($data);
    return $response;
});



$app->post('/user/{id}', function (Request $request, Response $response) {
    $file = 'repository/Repository.json';
    $data_request = $request->getQueryParams();
    $data = Post($data_request);
    file_put_contents($file,$data);
    $response->getBody()->write("Записка была успешно записана!");
    return $response;
});

$app->delete('/user/{id}', function(Request $request, Response $response, array $args){
    $note_id = $args['id'];
    $file = 'repository/Repository.json';
    $data = delete($note_id);
    file_put_contents($file, $data);
    $response->getBody()->write('Заметка Успешно Удалена');
    return $response;
});

$app->put('/user/{id}', function(Request $request, Response $response, array $args){
    $note_id = $args['id'];
    $file = 'repository/Repository.json';
    $data_request = $request->getQueryParams();
    $data = Put($data_request, $note_id);
    file_put_contents($file, $data);
    $response->getBody()->write('Заметка Успешно Заменена');
    return $response;
});

$app->run();
