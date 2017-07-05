<?php

namespace app\erp\app\controllers;
use app\erp\models\Tvandtvlistings;
use app\erp\models\Tvlistings;
use app\erp\models\TvlistingsData;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

/**
 * Default controller for the `manager` module
 */
class TvController extends Controller {
    public function actionIndex(){
    }
    public function actionAdd(){
        $response = Yii::$app->response;
        $response->format = yii\web\Response::FORMAT_JSON;
        $post = Yii::$app->request->get();
//        if(Yii::$app->request->isPost){
            $model = new Tvandtvlistings();
            $session = Yii::$app->session;
            $redis = Yii::$app->redis;
            $userData = Json::decode($redis->get($session['userData']['user']['auth_code']),true);
            $userId = $userData['user']['id'];
            $model->tv_id = $post['tv_id'];
            $model->tvl_id =  $post['tvl_id'];
            $model->day_time =  $post['day_time'];
            $model->user_id = $userId;
            $model->time = time();
            if($model->save()){
                $response->data=['state' => '200','data'=>$model];
                Yii::$app->end();
            }
        $response->data=$model->errors;
//        }
    }
    public function actionTvdEdit(){
    }
    public function actionTvdDel(){
        }
}
