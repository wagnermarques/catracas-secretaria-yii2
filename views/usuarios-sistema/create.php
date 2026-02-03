<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UsuariosSistema $model */
/** @var app\models\Pessoas[] $pessoas */

$this->title = 'Novo Usuário';
$this->params['breadcrumbs'][] = ['label' => 'Usuários do Sistema', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-sistema-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pessoas' => $pessoas,
    ]) ?>

</div>
