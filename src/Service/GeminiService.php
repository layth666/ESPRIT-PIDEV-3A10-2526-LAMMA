<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class GeminiService
{
    private $httpClient;
    private $apiKey;

    public function __construct(HttpClientInterface $httpClient, string $apiKey)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $apiKey;
    }


    /**
     * Utilise Gemini 1.5 Flash (Gratuit) pour générer un prompt artistique ultra-détaillé.
     */
    public function generateImagePrompt(string $eventDetails)

    {
        if (!$this->apiKey || $this->apiKey === 'VOTRE_CLE_ICI') {
            return ['error' => 'La clé API n\'est pas configurée dans le fichier .env'];
        }

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent";



        try {
            $response = $this->httpClient->request('POST', $url . '?key=' . $this->apiKey, [
                'verify_peer' => false,
                'json' => [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => "Tu es un expert en design d'affiches. À partir des détails suivants, génère un prompt artistique précis, court (max 300 caractères) et en anglais pour un générateur d'images. Pas de texte sur l'image. Détails : " . $eventDetails]
                            ]
                        ]
                    ]
                ]
            ]);

            $statusCode = $response->getStatusCode();
            if ($statusCode !== 200) {
                return ['error' => "HTTP $statusCode: " . $response->getContent(false)];
            }

            $data = $response->toArray();
            if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                return trim($data['candidates'][0]['content']['parts'][0]['text']);
            }
            
            return ['error' => 'Format de réponse Gemini inconnu'];

        } catch (\Exception $e) {
            return ['error' => "Exception: " . $e->getMessage()];
        }
    }    /**
     * Suggère une liste d'équipements pour un événement.
     */
    public function generateEquipmentSuggestions(string $eventDetails)
    {
        if (!$this->apiKey || $this->apiKey === 'VOTRE_CLE_ICI') {
            return ['error' => 'La clé API n\'est pas configurée'];
        }

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent";

        try {
            $response = $this->httpClient->request('POST', $url . '?key=' . $this->apiKey, [
                'verify_peer' => false,
                'json' => [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => "Tu es un assistant logistique. Pour l'événement suivant, propose EXACTEMENT 5 objets ou équipements indispensables, séparés uniquement par des virgules. Ne fais pas de phrases, donne juste les noms. Événement : " . $eventDetails]
                            ]
                        ]
                    ]
                ]
            ]);

            $statusCode = $response->getStatusCode();
            if ($statusCode !== 200) {
                return ['error' => "HTTP $statusCode: " . $response->getContent(false)];
            }


            $data = $response->toArray();
            if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                return trim($data['candidates'][0]['content']['parts'][0]['text']);
            }
            
            return ['error' => 'Format de réponse inconnu'];

        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}

