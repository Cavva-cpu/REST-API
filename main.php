<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Services\Repository\JsonRepository;
use Dto\repositoryDto;
require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
const file = 'Repository.json';
$repository = new JsonRepository();
$app->get('/user', function (Request $request,Response $response)
{
    global $repository;
    $response->getBody()->write($repository->getAllNotes());
    return $response;
});

$app->post('/user', function (Request $request, Response $response)
{
    global $repository;
    $dataRequest = $request->getQueryParams();
    $repositoryDto = new repositoryDto($dataRequest['note'],null);
    $repository->createNote($repositoryDto);
    $response->getBody()->write("Ваша записка была успешно добавленна");
    return $response;
});

$app->delete('/user/{id}', function (Request $request, Response $response, array $args)
{
    global $repository;
    $noteId = $args['id'];
    $repositoryDto = new repositoryDto(null,$noteId);
    $repository->deleteNote($repositoryDto);
    $response->getBody()->write("Ваша записка была успешно удалена");
    return $response;
});

$app->put('/user/{id}', function (Request $request, Response $response, array $args)
{
    global $repository;
    $noteId = $args['id'];
    $dataRequest = $request->getQueryParams();
    $repositoryDto = new repositoryDto($dataRequest['note'], $noteId);
    $repository->putNote($repositoryDto);
    $response->getBody()->write("Ваша записка была успешно обнавлена");
    return $response; 
    
});

$app->run();
