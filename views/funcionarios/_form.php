<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Funcionarios $model */
/** @var yii\widgets\ActiveForm $form */
/** @var app\models\Pessoas[] $pessoas */
?>

<div class="funcionarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pessoa_id')->dropDownList(
        \yii\helpers\ArrayHelper::map($pessoas, 'id', function($pessoa) {
            return $pessoa->firstname . ' ' . $pessoa->lastname;
        }),
        ['prompt' => 'Selecione uma Pessoa']
    ) ?>

    <?= $form->field($model, 'cargo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
