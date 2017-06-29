<?php

namespace app\erp\models;

use Yii;

/**
 * This is the model class for table "{{%sys_role_function}}".
 *
 * @property integer $id
 * @property integer $sys_role_id
 * @property integer $sys_fun_id
 * @property string $update_time
 */
class Sysrolefunction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_role_function}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_role_id', 'sys_fun_id'], 'required'],
            [['sys_role_id', 'sys_fun_id', 'update_time'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键ID',
            'sys_role_id' => '角色ID',
            'sys_fun_id' => '方法ID',
            'update_time' => '修改时间',
        ];
    }
}
