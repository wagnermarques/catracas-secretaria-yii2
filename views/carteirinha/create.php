<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Carteirinha $model */

$this->title = 'Create Carteirinha';
$this->params['breadcrumbs'][] = ['label' => 'Carteirinhas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carteirinha-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'alunos' => $alunos,
    ]) ?>

</div>
