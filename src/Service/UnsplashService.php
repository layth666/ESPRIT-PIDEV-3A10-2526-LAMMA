<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class UnsplashService
{
    private $httpClient;
    private $apiKey;
    
    public function __construct(HttpClientInterface $httpClient, string $unsplashKey)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $unsplashKey;
    }
    
    public function fetchImageUrl(string $query): ?string
    {
        try {
            $response = $this->httpClient->request('GET', 'https://api.unsplash.com/photos/random', [
                'query' => [
                    'query' => $query,
                    'client_id' => $this->apiKey,
                    'orientation' => 'landscape'
                ]
            ]);
            
            $data = $response->toArray();
            return $data['urls']['small'] ?? null;
        } catch (\Exception $e) {
            return null;
        }
    }
}