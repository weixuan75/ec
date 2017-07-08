<?php

namespace app\erp\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "{{%tvlistings}}".
 *
 * @property string $id
 * @property string $name
 * @property integer $state
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
        return '{{%tvlistings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'content'], 'required'],
            [['state', 'user_id', 'create_time', 'update_time'], 'integer'],
            [['name'], 'string', 'max' => 100],
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
            'name' => '名称',
            'state' => '状态',
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
            if($this->save()){
                return true;
            }
            return false;
        }
        return false;
    }
    public function getTvlistingsData(){
        return $this->hasMany(TvlistingsData::className(), ['tv_id' => 'id']);
    }
}
