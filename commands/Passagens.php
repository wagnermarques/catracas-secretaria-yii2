<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\base\Exception; // Para capturar exceções da chamada à API

/**
 * Este comando interage com o Firebase Firestore via GuzzleClient
 * para listar documentos de uma coleção.
 */
class PassagensController extends Controller
{
    /**
     * Lista documentos de uma coleção específica do Firebase Firestore.
     *
     * Exemplo de uso:
     * php yii passagens # Lista da coleção padrão 'catracaspassagens'
     * php yii passagens "outra_colecao" # Lista de uma coleção específica
     *
     * @param string $collectionName O nome da coleção do Firestore para listar (ex: 'passagens').
     * O valor padrão é 'catracaspassagens'.
     * @return int Exit code
     */
    public function actionIndex($collectionName = 'catracaspassagens') // Coleção padrão
    {

        // 1. Verificar se o componente 'guzzleClient' está configurado na aplicação
        if (!Yii::$app->has('guzzleClient')) {
            $this->stderr("Erro: O componente 'guzzleClient' não está configurado na sua aplicação. " .
                          "Verifique 'config/web.php' ou 'config/console.php'.\n", \yii\helpers\Console::FG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $guzzleClient = Yii::$app->guzzleClient;

        $this->stdout("Iniciando listagem de documentos da coleção: '{$collectionName}'...\n", \yii\helpers\Console::FG_YELLOW);

        try {
            // 2. Chamar o método do seu guzzleClient para listar documentos.
            //    Assumimos que 'listDocuments' é o método que interage com a API do Firestore
            //    e retorna um array de documentos.
            //    O formato de retorno pode variar dependendo da implementação do seu GuzzleClient.
            //    A API REST do Firestore retorna documentos com 'name' (path completo) e 'fields' (dados).
            $response = $guzzleClient->listDocuments($collectionName);

            // Verifique se a resposta contém uma lista de documentos
            if (!isset($response['documents']) || empty($response['documents'])) {
                $this->stdout("Nenhum documento encontrado na coleção '{$collectionName}'.\n", \yii\helpers\Console::FG_CYAN);
            } else {
                $this->stdout("Documentos encontrados na coleção '{$collectionName}':\n\n", \yii\helpers\Console::FG_GREEN);
                foreach ($response['documents'] as $document) {
                    // O 'name' de um documento Firestore é um caminho completo (e.g., 'projects/YOUR_PROJECT_ID/databases/(default)/documents/COLLECTION_ID/DOCUMENT_ID')
                    // Usamos basename() para obter apenas o ID do documento.
                    $docId = basename($document['name']); 
                    $docFields = $document['fields'] ?? []; // Os campos do documento

                    $this->stdout("  ID do Documento: " . $docId . "\n", \yii\helpers\Console::FG_BLUE);
                    $this->stdout("  --- Dados do Documento ---\n");
                    
                    // Iterar sobre os campos do documento
                    if (empty($docFields)) {
                        $this->stdout("    (Nenhum campo)\n");
                    } else {
                        foreach ($docFields as $fieldName => $fieldValue) {
                            // A API do Firestore retorna valores como objetos com o tipo (ex: 'stringValue', 'integerValue')
                            $formattedValue = $this->formatFirestoreValue($fieldValue);
                            $this->stdout("    {$fieldName}: {$formattedValue}\n");
                        }
                    }
                    $this->stdout("\n"); // Linha em branco entre documentos
                }
            }

        } catch (Exception $e) {
            // 3. Lidar com erros na chamada à API
            $this->stderr("Erro ao listar documentos do Firestore: " . $e->getMessage() . "\n", \yii\helpers\Console::FG_RED);
            // Opcional: Registrar o erro completo para depuração
            Yii::error("Erro no comando PassagensController: " . $e->getMessage() . "\n" . $e->getTraceAsString(), __METHOD__);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $this->stdout("Listagem concluída.\n", \yii\helpers\Console::FG_YELLOW);
        return ExitCode::OK;
    }

    /**
     * Helper para formatar os valores retornados pela API do Firestore para exibição no console.
     * A API do Firestore envolve os valores em um objeto que indica o tipo (e.g., {"stringValue": "..."}).
     * Adicione mais tipos conforme suas necessidades (arrayValue, mapValue, timestampValue, etc.).
     *
     * @param mixed $firestoreValue O valor do campo conforme retornado pela API do Firestore.
     * @return string O valor formatado para exibição.
     */
    private function formatFirestoreValue($firestoreValue)
    {
        if (!is_array($firestoreValue)) {
            return (string) $firestoreValue; // Para valores que não são arrays (embora a API os envolva)
        }

        if (isset($firestoreValue['stringValue'])) {
            return $firestoreValue['stringValue'];
        }
        if (isset($firestoreValue['integerValue'])) {
            return (string) $firestoreValue['integerValue'];
        }
        if (isset($firestoreValue['doubleValue'])) {
            return (string) $firestoreValue['doubleValue'];
        }
        if (isset($firestoreValue['booleanValue'])) {
            return $firestoreValue['booleanValue'] ? 'true' : 'false';
        }
        if (isset($firestoreValue['timestampValue'])) {
            return $firestoreValue['timestampValue']; // Formato ISO 8601
        }
        if (isset($firestoreValue['nullValue'])) {
            return 'NULL';
        }
        // Para tipos complexos como MapValue ou ArrayValue, pode-se serializar para JSON
        if (isset($firestoreValue['mapValue'])) {
            return json_encode($firestoreValue['mapValue']);
        }
        if (isset($firestoreValue['arrayValue'])) {
            return json_encode($firestoreValue['arrayValue']);
        }

        // Fallback para tipos desconhecidos
        return json_encode($firestoreValue);
    }
}