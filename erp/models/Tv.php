<?php

namespace app\erp\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "{{%tv}}".
 *
 * @property string $id
 * @property string $name
 * @property integer $pay_type
 * @property string $weeks
 * @property string $month
 * @property string $day
 * @property integer $state
 * @property integer $is_conf
 * @property string $content
 * @property string $user_id
 * @property string $create_time
 * @property string $update_time
 */
class Tv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tv}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['pay_type', 'state', 'is_conf', 'user_id', 'create_time', 'update_time'], 'integer'],
            [['name', 'day'], 'string', 'max' => 100],
            [['weeks', 'month'], 'string', 'max' => 30],
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
            'name' => '名称111',
            'pay_type' => '播放的方式:0：周，1，日期',
            'weeks' => '周',
            'month' => '月：开始时间，结束时间',
            'day' => '天{[12321354=>id]',
            'state' => '状态',
            'is_conf' => '设置默认，等于1时，失效的店铺播放默认的电视节目单',
            'content' => '介绍',
            'user_id' => '操作员',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
        ];
    }

    public function add($data){
        $session = Yii::$app->session;
        $redis = Yii::$app->redis;
        $user_id = Json::decode($redis->get($session['userData']['user']['auth_code']));
        $time =time();
        $this->user_id=(int)$user_id;
        $this->create_time=$time;
        $this->update_time=$time;
        if ($this->load($data) && $this->validate()) {
            if($this->save(false)){
                return true;
            }
            return false;
        }
        return false;
    }
    public function getTvlistings(){
        return $this->hasMany(Tvlistings::className(), ['tvl_id' => 'id'])
            ->viaTable('ec_tvandtvlistings', ['tv_id' => 'id']);
    }
    public function getTvandtvlistings(){
        return $this->hasMany(Tvandtvlistings::className(), ['tv_id' => 'id']);
    }
}
