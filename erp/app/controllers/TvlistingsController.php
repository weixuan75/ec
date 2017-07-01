<?php

namespace app\erp\app\controllers;
use app\erp\admin\controllers\ConfController;
use app\erp\models\TvlistingsData;
use Yii;
use yii\helpers\Json;

/**
 * Default controller for the `manager` module
 */
class TvlistingsController extends ConfController {
    public function actionIndex(){

    }
    public function actionAddtd(){
        $response = Yii::$app->response;
        $response->format = yii\web\Response::FORMAT_JSON;
        $model = new TvlistingsData();
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isPost){
            $session = Yii::$app->session;
            $redis = Yii::$app->redis;
            $userData = Json::decode($redis->get($session['userData']['user']['auth_code']),true);
            $userId = $userData['user']['id'];
            $model->sort = $post['sort'];
            $model->tv_id = $post['tv_id'];
            $model->name = $post['name'];
            $model->path = $post['path'];
            $model->type = $post['type'];
            $model->pay_time = $post['pay_time'];
            $model->state = $post['state'];
            $model->content = $post['content'];
            $model->user_id = $userId;
            $model->create_time = time();
            if($model->save()){
                $response->data=['state' => '200','data'=>"保存成功"];
                Yii::$app->end();
            }
            $response->data = $model->errors;
        }
    }
}
