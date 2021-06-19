<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "User".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string|null $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string|null $reg_date
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'User';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_reset_token', 'email', 'status', 'created_at', 'updated_at'], 'required'],
            [['reg_date'], 'safe'],
            [['created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_reset_token', 'email'], 'string', 'max' => 30],
            [['password_hash', 'status'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'reg_date' => 'Reg Date',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
