<?php

namespace app\erp\models;

use Yii;

/**
 * This is the model class for table "{{%platform}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $ename
 * @property string $content
 * @property string $sys_admin_id
 * @property string $auth_code
 * @property integer $state
 * @property string $create_time
 * @property string $update_time
 */
class Platform extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%platform}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'ename', 'content'], 'required'],
            [['state', 'create_time', 'update_time'], 'integer'],
            [['name', 'ename'], 'string', 'max' => 100],
            [['content'], 'string', 'max' => 500],
            [['sys_admin_id', 'auth_code'], 'string', 'max' => 36],
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
            'name' => '名称',
            'ename' => '英文名称',
            'content' => '介绍',
            'sys_admin_id' => '管理员',
            'auth_code' => '授权码',
            'state' => '状态',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
        ];
    }
}
