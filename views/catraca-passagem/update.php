<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CatracaPassagem $model */

$this->title = 'Atualizar Passagem: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Passagens da Catraca', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="catraca-passagem-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
