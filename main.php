<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../REST API/vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$app->get('/user', function (Request $request, Response $response) {
    $file = 'repository/Repository.json';
    if (file_exists($file)){
        $json_string = file_get_contents($file);
    }
    $response->getBody()->write($json_string);
    return $response;
});



$app->post('/user/{id}', function (Request $request, Response $response) {
    $data_request = $request->getQueryParams();
    $file = 'repository/Repository.json';

    if (file_exists($file)) {
        $json_string = file_get_contents($file);
        $data = json_decode($json_string, true);
    }
        
    $new_item = [
        'note' => $data_request['note'],
    ];
    $data[] = $new_item;
    foreach($data as $index => $note){
        $data_with_id[] = array(
            'id' => $index + 1,
            'note' => $note['note']
        );
    }
    $updated_json = json_encode($data_with_id, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    file_put_contents($file, $updated_json);

    $response->getBody()->write("Записка была успешно записана!");

    return $response;
});

$app->delete('/user/{id}', function(Request $request, Response $response, array $args){
    $note_id = $args['id'];
    $file = 'repository/Repository.json';
    if (file_exists($file)){
        $json_srting = file_get_contents($file);
        $data = json_decode($json_srting, true);
    }

    unset($data[$note_id - 1]);
    $updated_json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($file, $updated_json);
    $response->getBody()->write('Заметка Успешно Удалена');
    return $response;
});

$app->put('/user/{id}', function(Request $request, Response $response, array $args){
    $note_id = $args['id'];
    $file = 'repository/Repository.json';
    $data_request = $request->getQueryParams();
    if (file_exists($file)){
        $json_srting = file_get_contents($file);
        $data = json_decode($json_srting, true);
    }
    

    $data[$note_id - 1]['note'] = $data_request['note'];

    $updated_json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($file, $updated_json);
    $response->getBody()->write('Заметка Успешно Заменена');
    return $response;
});

$app->run();
