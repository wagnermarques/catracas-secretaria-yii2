<?php

namespace app\controllers;

use yii\rest\ActiveController;

/**
 * ApiBaseController implements the RESTful API general configuration.
 */
class ApiBaseController extends ActiveController
{
  /**
   * @inheritDoc
   */
  public function behaviors()
  {
    $behaviors = parent::behaviors();

    $behaviors['authenticator'] = [
      'class' => \yii\filters\auth\HttpBasicAuth::class,
    ];

    return $behaviors;
  }
}
