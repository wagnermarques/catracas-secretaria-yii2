<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Catraca $model */

$this->title = 'Create Catraca';
$this->params['breadcrumbs'][] = ['label' => 'Catracas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catraca-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
