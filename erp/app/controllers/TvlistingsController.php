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
        $response = Yii::$app->response;
        $response->format = yii\web\Response::FORMAT_JSON;
        $tvModel = TvlistingsData::find()->select(["name","path","type","pay_time"])->all();
        $response->data= $tvModel;
    }
    public function actionTvs(){
        $response = Yii::$app->response;
        $response->format = yii\web\Response::FORMAT_JSON;
        $tv_id = Yii::$app->request->get("tv_id");
//        if(Yii::$app->request->isPost){
            $tvModel = new TvlistingsData();
            $tvs = $tvModel::find()
                ->where("tv_id=:tv_id",[':tv_id'=>$tv_id])
                ->orderBy("sort")
                ->all();
            $response->data= $tvs;
            Yii::$app->end();
//        }
//        $response->data= null;
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
                $response->data=['state' => '200','data'=>$model];
                Yii::$app->end();
            }
            $response->data = $model->errors;
        }
    }
    public function actionTvdEdit(){
//        id=32
        $id = Yii::$app->request->get('id');
//        state=0
        $state = Yii::$app->request->get('id');
        $model = TvlistingsData::findOne($id);

//        $post = Yii::$app->request->post();
//        if(Yii::$app->request->isPost){
//            $session = Yii::$app->session;
//            $redis = Yii::$app->redis;
//            $userData = Json::decode($redis->get($session['userData']['user']['auth_code']),true);
//            $userId = $userData['user']['id'];
//            $model->sort = $post['sort'];
//            $model->tv_id = $post['tv_id'];
//            $model->name = $post['name'];
//            $model->path = $post['path'];
//            $model->type = $post['type'];
//            $model->pay_time = $post['pay_time'];
//            $model->state = $post['state'];
//            $model->content = $post['content'];
//            $model->user_id = $userId;
//            $model->create_time = time();
//            if($model->save()){
//                $response->data=['state' => '200','data'=>$model];
//                Yii::$app->end();
//            }
//            $response->data = $model->errors;
//        }
    }
    public function actionTvdDel(){
//        $response = Yii::$app->response;
//        $response->format = yii\web\Response::FORMAT_JSON;
//        $model = new TvlistingsData();
//        $post = Yii::$app->request->post();
//        if(Yii::$app->request->isPost){
//            $session = Yii::$app->session;
//            $redis = Yii::$app->redis;
//            $userData = Json::decode($redis->get($session['userData']['user']['auth_code']),true);
//            $userId = $userData['user']['id'];
//            $model->sort = $post['sort'];
//            $model->tv_id = $post['tv_id'];
//            $model->name = $post['name'];
//            $model->path = $post['path'];
//            $model->type = $post['type'];
//            $model->pay_time = $post['pay_time'];
//            $model->state = $post['state'];
//            $model->content = $post['content'];
//            $model->user_id = $userId;
//            $model->create_time = time();
//            if($model->save()){
//                $response->data=['state' => '200','data'=>$model];
//                Yii::$app->end();
//            }
//            $response->data = $model->errors;
        }
}
