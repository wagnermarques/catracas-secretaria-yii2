<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Carteirinha $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Carteirinhas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="carteirinha-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'carteirinha_id',
            [
                'label' => 'Aluno',
                'value' => $model->aluno && $model->aluno->pessoa ? $model->aluno->pessoa->firstname . ' ' . $model->aluno->pessoa->lastname . ' (RA: ' . $model->aluno->ra . ')' : '',
            ],
            'data_emissao',
            'data_validade',
            'ativa',
            'observacao:ntext',
        ],
    ]) ?>

</div>
