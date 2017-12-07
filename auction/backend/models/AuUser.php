<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "au_user".
 *
 * @property integer $user_id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $login_time
 */
class AuUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'au_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'login_time'], 'integer'],
            [['username', 'email'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'login_time' => 'Login Time',
        ];
    }
}
