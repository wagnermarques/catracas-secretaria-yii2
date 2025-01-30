<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Acessosalunos $model */

$this->title = 'Create Acessosalunos';
$this->params['breadcrumbs'][] = ['label' => 'Acessosalunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acessosalunos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
