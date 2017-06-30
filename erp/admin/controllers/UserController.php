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
        $pageSize = Yii::$app->params['sysadmin']['list'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $managers = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render("index", ['managers' => $managers, 'pager' => $pager]);
    }
    public function actionShow(){
        $id = Yii::$app->request->get("id");
        $admin = Sysadmin::find()
            ->with("sysadmindata")
            ->where("id=:id",[':id'=>$id])
            ->one();
        $admindata = $admin->sysadmindata;
        return $this->render(
            "show", [
                'admin' => $admin,
                'admindata' => $admindata
            ]);
    }

    /**
     * 添加
     * @return string
     */
    public function actionAdd(){
        $admin = new Sysadmin();
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isPost){
            if($admin->add($post)){
                return $this->redirect(['/admin/user']);
            }
//            var_dump($admin->errors);
        }
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
        $id = Yii::$app->request->get("id");
        $admin = Sysadmin::find()
            ->with("sysadmindata")
            ->where("id=:id",[':id'=>$id])
            ->one();
        $admindata = $admin->sysadmindata;
        return $this->render(
            'edit',[
                '$admin'=>$admin,
                'sysadmindata'=>$admindata
        ]);
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
