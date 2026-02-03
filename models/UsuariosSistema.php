<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios_sistema".
 *
 * @property int $id
 * @property int $pessoa_id
 * @property string $loginname
 * @property string $password
 * @property string|null $auth_key
 * @property string|null $access_token
 *
 * @property Pessoas $pessoa
 */
class UsuariosSistema extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios_sistema';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pessoa_id', 'loginname', 'password'], 'required'],
            [['pessoa_id'], 'integer'],
            [['loginname'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['access_token'], 'string', 'max' => 100],
            [['loginname'], 'unique'],
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
            'pessoa_id' => 'Pessoa',
            'loginname' => 'Login',
            'password' => 'Senha',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
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

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->auth_key = Yii::$app->getSecurity()->generateRandomString();
            }
            return true;
        }
        return false;
    }
}
