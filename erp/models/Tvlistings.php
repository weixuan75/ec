<?php

namespace app\erp\models;

use Yii;

/**
 * This is the model class for table "ec_tvlistings".
 *
 * @property integer $id
 * @property integer $menu_pid
 * @property string $name
 * @property string $ename
 * @property string $weeks
 * @property string $day
 * @property integer $type
 * @property integer $pay_time
 * @property string $shop_id
 * @property integer $state
 * @property integer $is_conf
 * @property string $content
 * @property string $user_id
 * @property string $create_time
 * @property string $update_time
 */
class Tvlistings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec_tvlistings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_pid', 'name', 'ename', 'weeks', 'day', 'type', 'pay_time', 'shop_id', 'content'], 'required'],
            [['menu_pid', 'type', 'pay_time', 'state', 'is_conf', 'user_id', 'create_time', 'update_time'], 'integer'],
            [['name', 'ename', 'weeks', 'day', 'shop_id'], 'string', 'max' => 100],
            [['content'], 'string', 'max' => 500],
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
            'weeks' => '周{0，1，2，3，4，5，6}',
            'day' => '天{[开始时间，结束时间]，[12321354，12321354]，[12321354，12321354]}',
            'type' => '类型：1图片，2视频',
            'pay_time' => '播放时间（秒）',
            'shop_id' => '播放的店铺：0/null,全部店铺播放，[1,2,3,4]',
            'state' => '状态',
            'is_conf' => '设置默认，等于1时，失效的店铺播放默认的电视节目单',
            'content' => '介绍',
            'user_id' => '操作员',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
        ];
    }
}
