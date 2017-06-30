<?php

namespace app\erp\admin\controllers;
use app\erp\admin\models\Sysadmin;
use yii\data\Pagination;
use Yii;

/**
 * Default controller for the `admin` module
 */
class UserController extends ConfController{
    /**
     * 列表
     * @return string
     */
    public function actionIndex(){
        $model = Sysadmin::find();
        $count = $model->count();
        $pageSize = Yii::$app->params['admin']['list'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $managers = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render("index", ['managers' => $managers, 'pager' => $pager]);
    }

    /**
     * 添加
     * @return string
     */
    public function actionAdd(){
        $admin = new Sysadmin();

        return $this->render(
            'edit',[
                'admin'=>$admin,
        ]);
    }

    /**
     * 编辑
     * @return string
     */
    public function actionEdit(){
        return $this->render('edit');
    }
    /**
     * 禁用
     * @return string
     */
    public function actionBan()
    {
//        return $this->render('');
    }
    /**
     * 激活
     * @return string
     */
    public function actionctivate()
    {
//        return $this->render('index');
    }
    /**
     * 删除
     * @return string
     */
    public function actionDel(){
//        return $this->render('index');
    }
}
