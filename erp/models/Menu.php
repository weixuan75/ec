<?php

namespace app\erp\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property integer $menu_pid
 * @property string $name
 * @property string $ename
 * @property string $content
 * @property string $sys_admin_id
 * @property integer $state
 * @property string $create_time
 * @property string $update_time
 */
class Menu extends ActiveRecord{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'name', 'ename', 'content'], 'required',"message"=>"不可以为空"],
            [['create_time', 'update_time'], 'integer'],
            [['name', 'ename'], 'string', 'max' => 100, 'message' => '名字最大100'],
            [['content','url'], 'string', 'max' => 500, 'message' => '介绍最大500'],
            [['sys_admin_id'], 'string', 'max' => 36, 'message' => '授权管理员最大'],
            [['name'],'unique', 'message' => '名字重复'],
            [['ename'],'unique', 'message' => '英文名字重复'],
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
            'content' => '介绍',
            'sys_admin_id' => '管理员',
            'url' => 'URL地址',
            'state' => '状态',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
        ];
    }

    public function add($data){
        $data['create_time'] = time();
        $data['update_time'] = $data['create_time'];
        if ($this->load($data)&&$this->save()) {
            return true;
        }
        return false;
//        $this->load($data) && $this->save()
    }

}
