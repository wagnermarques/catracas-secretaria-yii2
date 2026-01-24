<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\classes\GuzzleClientWrapperForFirebase;
use yii\data\ArrayDataProvider;

class RelatoriosController extends Controller
{
    /**
     * Lists documents from the Firebase Firestore 'catracaspassagens' collection.
     *
     * @return string
     */
    public function actionFirebasePassagens()
    {
        $collectionName = 'catracaspassagens';
        $guzzleClient = Yii::$app->guzzleClient;
        $firebaseRestClient = new GuzzleClientWrapperForFirebase($guzzleClient);

        $documents = [];
        try {
            $response = $firebaseRestClient->listDocuments($collectionName);
            
            if (isset($response['documents'])) {
                foreach ($response['documents'] as $doc) {
                    $fields = $doc['fields'] ?? [];
                    $data = [
                        'id' => basename($doc['name']),
                    ];
                    foreach ($fields as $key => $value) {
                        $data[$key] = $this->formatFirestoreValue($value);
                    }
                    $documents[] = $data;
                }
            }
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', 'Erro ao buscar dados do Firebase: ' . $e->getMessage());
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $documents,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('firebase-passagens', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Formats Firestore values for display.
     */
    private function formatFirestoreValue($value)
    {
        if (isset($value['stringValue'])) return $value['stringValue'];
        if (isset($value['integerValue'])) return $value['integerValue'];
        if (isset($value['doubleValue'])) return $value['doubleValue'];
        if (isset($value['booleanValue'])) return $value['booleanValue'] ? 'Sim' : 'Não';
        if (isset($value['timestampValue'])) return Yii::$app->formatter->asDatetime($value['timestampValue']);
        
        return json_encode($value);
    }
}
