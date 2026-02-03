<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Carteirinha $model */
/** @var yii\widgets\ActiveForm $form */
/** @var app\models\Alunos[] $alunos */
?>

<div class="carteirinha-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'carteirinha_id')->textInput() ?>        

    <?= $form->field($model, 'id_aluno')->dropDownList(
        \yii\helpers\ArrayHelper::map($alunos, 'id', function($aluno) {
            return ($aluno->pessoa ? $aluno->pessoa->firstname . ' ' . $aluno->pessoa->lastname : 'Sem Nome') . ' (RA: ' . $aluno->ra . ')';
        }),
        ['prompt' => 'Selecione um Aluno']
    ) ?>

    <?= $form->field($model, 'data_emissao')->textInput() ?>

    <?= $form->field($model, 'data_validade')->textInput() ?>

    <?= $form->field($model, 'ativa')->checkbox() ?>

    <?= $form->field($model, 'observacao')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
