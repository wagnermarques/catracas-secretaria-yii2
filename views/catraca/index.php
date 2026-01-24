<?php

use app\models\Catraca;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CatracaSearchModel $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Catracas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catraca-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Catraca', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'catraca_id',
            'catraca_status',
            'catraca_direction',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Catraca $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
