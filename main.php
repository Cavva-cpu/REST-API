<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Services\RepositoryMethod\JsonRepository;
require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
const file = 'Repository.json';


$app->get('/user', function (Request $request,Response $response) {
    $method = new JsonRepository();
    $response->getBody()->write($method->Get());
    return $response;
});



$app->post('/user', function (Request $request, Response $response) {
    $data_request = $request->getQueryParams();
    $data = new JsonRepository();
    file_put_contents(file, $data->Create($data_request));
    $response->getBody()->write("Записка была успешно записана!");
    return $response;
});

$app->delete('/user/{id}', function (Request $request, Response $response, array $args) {
    $note_id = $args['id'];
    $data = new JsonRepository();
    file_put_contents(file, $data->Delete($note_id));
    $response->getBody()->write('Заметка Успешно Удалена');
    return $response;
});

$app->put('/user/{id}', function (Request $request, Response $response, array $args) {
    $note_id = $args['id'];
    $data_request = $request->getQueryParams();
    $data = new JsonRepository();
    file_put_contents(file, $data->Put($data_request, $note_id));
    $response->getBody()->write('Заметка Успешно Заменена');
    return $response; 
    
});

$app->run();
