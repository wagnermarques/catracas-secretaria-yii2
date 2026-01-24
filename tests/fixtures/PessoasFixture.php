<?php

namespace app\tests\fixtures;

use yii\test\ActiveFixture;

class PessoasFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Pessoas';
    public $dataFile = '@app/tests/_data/pessoa.php';
}
