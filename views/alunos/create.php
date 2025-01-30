<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Alunos $model */
/** @var app\models\Pessoas[] $pessoasall */
/** @var app\models\Pessoas[] $alunostatusall */

$this->title = 'Create Alunos';
$this->params['breadcrumbs'][] = ['label' => 'Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alunos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pessoasall' => $pessoasall,
        'alunostatusall' => $alunostatusall,
    ]) ?>

</div>
