<?php

namespace app\controllers;

use app\models\CatracaPassagem;
use app\models\CatracaPassagemSearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * CatracaPassagemController implements the CRUD actions for CatracaPassagem model.
 */
class CatracaPassagemController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'create-api' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all CatracaPassagem models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CatracaPassagemSearchModel();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CatracaPassagem model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CatracaPassagem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new CatracaPassagem();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * RESTful action to create a new CatracaPassagem from JSON.
     */
    public function actionCreateApi()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new CatracaPassagem();
        
        // Load data from JSON body
        $data = \Yii::$app->request->post();
        
        // If it's a JSON request, post() might return the parsed body 
        // if JsonParser is configured. If not, we might need to get raw body.
        if (empty($data)) {
            $data = json_decode(\Yii::$app->request->getRawBody(), true);
        }

        if ($model->load($data, '') && $model->save()) {
            return [
                'success' => true,
                'data' => $model,
            ];
        } else {
            return [
                'success' => false,
                'errors' => $model->getErrors(),
            ];
        }
    }

    /**
     * Updates an existing CatracaPassagem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CatracaPassagem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CatracaPassagem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return CatracaPassagem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CatracaPassagem::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
