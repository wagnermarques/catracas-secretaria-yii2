<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Alunos $model */
/** @var app\models\Pessoas[] $pessoasall */
/** @var app\models\AlunoStatus[] $aluno_status_all */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alunos-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- dropbox to select pessoa from pessoas -->
    <?= $form->field($model, 'pessoa_id')->dropDownList(
        \yii\helpers\ArrayHelper::map($pessoasall, 'id', 'firstname'),
        ['prompt' => 'Selecione uma pessoa']
    ) ?>
    
    <?= $form->field($model, 'ra')->textInput() ?>

    <!-- dropbox to select aluno status -->
    <?= $form->field($model, 'aluno_status_id')->dropDownList(
        \yii\helpers\ArrayHelper::map($alunostatusall, 'id', 'status_do_aluno'),
        ['prompt' => 'Selecione o status do aluno']
    ) ?>

    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
