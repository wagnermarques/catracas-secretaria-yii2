<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AlunoStatus $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="aluno-status-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status_do_aluno')->textInput(['maxlength' => true]) ?>
ase
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
