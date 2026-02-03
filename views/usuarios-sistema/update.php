<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UsuariosSistema $model */
/** @var app\models\Pessoas[] $pessoas */

$this->title = 'Atualizar Usuário: ' . $model->loginname;
$this->params['breadcrumbs'][] = ['label' => 'Usuários do Sistema', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->loginname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="usuarios-sistema-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pessoas' => $pessoas,
    ]) ?>

</div>
