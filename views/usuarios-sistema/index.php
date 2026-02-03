<?php

use app\models\UsuariosSistema;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UsuariosSistemaSearchModel $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Usuários do Sistema';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-sistema-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Novo Usuário', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'pessoa_nome',
                'label' => 'Pessoa',
                'value' => function ($model) {
                    return $model->pessoa ? $model->pessoa->firstname . ' ' . $model->pessoa->lastname : '';
                },
            ],
            'loginname',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UsuariosSistema $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
