<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Acessosalunos $model */

$this->title = 'Update Acessosalunos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Acessosalunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="acessosalunos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
