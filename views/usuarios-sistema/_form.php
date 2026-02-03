<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\UsuariosSistema $model */
/** @var yii\widgets\ActiveForm $form */
/** @var app\models\Pessoas[] $pessoas */
?>

<div class="usuarios-sistema-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pessoa_id')->dropDownList(
        ArrayHelper::map($pessoas, 'id', function($pessoa) {
            return $pessoa->firstname . ' ' . $pessoa->lastname;
        }),
        ['prompt' => 'Selecione uma Pessoa']
    ) ?>

    <?= $form->field($model, 'loginname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
