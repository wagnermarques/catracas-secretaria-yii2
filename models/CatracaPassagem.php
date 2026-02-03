<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catraca_passagem".
 *
 * @property int $id
 * @property int|null $id_aluno
 * @property string|null $cartaoid
 * @property int|null $catracaid
 * @property string|null $timestampdapassagem
 * @property string|null $status
 *
 * @property Alunos $aluno
 */
class CatracaPassagem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catraca_passagem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_aluno', 'catracaid'], 'integer'],
            [['timestampdapassagem'], 'safe'],
            [['cartaoid'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 50],
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
            'id_aluno' => 'Aluno',
            'cartaoid' => 'ID Cartão',
            'catracaid' => 'ID Catraca',
            'timestampdapassagem' => 'Data/Hora Passagem',
            'status' => 'Status',
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
