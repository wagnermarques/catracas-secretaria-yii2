<?php

namespace app\classes; 

use Yii;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

use Google\Auth\Credentials\ServiceAccountCredentials;
use Google\Auth\OAuth2;


/**
 * Componente GuzzleClient para fazer requisições HTTP
 *
 * @property Client $client A instância do cliente Guzzle HTTP.
 */
class GuzzleClientWrapperForFirebase
{

    /**
     * @var Client A instância interna do cliente Guzzle HTTP.
     */
    private $_client;
    private $firebase_auth_email_user;
    private $firebase_auth_password;
    private $firebase_id_token;
    private $firebase_request_timeout;
    private $firebase_firestore_base_uri;
    private $firebase_config_api_key;
    private $firebase_config_auth_domain;
    private $firebase_config_project_id;
    private $firebase_config_storage_bucket;
    private $firebase_config_messaging_sender_id;
    private $firebase_config_app_id;
    private $firebase_config_measurement_id;

    private $serviceAccountKeyFilePath; // Adicionado: Caminho para o arquivo JSON da conta de serviço
    private $accessToken; // Adicionado: Para armazenar o token de acesso

    
    
    function __construct($guzzleHttpClient = null)
    {
        $this->_client = $guzzleHttpClient;

        $this->firebase_auth_email_user = $_ENV['FIREBASE_AUTH_EMAIL_USER'];
        $this->firebase_auth_password = $_ENV['FIREBASE_AUTH_PASSWORD'];
        $this->firebase_id_token = $_ENV['FIREBASE_ID_TOKEN'];
        $this->firebase_request_timeout = $_ENV['FIREBASE_REQUEST_TIMEOUT'];
        $this->firebase_firestore_base_uri = $_ENV['FIREBASE_FIRESTORE_BASE_URI'];
        $this->firebase_config_api_key = $_ENV['FIREBASE_CONFIG_API_KEY'];
        $this->firebase_config_auth_domain = $_ENV['FIREBASE_CONFIG_AUTH_DOMAIN'];
        $this->firebase_config_project_id = $_ENV['FIREBASE_CONFIG_PROJECT_ID'];
        $this->firebase_config_storage_bucket = $_ENV['FIREBASE_CONFIG_STORAGE_BUCKET'];
        $this->firebase_config_messaging_sender_id = $_ENV['FIREBASE_CONFIG_MESSAGING_SENDER_ID'];
        $this->firebase_config_app_id = $_ENV['FIREBASE_CONFIG_APP_ID'];
        $this->firebase_config_measurement_id = $_ENV['FIREBASE_CONFIG_MEASUREMENT_ID'];

        // Caminho para o arquivo JSON da chave da conta de serviço                
        $this->serviceAccountKeyFilePath = Yii::getAlias('@app/firebase-keys/catracase211-firebase-adminsdk-aus3a-1ddfcfff85.json');
    }
    

    function request($method, $uri, array $options = [])
    {
        // Verifica se o cliente Guzzle está configurado
        if (!$this->_client) {
            throw new \RuntimeException('Guzzle client is not configured.');
        }

        // Configura o tempo limite da requisição
        $options['timeout'] = $this->firebase_request_timeout;

        // Cria a requisição
        $request = new Request($method, $uri, [], null);

        try {
            $accessToken = $this->getAccessToken();
            $options['headers']['Authorization'] = 'Bearer ' . $accessToken;
            return $this->_client->send($request, $options);
        } catch (RequestException $e) {
            Yii::error("Erro ao enviar requisição para {$uri}: " . $e->getMessage(), __METHOD__);
            throw $e;
        } catch (\Exception $e) {
            Yii::error("Erro de autenticação ou token ao enviar requisição para {$uri}: " . $e->getMessage(), __METHOD__);
            throw $e;
        }   
    }


    /**
     * Lista documentos de uma coleção do Firebase Firestore.
     * ESTE É UM PLACEHOLDER CONCEITUAL. A autenticação Firebase e a
     * construção da URL da API REST REAL são mais complexas.
     *
     * @param string $collectionName O nome da coleção do Firestore.
     * @return array Resposta da API do Firestore decodificada.
     * @throws Exception Se a chamada à API falhar.
     */
    public function listDocuments($collectionName)
    {

        $databaseId = '(default)'; // O padrão para Firestore

        // Exemplo de URL da API REST para listar documentos
        $apiUrl = "https://firestore.googleapis.com/v1/projects/{$this->firebase_config_project_id}/databases/{$databaseId}/documents/{$collectionName}";

        // --- Adicione a lógica de autenticação aqui, se não estiver já no seu GuzzleClient ---
        // Exemplo (conceitual): $accessToken = $this->getFirebaseAccessToken();
        // $headers = ['Authorization' => 'Bearer ' . $accessToken];

        try {        
            $response = $this->request('GET', $apiUrl /*, ['headers' => $headers] */);
            return json_decode((string) $response->getBody(), true);
        } catch (\RuntimeException $e) {
            Yii::error("Falha ao listar documentos do Firestore: " . $e->getMessage(), __METHOD__);
            throw $e;
        }
    }

    // Você também pode ter métodos para signIn, etc., aqui.
    public function signInWithConfiguredFirebaseAuthEmailAndPassword() {
        // Implementação do seu método de autenticação
        // Isso provavelmente fará uma requisição para a API de autenticação do Firebase
        // e retornará um token ou objeto de usuário.
        Yii::warning('signInWithConfiguredFirebaseAuthEmailAndPassword: Método placeholder, implemente a lógica real.');
        return 'mock_firebase_auth_key'; // Retorno de exemplo
    }



    /**
     * Obtém um token de acesso OAuth 2.0 usando as credenciais da conta de serviço.
     * O token é armazenado e reutilizado até expirar.
     * @return string O token de acesso.
     * @throws \Exception Se a autenticação falhar.
     */
    private function getAccessToken()
    {
        // Se já temos um token válido, reutilizá-lo
        if ($this->accessToken && !$this->accessToken->isExpired()) {
            return $this->accessToken->getToken();
        }

        if (!file_exists($this->serviceAccountKeyFilePath)) {
            throw new \Exception("Arquivo de chave da conta de serviço não encontrado em: " . $this->serviceAccountKeyFilePath);
        }

        // Definindo os escopos para o Firestore
        // O escopo 'https://www.googleapis.com/auth/cloud-platform' é mais abrangente.
        // O escopo 'https://www.googleapis.com/auth/datastore' é específico para Firestore.
        // Usaremos o mais abrangente para maior compatibilidade.
        $scopes = ['https://www.googleapis.com/auth/cloud-platform'];

        // Carrega as credenciais da conta de serviço
        $credentials = new ServiceAccountCredentials(
             $scopes,
            $this->serviceAccountKeyFilePath
        );
        
        // Obtém o token de acesso
        $this->accessToken = $credentials->fetchAuthToken();

        if (empty($this->accessToken['access_token'])) {
            throw new \Exception("Falha ao obter o token de acesso da conta de serviço.");
        }

        return $this->accessToken['access_token'];
    }

}
