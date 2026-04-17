<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Service\SentimentAnalysisService;
use Symfony\Component\HttpClient\HttpClient;

// Créer le service
$httpClient = HttpClient::create();
$sentimentService = new SentimentAnalysisService($httpClient);

// Tester avec quelques exemples
$testTexts = [
    "Ce produit est excellent, je suis très satisfait !",
    "C'est horrible, ça ne marche pas du tout.",
    "Le service est correct, rien de spécial.",
    "Merci beaucoup pour votre aide précieuse !",
    "Je suis déçu par la qualité, c'est nul."
];

echo "=== Test de l'analyse de sentiment ===\n\n";

foreach ($testTexts as $text) {
    echo "Texte: \"$text\"\n";
    $result = $sentimentService->analyze($text);
    echo "Score: " . $result['score'] . "\n";
    echo "Label: " . $result['label'] . "\n";
    echo "Confiance: " . $result['confidence'] . "\n";
    echo "Mots positifs: " . ($result['positive_words'] ?? 0) . "\n";
    echo "Mots négatifs: " . ($result['negative_words'] ?? 0) . "\n";
    echo "Méthode: " . $result['method'] . "\n";
    echo "Emoji: " . $sentimentService->getSentimentEmoji($result['score']) . "\n";
    echo "Couleur: " . $sentimentService->getSentimentColor($result['score']) . "\n";
    echo "---\n";
}