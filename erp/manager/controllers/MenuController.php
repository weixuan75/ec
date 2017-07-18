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
        $option = $Menu->getOptions();
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isPost){
            $post['Menu']['create_time']=time();
            $post['Menu']['update_time']=time();
            $Menu->menu_pid = $post['Menu']['menu_pid'];
            var_dump($post);
            if($Menu->load($post)&&$Menu->save()){
                return $this->redirect(['/manager/menu']);
            }else{
                var_dump($Menu->errors);
            }
        }
        return $this->render(
            'edit',[
                'menu'=>$Menu,
                'option'=>$option
        ]);
    }
}
