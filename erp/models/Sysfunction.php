<?php

namespace app\erp\models;

use Yii;

/**
 * This is the model class for table "{{%sys_function}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $ename
 * @property string $content
 * @property string $url
 * @property string $fun_code
 * @property integer $state
 * @property string $create_time
 * @property string $update_time
 */
class Sysfunction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_function}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'ename', 'content'], 'required'],
            [['url', 'fun_code'], 'string'],
            [['state', 'create_time', 'update_time'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['ename', 'content'], 'string', 'max' => 200],
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
            'id' => '方法ID',
            'name' => '方法名称',
            'ename' => '方法英文名称',
            'content' => '方法介绍',
            'url' => '授权URL',
            'fun_code' => '方法代码',
            'state' => '状态',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
        ];
    }
}
