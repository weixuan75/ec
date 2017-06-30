<?php

namespace app\erp\manager\controllers;
use app\erp\admin\controllers\ConfController;
use app\erp\models\Tvlistings;
use Yii;
use yii\data\Pagination;

/**
 * Default controller for the `manager` module
 */
class TvlistingsController extends ConfController {
    public function actionIndex(){
        $params = Yii::$app->params['tvlistings'];
        $model = Tvlistings::find();
        $count = $model->count();
        $pageSize = $params['list'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $managers = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render(
            "index", [
                'managers' => $managers,
                'pager' => $pager,
                'params' => $params,
            ]);
    }
    public function actionAdd(){
        $tv = new Tvlistings();
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isPost){
            $tv->add($post);
            var_dump($tv->errors);
        }
        return $this->render(
            'edit',[
                'tv'=>$tv
        ]);
    }
}
