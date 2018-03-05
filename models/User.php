<?php

namespace app\models;

class User extends  \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($user_id)
    {
        return static::findOne($user_id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($user_name)
    {
        return static::findOne(['user_name' => $user_name]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
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
    public function validatePassword($user_pass)
    {
        return $this->user_pass === $user_pass;
    }
}
