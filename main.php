<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Services\NoteRepository\JsonNoteRepository;
use Dto\NoteDto\NoteDto;
require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
const file = 'Repository.json';
$repository = new JsonNoteRepository();
$app->get('/', function (Request $request,Response $response)
{
    global $repository;
    $response->getBody()->write(json_encode($repository->getAllNotes()));
    return $response;
});

$app->post('/', function (Request $request, Response $response)
{
    global $repository;
    $dataRequest = $request->getQueryParams();
    $repositoryDto = new NoteDto($dataRequest['note'],null);
    $response->getBody()->write(json_encode($repository->createNote($repositoryDto->note)));
    return $response;
});

$app->delete('/{id}', function (Request $request, Response $response, array $args)
{
    global $repository;
    $noteId = $args['id'];
    $repositoryDto = new noteDto(null,$noteId);
    $response->getBody()->write(json_encode($repository->deleteNote($repositoryDto->id)));
    return $response;
});

$app->put('/{id}', function (Request $request, Response $response, array $args)
{
    global $repository;
    $noteId = $args['id'];
    $dataRequest = $request->getQueryParams();
    $repositoryDto = new noteDto($dataRequest['note'], $noteId);
    $response->getBody()->write(json_encode($repository->putNote($repositoryDto->id,$repositoryDto->note)));
    return $response; 
    
});

$app->run();
// убейте меня пожалуйста