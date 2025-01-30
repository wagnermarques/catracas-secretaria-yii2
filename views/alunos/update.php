<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Alunos $model */
/** @var app\models\Pessoas[] $pessoasall */
/** @var app\models\AlunosStatus $alunostatusall */

$this->title = 'Update Alunos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="alunos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pessoasall' => $pessoasall,
        'alunostatusall' => $alunostatusall,
    ]) ?>

</div>
