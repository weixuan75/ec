<?php

namespace app\erp\manager\controllers;
use app\erp\admin\controllers\ConfController;
use app\erp\models\Tvlistings;
use app\erp\models\TvlistingsData;
use Yii;
use yii\data\Pagination;
use yii\helpers\Json;

/**
 * Default controller for the `manager` module
 */
class TvlistingsController extends ConfController {
    public function actionIndex(){
        $hostURL = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $reqURL = Yii::$app->request->get('reqURL');
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
                'hostURL' => $hostURL,
                'reqURL' => $reqURL,
            ]);
    }
    public function actionAdd(){
        $reqURL = Yii::$app->request->get('reqURL');
        $tv = new Tvlistings();
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isPost){
            $tv->add($post);
            var_dump($tv->errors);
        }
        return $this->render(
            'edit',[
                'tv'=>$tv,
            'reqURL' => $reqURL,
        ]);
    }
    public function actionShowlist(){
        $reqURL = Yii::$app->request->get('reqURL');
        $tv_id = Yii::$app->request->get('tv_id');
        $tvs = Tvlistings::find()
            ->with("tvlistingsData")
            ->where("id=:id",[':id'=>$tv_id])
            ->one();
        $tv_data = new TvlistingsData();
        return $this->render(
            'showlist',[
                'tvs'=>$tvs,
                'reqURL' => $reqURL,
                'tv_data' => $tv_data,
        ]);
    }
}
