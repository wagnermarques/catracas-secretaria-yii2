<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "acessosalunos".
 *
 * @property int $id
 * @property int $id_aluno
 * @property string $data_acesso
 * @property string $hora_acesso
 *
 * @property Alunos $aluno
 */
class Acessosalunos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acessosalunos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_aluno', 'data_acesso', 'hora_acesso'], 'required'],
            [['id_aluno'], 'integer'],
            [['data_acesso', 'hora_acesso'], 'safe'],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Alunos::class, 'targetAttribute' => ['id_aluno' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_aluno' => 'Id Aluno',
            'data_acesso' => 'Data Acesso',
            'hora_acesso' => 'Hora Acesso',
        ];
    }

    /**
     * Gets query for [[Aluno]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAluno()
    {
        return $this->hasOne(Alunos::class, ['id' => 'id_aluno']);
    }
}
