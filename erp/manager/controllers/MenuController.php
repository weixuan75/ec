<?php

namespace app\erp\manager\controllers;
use app\erp\admin\controllers\ConfController;
use app\erp\models\Menu;
use Yii;
use yii\data\Pagination;

/**
 * Default controller for the `manager` module
 */
class MenuController extends ConfController {
    public function actionIndex(){
        $model = Menu::find();
        $count = $model->count();
        $pageSize = Yii::$app->params['menu']['list'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $managers = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render("index", ['managers' => $managers, 'pager' => $pager]);
    }
    public function actionAdd(){
        $Menu = new Menu();
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isPost){
//            $Menu->name = $post['Menu'];
                $post['Menu']['create_time']=time();
                $post['Menu']['update_time']=time();
                var_dump($Menu->load($post));
                var_dump($Menu->save());
                var_dump($Menu->errors);
//                var_dump($Menu->save());
//                return $this->redirect(['/manager']);
        }
        return $this->render(
            'edit',[
                'menu'=>$Menu
        ]);
    }
}
