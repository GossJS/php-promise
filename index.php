<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require 'vendor/autoload.php';
    use GuzzleHttp\Client;
    use GuzzleHttp\Psr7\Request;
    use GuzzleHttp\Exception\RequestException;
    
    $name = $_GET['name'] ?? 'Herokuist';
    $client = new Client([
        'base_uri' => 'https://kodaktor.ru'
    ]);
  
    $promise = $client
    ->requestAsync('POST', '/api/req', [
        'form_params' => [
            'name' => $name
        ]
    ])
    ->then(
        function ($res) {
            $result = json_decode($res ->getBody());
            echo '<h2>' . $result -> name . '</h2>'; 
        },
        function (RequestException $e) {
            echo $e->getMessage() . "\n";
            echo $e->getRequest()->getMethod();
        }
    );
    $promise->wait();
    echo '<h1>Promises</h1>';
