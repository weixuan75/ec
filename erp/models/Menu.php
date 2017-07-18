<?php

namespace app\erp\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

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
            [['url', 'name','menu_pid', 'ename', 'content'], 'required',"message"=>"不可以为空"],
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
    public function getData()
    {
        $cates = self::find()->all();
        $cates = ArrayHelper::toArray($cates);
        return $cates;
    }
    public function getTree($cates, $pid = 0)
    {
        $tree = [];
        foreach($cates as $cate) {
            if ($cate['menu_pid'] == $pid) {
                $tree[] = $cate;
                $tree = array_merge($tree, $this->getTree($cates, $cate['id']));
            }
        }
        return $tree;
    }
    public function setPrefix($data, $p = "|-----")
    {
        $tree = [];
        $num = 1;
        $prefix = [0 => 1];
        while($val = current($data)) {
            $key = key($data);
            if ($key > 0) {
                if ($data[$key - 1]['menu_pid'] != $val['menu_pid']) {
                    $num ++;
                }
            }
            if (array_key_exists($val['menu_pid'], $prefix)) {
                $num = $prefix[$val['menu_pid']];
            }
            $val['name'] = str_repeat($p, $num).$val['name'];
            $prefix[$val['menu_pid']] = $num;
            $tree[] = $val;
            next($data);
        }
        return $tree;
    }

    public function getOptions()
    {
        $data = $this->getData();
        $tree = $this->getTree($data);
        $tree = $this->setPrefix($tree);
        $options = ['添加顶级分类'];
        foreach($tree as $cate) {
            $options[$cate['id']] = $cate['name'];
        }
        return $options;
    }

    public function getTreeList()
    {
        $data = $this->getData();
        $tree = $this->getTree($data);
        return $tree = $this->setPrefix($tree);
    }

    public static function getMenu()
    {
        $top = self::find()->where('menu_pid = :pid', [":pid" => 0])->limit(11)->orderby('create_time asc')->asArray()->all();
        $data = [];
        foreach((array)$top as $k=>$cate) {
            $cate['children'] = self::find()->where("menu_pid = :pid", [":pid" => $cate['id']])->limit(10)->asArray()->all();
            $data[$k] = $cate;
        }
        return $data;
    }
}
