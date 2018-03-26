<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require 'vendor/autoload.php';
    use GuzzleHttp\Client;
    use GuzzleHttp\Psr7\Request;
    use Psr\Http\Message\ResponseInterface;
    use GuzzleHttp\Exception\RequestException;
    
    $name = $_GET['name'] ?? 'Herokuist';
    $client = new Client();
    $headers = ['Client' => 'Elias@Heroku'];
    $body = 'Hello!';
    // $promise = new Request('POST', 'https://kodaktor.ru/api/req?name=' . $name, $headers, $body);
    // $promise = $client->requestAsync($request);
    // $promise = $client->requestAsync('POST', 'https://kodaktor.ru/api/req?name=' . $name);
    $promise = $client->getAsync('https://kodaktor.ru/api/req?name=' . $name);
    $promise->then(
        function (ResponseInterface $res) {
            $result = json_decode($response ->getBody());
            echo '<h2>' . $result -> name . '</h2>'; 
        },
        function (RequestException $e) {
            echo $e->getMessage() . "\n";
            echo $e->getRequest()->getMethod();
        }
    );
    echo '<h1>Promises</h1>';
