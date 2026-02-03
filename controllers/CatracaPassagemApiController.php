<?php

namespace app\controllers;

use yii\rest\ActiveController;

/**
 * CatracaPassagemApiController implements the RESTful API for CatracaPassagem model.
 */
class CatracaPassagemApiController extends ActiveController
{
    public $modelClass = 'app\models\CatracaPassagem';

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        // Remove authentication for this example or configure as needed
        unset($behaviors['authenticator']);
        
        return $behaviors;
    }
}
