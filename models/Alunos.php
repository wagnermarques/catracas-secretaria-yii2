<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alunos".
 *
 * @property int $id    
 * @property string $nome
 * @property int $ra
 * @property int $idade
 * @property string $emailpessoal
 *
 * @property Carteirinha[] $carteirinhas
 */
class Alunos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alunos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ra','pessoa_id'], 'required'],
            [['ra','pessoa_id'], 'integer'],
            [['aluno_status_id'], 'required'],
            ['ra','unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'ra' => 'Ra',
            'idade' => 'Idade',
            'emailpessoal' => 'Email Pessoal',
            'aluno_status_id' => 'Status do Aluno',
        ];
    }

    /**
     * Gets query for [[Carteirinhas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarteirinhas()
    {
        return $this->hasMany(Carteirinha::class, ['id_aluno' => 'id']);
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

    public function getAlunoStatus()
    {
        return $this->hasOne(AlunoStatus::class, ['id' => 'aluno_status_id']);
    }
}
