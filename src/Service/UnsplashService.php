<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class UnsplashService
{
    private $httpClient;
    private $apiKey;
    
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
        // Put your API key directly here for testing
        $this->apiKey = 'YFUq9CbgjnPrphT4HZgoVAlwa1FaCifaaMHbLUzwrtY';
    }
    
    public function fetchImageUrl(string $query): ?string
    {
        try {
            // Log that we're trying
            error_log('Unsplash: Trying to fetch image for: ' . $query);
            
            $response = $this->httpClient->request('GET', 'https://api.unsplash.com/photos/random', [
                'query' => [
                    'query' => $query,
                    'client_id' => $this->apiKey,
                    'orientation' => 'landscape',
                    'w' => 800,
                    'h' => 400
                ]
            ]);
            
            $statusCode = $response->getStatusCode();
            error_log('Unsplash: Response status: ' . $statusCode);
            
            if ($statusCode !== 200) {
                error_log('Unsplash: Error status code: ' . $statusCode);
                return null;
            }
            
            $data = $response->toArray();
            
            if (isset($data['urls']['small'])) {
                error_log('Unsplash: Image found!');
                return $data['urls']['small'];
            }
            
            error_log('Unsplash: No image URL in response');
            return null;
            
        } catch (\Exception $e) {
            error_log('Unsplash ERROR: ' . $e->getMessage());
            return null;
        }
    }
}