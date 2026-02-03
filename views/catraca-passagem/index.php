<?php

use app\models\CatracaPassagem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CatracaPassagemSearchModel $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Passagens da Catraca';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catraca-passagem-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Passagem', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'id_aluno',
                'value' => function ($model) {
                    return ($model->aluno && $model->aluno->pessoa) ? $model->aluno->pessoa->nome : null;
                },
                'label' => 'Aluno',
            ],
            'cartaoid',
            'catracaid',
            'timestampdapassagem:datetime',
            'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CatracaPassagem $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
