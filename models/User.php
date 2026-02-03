<?php

namespace app\models;

use yii\base\BaseObject;
use yii\web\IdentityInterface;

class User extends BaseObject implements IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $pessoa_id;

    private static $staticUsers = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        if (isset(self::$staticUsers[$id])) {
            return new static(self::$staticUsers[$id]);
        }

        $dbUser = UsuariosSistema::findOne($id);
        if ($dbUser) {
            return new static([
                'id' => $dbUser->id,
                'username' => $dbUser->loginname,
                'password' => $dbUser->password,
                'authKey' => $dbUser->auth_key,
                'accessToken' => $dbUser->access_token,
                'pessoa_id' => $dbUser->pessoa_id,
            ]);
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$staticUsers as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        $dbUser = UsuariosSistema::findOne(['access_token' => $token]);
        if ($dbUser) {
            return new static([
                'id' => $dbUser->id,
                'username' => $dbUser->loginname,
                'password' => $dbUser->password,
                'authKey' => $dbUser->auth_key,
                'accessToken' => $dbUser->access_token,
                'pessoa_id' => $dbUser->pessoa_id,
            ]);
        }
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$staticUsers as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        $dbUser = UsuariosSistema::findOne(['loginname' => $username]);
        if ($dbUser) {
            return new static([
                'id' => $dbUser->id,
                'username' => $dbUser->loginname,
                'password' => $dbUser->password,
                'authKey' => $dbUser->auth_key,
                'accessToken' => $dbUser->access_token,
                'pessoa_id' => $dbUser->pessoa_id,
            ]);
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Usuário',
            'password' => 'Senha',
            'rememberMe' => 'Lembrar de mim'
        ];
    }
}
