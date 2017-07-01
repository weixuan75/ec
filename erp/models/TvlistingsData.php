<?php

namespace app\erp\models;

use Yii;

/**
 * This is the model class for table "{{%tvlistings_data}}".
 *
 * @property integer $id
 * @property string $sort
 * @property string $tv_id
 * @property string $name
 * @property string $path
 * @property integer $type
 * @property integer $pay_time
 * @property integer $state
 * @property string $content
 * @property string $user_id
 * @property string $create_time
 */
class TvlistingsData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tvlistings_data}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort', 'tv_id', 'name', 'path', 'type', 'pay_time', 'content'], 'required'],
            [['sort', 'tv_id', 'type', 'pay_time', 'state', 'user_id', 'create_time'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['path'], 'string', 'max' => 300],
            [['content'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sort' => '排序',
            'tv_id' => '父级ID',
            'name' => '名称',
            'path' => '路径',
            'type' => '类型：1图片，2视频',
            'pay_time' => '播放时间（秒）',
            'state' => '状态',
            'content' => '介绍',
            'user_id' => '操作员',
            'create_time' => '创建时间',
        ];
    }
}
