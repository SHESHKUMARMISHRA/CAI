<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Contracts\Session\Session;

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
            $response = $client->post('https://candidate-testing.api.royal-apps.io/api/v2/token', [
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

    public function addAuthor($token, array $data)
    {
        $token = \Cache::get('api_token'); // Retrieve token from session

        if (!$token) {
            throw new \Exception('API Token is missing.');
        }

        try {
            $response = $this->client->post($this->baseUri . '/api/v2/authors', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type'  => 'application/json',
                ],
                'json' => $data, // Send data as JSON
            ]);

            return json_decode($response->getBody()->getContents());
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return json_decode($e->getResponse()->getBody()->getContents());
        }
    }

    public function addBook($token, array $data)
    {
        try {
            $response = $this->client->post($this->baseUri . '/api/v2/books', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type'  => 'application/json',
                ],
                'json' => $data, // Send data as JSON
            ]);
    
            // Get response body & status code
            $body = json_decode($response->getBody()->getContents(), true);
            $statusCode = $response->getStatusCode();
    
            return [
                'status' => 'success',
                'code' => $statusCode,
                'data' => $body
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Handle 4xx errors
            return [
                'status' => 'error',
                'code' => $e->getResponse()->getStatusCode(),
                'message' => json_decode($e->getResponse()->getBody()->getContents(), true)
            ];
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            // Handle 5xx errors
            return [
                'status' => 'error',
                'code' => $e->getResponse()->getStatusCode(),
                'message' => 'Server error occurred'
            ];
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle network errors or connection issues
            return [
                'status' => 'error',
                'code' => 0,
                'message' => 'Network error: ' . $e->getMessage()
            ];
        } catch (\Exception $e) {
            // Catch all other exceptions
            return [
                'status' => 'error',
                'code' => 0,
                'message' => 'Unexpected error: ' . $e->getMessage()
            ];
        }
    }
    

    public function getAuthors($token)
    {
        $response = $this->client->get($this->baseUri . '/api/v2/authors', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function getBooks($token)
    {
        $response = $this->client->get($this->baseUri . '/api/v2/books', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function deleteAuthor($authorId, $token)
    {
        try {
            $response = $this->client->delete($this->baseUri . '/api/v2/authors/' . $authorId, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);
            $statusCode = $response->getStatusCode();
            if ($statusCode == 200 || $statusCode == 204) {
                return response()->json([
                    'message' => 'Book deleted successfully!',
                    'status' => $statusCode
                ], $statusCode);
            }

            return response()->json([
                'error' => 'Failed to delete the book.',
                'status' => $statusCode
            ], $statusCode);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong!',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteBook($bookId, $token)
    {
        try {
            $response = $this->client->delete($this->baseUri . '/api/v2/books/' . $bookId, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);
            $statusCode = $response->getStatusCode();

            // If deletion is successful, return a JSON response with the status code
            if ($statusCode == 200 || $statusCode == 204) {
                return response()->json([
                    'message' => 'Book deleted successfully!',
                    'status' => $statusCode
                ], $statusCode);
            }

            return response()->json([
                'error' => 'Failed to delete the book.',
                'status' => $statusCode
            ], $statusCode);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong!',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
