<?php

namespace app\erp\models;

use Yii;
use yii\helpers\Json;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "{{%tvlistings}}".
 *
 * @property string $id
 * @property string $name
 * @property string $weeks
 * @property string $day
 * @property string $shop_id
 * @property integer $state
 * @property integer $is_conf
 * @property string $content
 * @property string $user_id
 * @property string $start_time
 * @property string $end_time
 * @property string $create_time
 * @property string $update_time
 */
class Tvlistings extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tvlistings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['state', 'is_conf', 'user_id', 'start_time', 'end_time', 'create_time', 'update_time'], 'integer'],
            [['name', 'weeks', 'day'], 'string', 'max' => 100],
            [['shop_id', 'content'], 'string', 'max' => 500],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(){
        return [
            'id' => 'ID',
            'name' => '名称',
            'weeks' => '周',
            'day' => '天',
            'shop_id' => '播放的店铺',
            'state' => '状态',
            'is_conf' => '设置默认，等于1时，失效的店铺播放默认的电视节目单',
            'content' => '介绍',
            'user_id' => '操作员',
            'start_time' => '开始时间',
            'end_time' => '结束时间',
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
    public function getTvlistingsData(){
        return $this->hasMany(TvlistingsData::className(), ['tv_id' => 'id']);
    }
    public function getTvlistingsDataS(){
        return $this->hasMany(TvlistingsData::className(), ['tv_id' => 'id'])
            ->where('state=1')
            ->orderBy('sort');
    }
}
