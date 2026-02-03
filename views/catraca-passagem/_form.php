<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Alunos;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\CatracaPassagem $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="catraca-passagem-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_aluno')->dropDownList(
        ArrayHelper::map(Alunos::find()->with('pessoa')->all(), 'id', function($aluno) {
            $nome = $aluno->pessoa ? $aluno->pessoa->nome : 'Sem Nome';
            return $nome . " (RA: " . $aluno->ra . ")";
        }),
        ['prompt' => 'Selecione o Aluno']
    ) ?>

    <?= $form->field($model, 'cartaoid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catracaid')->textInput() ?>

    <?= $form->field($model, 'timestampdapassagem')->textInput(['type' => 'datetime-local']) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
