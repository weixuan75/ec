<?php

namespace app\erp\models;

use Yii;

/**
 * This is the model class for table "{{%sys_admin_date}}".
 *
 * @property string $sys_admin_id
 * @property string $nickname
 * @property string $birthday
 * @property string $head_portrait
 * @property string $adress
 * @property string $tabbing
 */
class Sysadmindate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_admin_date}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_admin_id', 'nickname', 'birthday'], 'required'],
            [['sys_admin_id', 'birthday'], 'integer'],
            [['nickname'], 'string', 'max' => 20],
            [['head_portrait'], 'string', 'max' => 300],
            [['adress'], 'string', 'max' => 200],
            [['tabbing'], 'string', 'max' => 40],
            [['nickname'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sys_admin_id' => '系统会员ID',
            'nickname' => '昵称',
            'birthday' => '生日',
            'head_portrait' => '头像',
            'adress' => '家庭住址',
            'tabbing' => '备注',
        ];
    }
}
