<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
require_once 'repository/RepositoryJSON.php';
use methods\RepositoryJSON;
require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
const file = 'repository/Repository.json';

$app->get('/user', function (Request $request, Response $response) {
    $data = new RepositoryJSON();
    $response->getBody()->write($data->Get());
    return $response;
});



$app->post('/user/{id}', function (Request $request, Response $response) {
    $data_request = $request->getQueryParams();
    $data = new RepositoryJSON();
    file_put_contents(file, $data->Post($data_request));
    $response->getBody()->write("Записка была успешно записана!");
    return $response;
});

$app->delete('/user/{id}', function (Request $request, Response $response, array $args) {
    $note_id = $args['id'];
    $data = new RepositoryJSON();
    file_put_contents(file, $data->delete($note_id));
    $response->getBody()->write('Заметка Успешно Удалена');
    return $response;
});

$app->put('/user/{id}', function (Request $request, Response $response, array $args) {
    $note_id = $args['id'];
    $data_request = $request->getQueryParams();
    $data = new RepositoryJSON();
    file_put_contents(file, $data->Put($data_request, $note_id));
    $response->getBody()->write('Заметка Успешно Заменена');
    return $response;
});

$app->run();
