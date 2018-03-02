<?php

namespace app\models;
use yii\web\User;
use app\models\AuthAssignment;

use yii\web\IdentityInterface;


use Yii;

/**
 * This is the model class for table "portalsuser".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $username
 * @property string $password
 * @property string $authKey
 */
class Portalsuser extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc

     */
    public $permission;
    public $status;
    public static function tableName()
    {
        
        return 'portalsuser';

    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'username', 'password', 'authKey'], 'required'],
            [['firstname'], 'string', 'max' => 15],
            [['lastname'], 'string', 'max' => 20],
            [['username', 'password'], 'string', 'max' => 30],
            [['authKey'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
        ];
    }

     public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

     
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

     public function getRegistered()
    {
        return $this->hasMany(RegisterCourses::className(), ['user_id' => 'id']);
    }
}
