<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Services\NoteRepository\JsonNoteRepository;
use Services\NoteRepository\PostgresqlNoteRepository;
require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$repositoryJSON = new JsonNoteRepository();
$repositoryPostgresql = new PostgresqlNoteRepository();

$app->get('/js', function (Request $request,Response $response)
{
    global $repositoryJSON;
    $response->getBody()->write(json_encode($repositoryJSON->getAllNotes(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    return $response;
});
$app->get('/pg', function (Request $request,Response $response)
{
    global $repositoryPostgresql;
    $response->getBody()->write(json_encode($repositoryPostgresql->getAllNotes(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    return $response;
});


$app->post('/js', function (Request $request, Response $response)
{
    global $repositoryJSON;
    $dataRequest = $request->getQueryParams();
    $response->getBody()->write(json_encode($repositoryJSON->createNote($dataRequest['note'])));
    return $response;
});
$app->post('/pg', function (Request $request, Response $response)
{
    global $repositoryPostgresql;
    $dataRequest = $request->getQueryParams();
    $response->getBody()->write(json_encode($repositoryPostgresql->createNote($dataRequest['note'])));
    return $response;
});


$app->delete('/js{id}', function (Request $request, Response $response, array $args)
{
    global $repositoryJSON;
    $noteId = $args['id'];
    $response->getBody()->write(json_encode($repositoryJSON->deleteNote($noteId)));
    return $response;
});
$app->delete('/pg{id}', function (Request $request, Response $response, array $args)
{
    global $repositoryPostgresql;
    $noteId = $args['id'];
    $response->getBody()->write(json_encode($repositoryPostgresql->deleteNote($noteId)));
    return $response;
});


$app->put('/js{id}', function (Request $request, Response $response, array $args)
{
    global $repositoryPostgresql;
    $noteId = $args['id'];
    $dataRequest = $request->getQueryParams();
    $response->getBody()->write(json_encode($repositoryPostgresql->putNote($noteId,$dataRequest['note'])));
    return $response; 
    
});
$app->put('/pg{id}', function (Request $request, Response $response, array $args)
{
    global $repositoryPostgresql;
    $noteId = $args['id'];
    $dataRequest = $request->getQueryParams();
    $response->getBody()->write(json_encode($repositoryPostgresql->putNote($noteId,$dataRequest['note'])));
    return $response;

});

$app->run();