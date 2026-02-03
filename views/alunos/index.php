<?php

use app\models\Alunos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Alunos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alunos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Alunos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'pessoa_id',
                'label' => 'Nome',
                'value' => function ($model) {
                    return $model->pessoa ? $model->pessoa->firstname . ' ' . $model->pessoa->lastname : '';
                },
            ],
            'ra',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete} {create-carteirinha}',
                'buttons' => [
                    'create-carteirinha' => function ($url, $model, $key) {
                        return Html::a(
                            '<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M528 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm0 400H48V80h480v352zM192 224c0-35.3-28.7-64-64-64s-64 28.7-64 64 28.7 64 64 64 64-28.7 64-64zm32 128c0 14.6-9 27.4-22.6 32.2l-22.1 7.8c-28.4 10.1-59 10.1-87.4 0l-22.1-7.8C57 379.4 48 366.6 48 352v-10.4c0-11.5 8.2-21.4 19.5-23.6 32-6.1 65-9.3 98.5-9.3s66.5 3.2 98.5 9.3c11.3 2.2 19.5 12.1 19.5 23.6V352zM352 160h128c17.7 0 32 14.3 32 32s-14.3 32-32 32H352c-17.7 0-32-14.3-32-32s14.3-32 32-32zm0 128h128c17.7 0 32 14.3 32 32s-14.3 32-32 32H352c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/></svg>',
                            ['carteirinha/create', 'id_aluno' => $model->id],
                            [
                                'title' => 'Criar Carteirinha',
                                'aria-label' => 'Criar Carteirinha',
                                'data-pjax' => '0',
                            ]
                        );
                    },
                ],
                'urlCreator' => function ($action, Alunos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
