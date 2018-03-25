<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require 'vendor/autoload.php';
    use GuzzleHttp\Client;
    $client = new Client([
        'base_uri' => 'https://kodaktor.ru',
        'timeout'  => 2.0,
    ]);
    $response = $client->get('/api/req?name=Heroku');
    /*
    use Psr\Http\Message\ResponseInterface;
    use GuzzleHttp\Exception\RequestException;
    $promise = $client->requestAsync('GET', '/api/req?name=Heroku');
    $promise->then(
        function (ResponseInterface $res) {
            echo $res->getBody() . "\n";
        },
        function (RequestException $e) {
            echo $e->getMessage() . "\n";
            echo $e->getRequest()->getMethod();
        }
    );
    */
    echo '<h1>Promises</h1>';
    echo $response;