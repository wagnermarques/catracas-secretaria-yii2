<?php

/** @var yii\web\View $this */
/** @var yii\data\ArrayDataProvider $dataProvider */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Passagens no Firebase';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relatorios-firebase-passagens">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Exibindo documentos da coleção <code>catracapassagens</code> no Firestore.
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'label' => 'ID do Documento',
                'contentOptions' => ['style' => 'font-family: monospace;'],
            ],
            // As colunas abaixo dependem dos campos que você tem no seu Firestore.
            // Vou adicionar os campos mais prováveis com base nos seus modelos.
            [
                'attribute' => 'id_aluno',
                'label' => 'ID Aluno',
            ],
            [
                'attribute' => 'cartaoid',
                'label' => 'ID Cartão',
            ],
            [
                'attribute' => 'catracaid',
                'label' => 'ID Catraca',
            ],
            [
                'attribute' => 'timestampdapassagem',
                'label' => 'Data/Hora Passagem',
            ],
            [
                'attribute' => 'status',
                'label' => 'Status',
            ],
        ],
    ]); ?>

</div>
