<?php

namespace app\erp\models;

use Yii;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property integer $menu_pid
 * @property string $name
 * @property string $ename
 * @property string $content
 * @property string $sys_admin_id
 * @property integer $state
 * @property string $create_time
 * @property string $update_time
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_pid', 'name', 'ename', 'content', 'create_time', 'update_time'], 'required',"不可以为空"],
            [['menu_pid', 'state', 'create_time', 'update_time'], 'integer'],
            [['name', 'ename'], 'string', 'max' => 100],
            [['content'], 'string', 'max' => 500],
            [['sys_admin_id'], 'string', 'max' => 36],
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
            'id' => 'ID',
            'menu_pid' => '父级ID',
            'name' => '名称',
            'ename' => '英文名称',
            'content' => '介绍',
            'sys_admin_id' => '管理员',
            'state' => '状态',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
        ];
    }
}
