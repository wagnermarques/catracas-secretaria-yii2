<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Catraca $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="catraca-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'catraca_id')->textInput() ?>

    <?= $form->field($model, 'catraca_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catraca_direction')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
