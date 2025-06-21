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
    public function rules()
    {
        return [
            [['id_aluno', 'carteirinha_id', 'data_emissao', 'data_validade'], 'required'],
            [['id_aluno'], 'integer'],
            [['ativa', 'carteirinha_id','data_emissao', 'data_validade'], 'safe'],
            [['data_emissao', 'data_validade'], 'date' , 'format' => 'dd/MM/yyyy', 'message' => 'Formato da data invalida: Use dd/mm/aaaa'],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Alunos::class, 'targetAttribute' => ['id_aluno' => 'id'], 'message' => 'Aluno n�o encontrado'],
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
            'carteirinha_id' => 'Identificador da Carteirinha',
            'id_aluno' => 'Id Aluno',
            'data_emissao' => 'Data Emissao',
            'data_validade' => 'Data Validade',
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
                    $this->data_emissao = $date->format('Y-m-d h:m:s');
                } else {
                    $this->addError('data_emissao', 'Data Invalida.');
                    Yii::trace(__METHOD__ . ' - ' . __LINE__ . ' - ' . print_r($this->getErrors(), true));
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
            // Convert from YYYY-MM-DD 2025-01-30 00:00:00 to DD/MM/YYYY
            $date = \DateTime::createFromFormat('Y-m-d h:m:s', $this->data_emissao);
            
            if ($date) {
                $this->data_emissao = $date->format('d/m/Y');
            }
        }

        if (!empty($this->data_validade)) {
            // Convert from YYYY-MM-DD to DD/MM/YYYY
            $date = \DateTime::createFromFormat('Y-m-d h:m:s', $this->data_validade);
            if ($date) {
                $this->data_validade = $date->format('d/m/Y');
            }
        }        
    }
}
