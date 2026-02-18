<?php

namespace app\controllers;

use app\models\Alunos;
use app\models\AlunoStatus;
use app\models\Pessoas;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * AlunosController implements the CRUD actions for Alunos model.
 */
class AlunosController extends Controller
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
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Alunos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Alunos::find()->with('pessoa'),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Alunos model.
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
     * Creates a new Alunos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        // TODO: Verificar erro de acesso a valor null na linha abaixo, encontrar o motivo.
        // Yii::trace('[' . Yii::$app->user->identity . '] ===>' . __CLASS__ . ' ' . __METHOD__);
        $pessoas = Pessoas::find()->all();
        $alunos_status_all = AlunoStatus::find()->all();
        $model = new Alunos();

        if ($this->request->isPost) {
            $req = $this->request->post();
            $massModelAttrsLoadedSuccess = $model->load($req);
            if ($massModelAttrsLoadedSuccess && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'pessoasall' => $pessoas,
            'alunostatusall' => $alunos_status_all,
        ]);
    }

    /**
     * Updates an existing Alunos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        Yii::trace('[' . Yii::$app->user->identity . '] ===>' . __CLASS__ . ' ' . __METHOD__);
        $pessoas = Pessoas::find()->all();
        $alunos_status_all = AlunoStatus::find()->all();

        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'pessoasall' => $pessoas,
            'alunostatusall' => $alunos_status_all,
        ]);
    }

    /**
     * Deletes an existing Alunos model.
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
     * Finds the Alunos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Alunos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Alunos::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
