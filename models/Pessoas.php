<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pessoas".
 *
 * @property int $id
 * @property string $firtname
 * @property string|null $lastname
 * @property string|null $email
 * @property int|null $idade
 * @property string|null $rg
 * @property string|null $cpf
 *
 * @property Alunos[] $alunos
 */
class Pessoas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pessoas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firtname'], 'required'],
            [['idade'], 'integer'],
            [['email'], 'email'],
            [['firtname', 'lastname'], 'string', 'max' => 100],
            [['rg', 'cpf'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firtname' => 'Firtname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'idade' => 'Idade',
            'rg' => 'Rg',
            'cpf' => 'Cpf',
        ];
    }

    /**
     * Gets query for [[Alunos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlunos()
    {
        return $this->hasMany(Alunos::class, ['pessoa_id' => 'id']);
    }
}
