<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require 'vendor/autoload.php';
    use GuzzleHttp\Client;
    use GuzzleHttp\Psr7\Request;
    use Psr\Http\Message\ResponseInterface;
    use GuzzleHttp\Exception\RequestException;
    
    $name = $_GET['name'] ?? 'Herokuist';
    $client = new Client([
        'base_uri' => 'https://kodaktor.ru',
        'timeout'  => 2.0,
    ]);
    $headers = ['Client' => 'Elias@Heroku'];
    $body = 'name=' . $name;
    // $request = new Request('POST', '/api/req', [
    //  "json" => [
    //    'name' => $name]
    //  ]);

    // $promise = $client->sendAsync($request)->then(function ($response) {
    //     echo 'I completed! ' . $response->getBody();
    // });
    $request = new Request('POST', '/api/req', $headers, $body);
    $promise = $client->sendAsync($request);
    $promise->then(
        function (ResponseInterface $res) {
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
