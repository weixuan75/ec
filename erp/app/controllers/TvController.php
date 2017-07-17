<?php

namespace app\erp\app\controllers;
use app\erp\admin\controllers\ConfController;
use app\erp\models\Tv;
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
    public function actionTvdl(){
        $response = Yii::$app->response;
        $response->format = yii\web\Response::FORMAT_JSON;
        $tvAll = Tv::find()->where(["is_conf"=>1,"state"=>1])->one();
        if(!(boolean)$tvAll){
            $tvAll = Tv::find()->where(["state"=>1])
                ->orderBy("id DESC")->one();
            if(!(boolean)$tvAll){
                $response->data=['state'=>'200',"data"=>'请设置启动电视'];
                Yii::$app->end();
            }
            $tvandtvl = Tvandtvlistings::find()->where(["tv_id"=>$tvAll['id']])->all();
            $tvlistings = null;
            $td = null;
            $arr =[];
            $arr2 =[];

//            foreach ($tvandtvl as $tal){
//                $tvlistings = Tvlistings::find()->with('tvlistingsData')->where(["id"=>$tal['tvl_id'],"state"=>1])->one();
//                $td = $tvlistings->tvlistingsData;
//                $arr2=$td;
////                foreach ($tvlistings as $tl){
////                    $td = TvlistingsData::find();
////                    $td = $td->select(['name','path','type','pay_time'])
////                        ->where(["tv_id"=>$tl['id'],"state"=>1])
////                        ->orderBy("sort ASC")
////                        ->all();
////
////                }
//                $arr[]=[
//                    "time"=>$tal['day_time'],
//                    "data"=>$arr2
//                ];
//            }
            foreach ($tvandtvl as $tal){
                $tvlistings = Tvlistings::find();
                $tvlistings = $tvlistings->with('tvlistingsData')->where(["id"=>$tal['tvl_id'],"state"=>1])->all();
                foreach ($tvlistings as $tl){
                    $td = TvlistingsData::find();
                    $td = $td->select(['name','path','type','pay_time'])
                        ->where(["tv_id"=>$tl['id'],"state"=>1])
                        ->orderBy("sort ASC")
                        ->all();
                    $arr2=$td;
                }
                $arr[]=[
                    "time"=>$tal['day_time'],
                    "data"=>$arr2
                ];
            }
            $response->data=$arr;
            Yii::$app->end();
        }else{
            $response->data=['state'=>'200',"data"=>'请设置启动电视'];
        }
    }
    public function actionShowlist(){
        $response = Yii::$app->response;
        $response->format = yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->request->get("id");
        $tal = Tvandtvlistings::find()->where(["tv_id"=>$id])->orderBy("day_time ASC")->all();
        foreach ($tal as $tall){
            $tv = Tvlistings::find()->where(['id'=>$tall->tvl_id])->one();
                    $arr[]=[
                        "id"=>$tall['id'],
                        "dayTime"=>$tall['day_time'],
                        "name"=>$tv['name'],
                        "tvdId"=>$tv['id'],
                    ];
        }
        $response->data=$arr;
    }
    public function actionTaldel(){
        if(Yii::$app->request->isPost){
            $response = Yii::$app->response;
            $response->format = yii\web\Response::FORMAT_JSON;
            $session = Yii::$app->session;
            $redis = Yii::$app->redis;
            if((boolean)$redis->get($session['userData']['user']['auth_code'])){
                $id = Yii::$app->request->post("id");
                $tv = Tvandtvlistings::findOne($id);
                if($tv->delete()){
                    $response->data=['code'=>200,"data"=>"成功"];
                }else{
                    $response->data=['code'=>0,"data"=>"失败"];
                }
            }
        }
    }
    public function actionTaledit(){
        if(Yii::$app->request->isPost){
            $response = Yii::$app->response;
            $response->format = yii\web\Response::FORMAT_JSON;
            $session = Yii::$app->session;
            $redis = Yii::$app->redis;
            if((boolean)$redis->get($session['userData']['user']['auth_code'])){
                $post = Yii::$app->request->post();
                $tal = Tvandtvlistings::findOne($post['id']);
                $tal->tvl_id = $post["tvlId"];
                $tal->day_time = $post["dayTime"];
                if($tal->update()){
                    $response->data=$tal;
                    Yii::$app->end();
                }
                $response->data=$tal->errors;
//                $response->data=;
            }
        }
    }
    public function actionTal(){
        $this->layout = false;
        return $this->render("tal");
    }
}
