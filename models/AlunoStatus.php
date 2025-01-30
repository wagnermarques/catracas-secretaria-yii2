<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aluno_status".
 *
 * @property int $id
 * @property string $status_do_aluno
 *
 * @property Alunos[] $alunos
 */
class AlunoStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aluno_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_do_aluno'], 'required'],
            [['status_do_aluno'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status_do_aluno' => 'Status Do Aluno',
        ];
    }

    /**
     * Gets query for [[Alunos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlunos()
    {
        return $this->hasMany(Alunos::class, ['aluno_status_id' => 'id']);
    }
}
