<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require 'vendor/autoload.php';
    use GuzzleHttp\Client;
    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'https://kodaktor.ru',
        // You can set any number of default request options.
        'timeout'  => 2.0,
    ]);
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
    echo '<h1>Promises</h1>';