<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Carteirinha $model */

$this->title = 'Update Carteirinha: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Carteirinhas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="carteirinha-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'alunos' => $alunos,
    ]) ?>

</div>
