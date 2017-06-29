<?php

namespace app\erp\models;

use Yii;

/**
 * This is the model class for table "{{%sys_group_role}}".
 *
 * @property integer $id
 * @property integer $sys_role_id
 * @property integer $sys_group_id
 * @property string $update_time
 */
class Sysgrouprole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_group_role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_role_id', 'sys_group_id'], 'required'],
            [['sys_role_id', 'sys_group_id', 'update_time'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键ID',
            'sys_role_id' => '父级组ID',
            'sys_group_id' => '父级组ID',
            'update_time' => '修改时间',
        ];
    }
}
