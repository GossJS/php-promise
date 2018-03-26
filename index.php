<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require 'vendor/autoload.php';
    use GuzzleHttp\Client;
    use GuzzleHttp\Psr7\Request;
    use GuzzleHttp\Handler\CurlMultiHandler;
    use GuzzleHttp\HandlerStack;
    
    $name = $_GET['name'] ?? 'Herokuist';
    $curl = new CurlMultiHandler(['select_timeout' => 10]);
    $handler = HandlerStack::create($curl);

    $client = new Client([
        'base_uri' => 'https://kodaktor.ru',
        'handler' => $handler
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
        function ($e) {
            echo $e->getMessage() . "\n";
            echo $e->getRequest()->getMethod();
        }
    );
    while ($promise->getState() === 'pending') {
        $curl->tick();
        sleep(1);
    }
    echo '<h1>Promises</h1>';
