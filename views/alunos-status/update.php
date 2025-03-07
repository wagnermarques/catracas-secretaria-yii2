<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AlunoStatus $model */

$this->title = 'Update Aluno Status: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Aluno Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="aluno-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
