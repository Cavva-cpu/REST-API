<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../REST API/vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$app->get('/user', function (Request $request, Response $response) {
    $response->getBody()->write("Сайт работает");
    return $response;
});



$app->post('/user/{id}', function (Request $request, Response $response) {
    $data_request = $request->getQueryParams();

    $file = 'repository/Reposytory.json';

    if (file_exists($file)) {
        $json_string = file_get_contents($file);
        $data = json_decode($json_string, true);
    } 
        
    $new_item = [
        'login' => $data_request['login'],
        'password' => $data_request['password']
    ];
    
    $data[] = $new_item;

    $updated_json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    file_put_contents($file, $updated_json);

    $response->getBody()->write("Готово");

    return $response;
});




$app->run();
