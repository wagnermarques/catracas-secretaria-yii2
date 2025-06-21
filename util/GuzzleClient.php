<?php

namespace app\util;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Yii;

class GuzzleClient
{

    private static $instance = null;
    private $client = null;
    private $secureToken = null;
    
    public function __construct()
    {
        Yii::trace('GuzzleClient::__construct');
        $this->client  = new Client([
            'timeout' => $_ENV['FIREBASE_REQUEST_TIMEOUT'],
            'base_uri' => $_ENV['FIREBASE_FIRESTORE_BASE_URI'] . '/' . $_ENV['FIREBASE_CONFIG_PROJECT_ID'] . '/databases/(default)/documents/',
            'headers' => [
                'Authorization' => 'Bearer ' . $_ENV['FIREBASE_ID_TOKEN'],
                'Content-Type' => 'application/json',
            ],
        ]);
    }


    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    // Método para autenticar com a API Key
    public function signInWithConfiguredFirebaseAuthEmailAndPassword()
    {
        Yii::trace('===> GuzzleClient::signInWithConfiguredFirebaseAuthEmailAndPassword');
        $email = $_ENV['FIREBASE_AUTH_EMAIL_USER'];
        $password = $_ENV['FIREBASE_AUTH_PASSWORD'];
        $apiKey= $_ENV['FIREBASE_CONFIG_API_KEY'];
        Yii::trace('email=' . $email . ', password=' . $password . ', apiKey=' . $apiKey);
        try {
            //$response = $this->client->post('https://identitytoolkit.googleapis.com/v1/accounts:signInWithPassword?key=' . $apiKey, [
            //    'json' => [
            //        'email' => $email,
            //        'password' => $password,
            //        'returnSecureToken' => true,
            //    ],
            //]);
            // Enviar a requisição com dados binários conforme no curl
            $response = $this->client->post('https://identitytoolkit.googleapis.com/v1/accounts:signInWithPassword?key=' . $apiKey, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode([
                    'email' => $email,
                    'password' => $password,
                    'returnSecureToken' => true,
                ]),
            ]);

            Yii::trace('Request Body: ' . $requestBody);

            $response = $this->client->post('https://identitytoolkit.googleapis.com/v1/accounts:signInWithPassword?key=' . $apiKey, [
                'body' => $requestBody,
            ]);

            Yii::trace('Response Headers: ' . json_encode($response->getHeaders()));
            Yii::trace('Response Body: ' . (string) $response->getBody());

            $data = json_decode($response->getBody(), true);
            $this->token = $data['idToken']; // Armazena o idToken para futuras requisições
            Yii::trace('===> GuzzleClient::signInWithConfiguredFirebaseAuthEmailAndPassword: token=' . $this->token);
            return $this->token;
            
            //$data = json_decode($response->getBody(), true);
            //$this->token = $data['idToken']; // Armazena o idToken para futuras requisições
            //Yii::trace('===> GuzzleClient::signInWithConfiguredFirebaseAuthEmailAndPassword: token=' . $this->token);
            //return $this->token;
        } catch (RequestException $e) {
            Yii::error('Falha ao autenticar com API key: ' . $e->getMessage());
            Yii::trace('(ERRO) GuzzleClient::signInWithConfiguredFirebaseAuthEmailAndPassword: token=null');
            Yii::trace(print_r($e, true));
            return null;
        }
    }

    
    // Method to authenticate and get the auth key
    public function signInWithCustomToken()
    {
        try {
            $response = $this->client->post('https://identitytoolkit.googleapis.com/v1/accounts:signInWithCustomToken?key=' . $_ENV['FIREBASE_CONFIG_API_KEY'], [
                'json' => [
                    'token' => $apikey,
                    'returnSecureToken' => true,
                ],
            ]);
            $data = json_decode($response->getBody(), true);
            $this->token = $data['idToken']; // Store the idToken for future requests
            return $this->token;
        } catch (RequestException $e) {
            Yii::error('Failed to get auth key: ' . $e->getMessage());
            return null;
        }
    }


    // Example method to get a document from Firestore
    public function getDocument($collection, $documentId)
    {
        try {
            $response = $this->client->get($collection . '/' . $documentId, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            Yii::error('Failed to get document: ' . $e->getMessage());
            return null;
        }
    }

}
