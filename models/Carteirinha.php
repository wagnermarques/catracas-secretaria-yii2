<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carteirinha".
 *
 * @property int $id
 * @property int $id_aluno
 * @property string $data_emissao
 * @property string $data_validade
 *
 * @property Alunos $aluno
 */
class Carteirinha extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carteirinha';
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if ($this->isNewRecord && empty($this->data_emissao)) {
            $this->data_emissao = date('d/m/Y');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_aluno', 'carteirinha_id', 'data_emissao', 'data_validade'], 'required'],
            [['id_aluno'], 'integer'],
            [['ativa', 'carteirinha_id','data_emissao', 'data_validade', 'observacao'], 'safe'],
            [['observacao'], 'string'],
            [['data_emissao', 'data_validade'], 'date' , 'format' => 'php:d/m/Y', 'message' => 'Formato da data invalida: Use dd/mm/aaaa'],
            ['data_validade', 'validateDates'],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Alunos::class, 'targetAttribute' => ['id_aluno' => 'id'], 'message' => 'Aluno não encontrado'],
            ['carteirinha_id', 'unique', 'message' => 'Este Identificador da Carteirinha já está em uso.'],
        ];
    }

    /**
     * Custom validator to ensure validity date is after emission date.
     */
    public function validateDates($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $emissao = \DateTime::createFromFormat('d/m/Y', $this->data_emissao);
            $validade = \DateTime::createFromFormat('d/m/Y', $this->data_validade);

            if ($emissao && $validade && $validade <= $emissao) {
                $this->addError($attribute, 'A data de validade deve ser posterior à data de emissão.');
            }
        }
    }

    /**
     * {@inheritdoc}
     */ 
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'carteirinha_id' => 'Identificador da Carteirinha',
            'id_aluno' => 'Id Aluno',
            'data_emissao' => 'Data Emissao',
            'data_validade' => 'Data Validade',
            'ativa' => 'Ativa',
            'observacao' => 'Observação',
        ];
    }


    /**
      RELATIONSHIPT
    */
    
    /**
     * Gets query for [[Aluno]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAluno()
    {
        return $this->hasOne(Alunos::class, ['id' => 'id_aluno']);
    }


    /**
      INTERCEPTORS DE OPERACAO DE CRUDS
     */
     public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($this->data_emissao)) {
                $date = \DateTime::createFromFormat('d/m/Y', $this->data_emissao);
                if ($date) {
                    $this->data_emissao = $date->format('Y-m-d H:i:s');
                } else {
                    $this->addError('data_emissao', 'Data Invalida.');
                    return false;
                }
            }

            if (!empty($this->data_validade)) {
                $date = \DateTime::createFromFormat('d/m/Y', $this->data_validade);
                if ($date) {
                    $this->data_validade = $date->format('Y-m-d');
                } else {
                    $this->addError('data_validade', 'Data Invalida.');
                    return false;
                }
            }
            
            return true;
        }
        
        return false;
    }

    public function afterFind()
    {
        parent::afterFind();
        if (!empty($this->data_emissao)) {
            $date = \DateTime::createFromFormat('Y-m-d H:i:s', $this->data_emissao);
            if ($date) {
                $this->data_emissao = $date->format('d/m/Y');
            }
        }

        if (!empty($this->data_validade)) {
            $date = \DateTime::createFromFormat('Y-m-d', $this->data_validade);
            if ($date) {
                $this->data_validade = $date->format('d/m/Y');
            }
        }        
    }
}
