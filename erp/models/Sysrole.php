<?php

namespace app\erp\models;

use Yii;

/**
 * This is the model class for table "{{%sys_role}}".
 *
 * @property integer $id
 * @property integer $sys_role_pid
 * @property string $name
 * @property string $ename
 * @property string $content
 * @property string $sys_admin_id
 * @property integer $state
 * @property string $create_time
 * @property string $update_time
 */
class Sysrole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_role_pid', 'name', 'ename', 'content'], 'required'],
            [['sys_role_pid', 'state', 'create_time', 'update_time'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['ename'], 'string', 'max' => 200],
            [['content', 'sys_admin_id'], 'string', 'max' => 500],
            [['name'], 'unique'],
            [['ename'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '组ID',
            'sys_role_pid' => '父级组ID',
            'name' => '组名称',
            'ename' => '组英文名称',
            'content' => '组介绍',
            'sys_admin_id' => '角色管理员',
            'state' => '状态',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
        ];
    }
}
