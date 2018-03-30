<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require 'vendor/autoload.php';
    use GuzzleHttp\Client;
    $URL = "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid%20in%20(select%20woeid%20from%20geo.places(1)%20where%20woeid%3D%222123260%22)%20and%20u%3D'c'&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys"; 
    $client = new Client();
    $response = $client->get($URL);
    echo '<h1>Promises</h1>';
    $result = json_decode($response ->getBody());
    echo '<h2>' . $result -> query -> results -> channel -> item -> forecast[1] -> low  . '</h2>';
