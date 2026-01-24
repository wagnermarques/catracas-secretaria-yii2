<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "funcionarios".
 *
 * @property int $id
 * @property int $pessoa_id
 * @property string $cargo
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Pessoas $pessoa
 */
class Funcionarios extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'funcionarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'default', 'value' => null],
            [['pessoa_id', 'cargo'], 'required'],
            [['pessoa_id', 'created_at', 'updated_at'], 'integer'],
            [['cargo'], 'string', 'max' => 255],
            [['pessoa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoas::class, 'targetAttribute' => ['pessoa_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pessoa_id' => 'Pessoa ID',
            'cargo' => 'Cargo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Pessoa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPessoa()
    {
        return $this->hasOne(Pessoas::class, ['id' => 'pessoa_id']);
    }

}
