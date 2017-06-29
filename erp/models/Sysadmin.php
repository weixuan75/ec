<?php

namespace app\erp\models;

use Yii;

/**
 * This is the model class for table "{{%sys_admin}}".
 *
 * @property string $id
 * @property string $account
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property integer $state
 * @property string $autho_code
 * @property string $login_ip
 * @property string $login_time
 * @property integer $sys_group_id
 * @property string $create_time
 * @property string $update_time
 */
class Sysadmin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['state', 'login_time', 'sys_group_id', 'create_time', 'update_time'], 'integer'],
            [['account'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 15],
            [['password', 'autho_code'], 'string', 'max' => 250],
            [['login_ip'], 'string', 'max' => 40],
            [['account'], 'unique'],
            [['email'], 'unique'],
            [['phone'], 'unique'],
            [['auth_code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '系统会员ID',
            'account' => '账号',
            'email' => '电子邮件',
            'phone' => '电话',
            'password' => '密码',
            'state' => '状态',
            'auth_code' => '认证码',
            'login_ip' => '登陆IP地址',
            'login_time' => '登陆时间',
            'sys_group_id' => '会员组',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
        ];
    }
}
