<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pessoas".
 *
 * @property int $id
 * @property string $firstname
 * @property string|null $lastname
 * @property string|null $emailpessoal
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
            [['firstname'], 'required'],
            [['idade'], 'integer'],
            [['emailpessoal'], 'email'],
            [['firstname', 'lastname'], 'string', 'max' => 100],
            [['rg', 'cpf'], 'string', 'max' => 20],
            
            [['emailpessoal'], 'unique'],  
            [['rg'], 'unique'],  
            [['cpf'], 'unique'],  
            [['firstname', 'lastname', 'emailpessoal', 'idade', 'rg', 'cpf'], 'trim'],
            [['firstname', 'lastname', 'emailpessoal', 'rg', 'cpf'], 'default', 'value' => null],
            [['idade'], 'default', 'value' => 0],
            [['firstname'], 'match', 'pattern' => '/^[a-zA-Z\s]+$/u', 'message' => 'O primeiro nome deve conter apenas letras e espaços.'],
            [['lastname'], 'match', 'pattern' => '/^[a-zA-Z\s]*$/u', 'message' => 'O sobrenome deve conter apenas letras e espaços.'],
            [['emailpessoal'], 'match', 'pattern' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'message' => 'O email pessoal deve ser um endereço de email válido.'],
            [['rg'], 'match', 'pattern' => '/^\d{1,20}$/', 'message' => 'O RG deve conter apenas números e ter no máximo 20 dígitos.'],
            [['cpf'], 'match', 'pattern' => '/^\d{11}$/', 'message' => 'O CPF deve conter exatamente 11 dígitos.'],
            [['cpf'], 'validateCpf'],                   
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firtsname' => 'Primeiro Nome',
            'lastname' => 'Sobrenome',
            'emailpessoal' => 'Email Pessoal',
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
