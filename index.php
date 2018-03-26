<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require 'vendor/autoload.php';
    use GuzzleHttp\Client;

    $name = $_GET['name'] ?? 'Herokuist';
    $client = new Client([
        'base_uri' => 'https://kodaktor.ru',
        'timeout'  => 2.0,
    ]);
    $response = $client->get('/api/req?name=' . $name);
    echo '<h1>Promises</h1>';
    $result = json_decode($response ->getBody());
    echo '<h2>' . $result -> name . '</h2>'; 