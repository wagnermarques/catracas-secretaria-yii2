<?php

namespace app\controllers;

use app\models\Carteirinha;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * REST API controller for Carteirinha model.
 *
 * Default REST actions:
 *  - GET    /carteirinha-api
 *  - GET    /carteirinha-api/{id}
 *  - POST   /carteirinha-api
 *  - PUT    /carteirinha-api/{id}
 *  - PATCH  /carteirinha-api/{id}
 *  - DELETE /carteirinha-api/{id}
 *
 * Custom:
 *  - GET /carteirinha-api/active-list
 */
class CarteirinhaApiController extends ActiveController
{
    public $modelClass = 'app\\models\\Carteirinha';

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['access'] = [
            'class' => \yii\filters\AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['index', 'view', 'create', 'update', 'delete', 'active-list'],
                    'roles' => ['?'], // '?' means anyone (guest) can access
                ],
            ],
        ];

        // Common API behavior: always respond JSON
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        // Common API behavior: no auth here (adjust later for add auth)
        unset($behaviors['authenticator']);

        return $behaviors;
    }

    /**
     * GET /carteirinha-api/active-list
     * Returns all active Carteirinhas as array.
     */
    public function actionActiveList(): array
    {
        \Yii::info('HIT carteirinha-api/active-list', __METHOD__);
        return Carteirinha::find()
            ->where(['ativa' => true])
            //>asArray()
            //asArray() commented because it returns raw DB rows/arrays
            //and does not run ActiveRecord lifecycle methods like afterFind().
            // So any formatting from the model won’t be applied
                //manter o asArray() exige formatar as datas, por exemplo, na mao
                 //foreach ($rows as &$row) {
                     // example: format if needed (guard for nulls)
                     // $row['data_emissao'] = ...;
                     // $row['data_validade'] = ...;
                 //}
            ->all();
    }
}