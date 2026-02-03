<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CatracaPassagem $model */

$this->title = 'Criar Passagem';
$this->params['breadcrumbs'][] = ['label' => 'Passagens da Catraca', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catraca-passagem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
