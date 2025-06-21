<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pessoas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pessoas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emailpessoal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idade')->textInput() ?>

    <?= $form->field($model, 'rg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cpf')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
