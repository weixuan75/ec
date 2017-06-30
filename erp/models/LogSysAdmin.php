<?php

namespace app\erp\models;

use Yii;

/**
 * This is the model class for table "{{%log_sys_admin}}".
 *
 * @property string $id
 * @property string $admin_id
 * @property string $content
 * @property integer $state
 * @property integer $tag
 * @property string $time
 */
class LogSysAdmin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%log_sys_admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_id', 'content'], 'required'],
            [['admin_id', 'state', 'tag', 'time'], 'integer'],
            [['content'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_id' => '管理员ID',
            'content' => '操作内容',
            'state' => '状态',
            'tag' => '操作标签',
            'time' => '时间',
        ];
    }
}
