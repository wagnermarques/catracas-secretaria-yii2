<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catraca".
 *
 * @property int $id
 * @property int $catraca_id
 * @property string $catraca_status
 * @property string $catraca_direction
 */
class Catraca extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catraca';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['catraca_status'], 'default', 'value' => 'desligada'],
            [['catraca_direction'], 'default', 'value' => 'entrada'],
            [['catraca_id'], 'required'],
            [['catraca_id'], 'integer'],
            [['catraca_status', 'catraca_direction'], 'string', 'max' => 255],
            [['catraca_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'catraca_id' => 'Catraca ID',
            'catraca_status' => 'Catraca Status',
            'catraca_direction' => 'Catraca Direction',
        ];
    }

}
