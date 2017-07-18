<?php

namespace app\erp\models;

use Yii;

/**
 * This is the model class for table "{{%tvandtvlistings}}".
 *
 * @property string $id
 * @property string $tv_id
 * @property string $tvl_id
 * @property string $day_time
 * @property string $content
 * @property string $user_id
 * @property string $time
 */
class Tvandtvlistings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tvandtvlistings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tv_id', 'tvl_id', 'day_time'], 'required'],
            [['tv_id', 'tvl_id', 'user_id', 'time'], 'integer'],
            [['content'], 'string', 'max' => 500],
            [['day_time'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tv_id' => '电视ID',
            ' ' => '节目ID',
            'day_time' => '播放时间',
            'content' => '介绍',
            'user_id' => '操作员',
            'time' => '修改时间',
        ];
    }
    public function getTv(){
        return $this->hasMany(Tv::className(),['tv_id' => 'id']);
    }
    public function getTvlistings(){
        return $this->hasMany(Tvlistings::className(),['tvl_id' => 'id']);
    }
}
