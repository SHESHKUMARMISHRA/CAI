<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiService
{
    protected $client;
    protected $baseUri = 'https://candidate-testing.api.royal-apps.io';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function login($email, $password)
    {
        try {
            $client = new Client();
            $response = $client->get('https://candidate-testing.api.royal-apps.io/login', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'email' => $email,
                    'password' => $password,
                ],
            ]);
    
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
            ];
        }
    }

    public function getAuthors($token)
    {
        $response = $this->client->get($this->baseUri . '/authors', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode($response->getBody()->getContents());
    }
}