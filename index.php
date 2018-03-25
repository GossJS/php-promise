<?php
    require 'vendor/autoload.php';
    use GuzzleHttp\Client;
    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'http://kodaktor.ru',
        // You can set any number of default request options.
        'timeout'  => 2.0,
    ]);
    use Psr\Http\Message\ResponseInterface;
    use GuzzleHttp\Exception\RequestException;
    $promise = $client->requestAsync('GET', '/j/users');
    $promise->then(
        function (ResponseInterface $res) {
            echo $res->getBody() . "\n";
        },
        function (RequestException $e) {
            echo $e->getMessage() . "\n";
            echo $e->getRequest()->getMethod();
        }
    );