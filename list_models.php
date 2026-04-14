<?php

require 'vendor/autoload.php';

use Symfony\Component\HttpClient\HttpClient;

$apiKey = 'AIzaSyASCaKQgmJoZ83JMDZGrB18MEFVCNKGCh8'; // Clé de l'utilisateur
$url = "https://generativelanguage.googleapis.com/v1beta/models?key=" . $apiKey;

$client = HttpClient::create();
$response = $client->request('GET', $url);

file_put_contents('models_list.json', $response->getContent());
echo "Liste des modèles récupérée dans models_list.json\n";
