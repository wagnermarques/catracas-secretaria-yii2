<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AlunoStatus $model */

$this->title = 'Create Aluno Status';
$this->params['breadcrumbs'][] = ['label' => 'Aluno Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
