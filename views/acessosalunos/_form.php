<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Acessosalunos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="acessosalunos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_aluno')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
