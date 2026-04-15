<?php
require __DIR__ . '/vendor/autoload.php';

use OpenAI;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiKey = $_ENV['OPENAI_API_KEY'] ?? '';

try {
    $client = OpenAI::client($apiKey);
    $result = $client->chat()->create([
        'model' => 'gpt-4o-mini',
        'messages' => [
            ['role' => 'user', 'content' => 'Hello'],
        ],
    ]);
    echo "SUCCESS: " . $result->choices[0]->message->content;
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
