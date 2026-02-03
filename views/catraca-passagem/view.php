<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\CatracaPassagem $model */

$this->title = 'Passagem: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Passagens da Catraca', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="catraca-passagem-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza que deseja excluir este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'id_aluno',
                'value' => ($model->aluno && $model->aluno->pessoa) ? $model->aluno->pessoa->nome : null,
                'label' => 'Aluno',
            ],
            'cartaoid',
            'catracaid',
            'timestampdapassagem:datetime',
            'status',
        ],
    ]) ?>

</div>
