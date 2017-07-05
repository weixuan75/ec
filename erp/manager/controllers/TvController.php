<?php

namespace app\erp\manager\controllers;
use app\erp\admin\controllers\ConfController;
use app\erp\models\Tv;
use app\erp\models\Tvandtvlistings;
use Yii;
use yii\data\Pagination;

/**
 * Default controller for the `manager` module
 */
class TvController extends ConfController {
    public function actionIndex(){
        $hostURL = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $reqURL = Yii::$app->request->get('reqURL');
        $params = Yii::$app->params['tvlistings'];
        $model = Tv::find();
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
    public function actionShow(){
        $hostURL = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if(!(boolean)Yii::$app->request->get('reqURL')
            &&!(boolean)Yii::$app->request->get('tv_id')){
            return $this->redirect(['/manager/tvlistings']);
        }
        $reqURL = Yii::$app->request->get('reqURL');
        $tv_id = Yii::$app->request->get('tv_id');
        $tvs = Tv::find()->with('tvlistings')->where("id=:id",[':id'=>$tv_id])->one();
        $tvd = $tvs->tvlistings;
        if((boolean)$tvd){
            $tvd = $tvd;
        }else{
            $tvd = null;
        }
        return $this->render(
            'show',[
            'tvs'=>$tvs,
            'reqURL' => $reqURL,
            'tv_data' => $tvd,
            'hostURL' => $hostURL,
        ]);
    }
    public function actionAdd(){
        
    }
    public function actionTv(){
        $model = Tv::find()->with('tvlistings')->where("id=1")->one();
        var_dump($model->tvlistings);
    }
}
