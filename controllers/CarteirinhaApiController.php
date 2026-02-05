<?php

namespace app\controllers;

use app\models\Carteirinha;
use app\models\Alunos;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;

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

    public function actions()
    {
        $actions = parent::actions();
        // Disable default create action to use our custom implementation
        unset($actions['create']);
        return $actions;
    }

    /**
     * POST /carteirinha-api
     * Creates a new Carteirinha with custom logic.
     */
    public function actionCreate()
    {
        $request = \Yii::$app->request;
        $ra = $request->post('aluno_ra');
        $uid = $request->post('carteirinha_uid');

        if (empty($ra) || empty($uid)) {
            throw new BadRequestHttpException("Os campos 'aluno_ra' e 'carteirinha_uid' são obrigatórios.");
        }

        $aluno = Alunos::findOne(['ra' => $ra]);

        if (!$aluno) {
            throw new NotFoundHttpException("Aluno com RA '{$ra}' não encontrado.");
        }

        $model = new Carteirinha();
        $model->id_aluno = $aluno->id;
        $model->carteirinha_id = $uid;
        $model->ativa = 0; // Always inactive
        
        // Setting default dates as they are required by the model
        // Using d/m/Y format as expected by the model's beforeSave
        $model->data_emissao = date('d/m/Y');
        $model->data_validade = date('d/m/Y', strtotime('+1 year'));

        if ($model->save()) {
            return $model;
        } elseif ($model->hasErrors()) {
             \Yii::$app->response->statusCode = 422;
             return $model->getErrors();
        } else {
            throw new ServerErrorHttpException('Falha ao salvar a carteirinha.');
        }
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
