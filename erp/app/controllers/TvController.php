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
        $tvandtvl = Tvandtvlistings::find()->where(["tv_id"=>$tvAll['id']])->all();
        $tvlistings = null;
        $td = null;
        $arr =[];
        $arr2 =[];
        foreach ($tvandtvl as $tal){
            $tvlistings = Tvlistings::find();
            $tvlistings = $tvlistings->where(["id"=>$tal['tvl_id'],"state"=>1])->all();
            foreach ($tvlistings as $tl){
                $td = TvlistingsData::find();
                $td = $td->select(['name','path','type','pay_time'])
                    ->where(["tv_id"=>$tl['id'],"state"=>1])
                    ->orderBy("sort ASC")
                    ->all();
                $arr2[]=$td;
            }
            $arr[]=[
                "time"=>$tal['day_time'],
                "data"=>$arr2
            ];
        }
        $response->data=$arr;
//        var_dump($arr);
    }
    public function actionShowlist(){
        $response = Yii::$app->response;
        $response->format = yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->request->get("id");
        $tal = Tvandtvlistings::find()->where(["tv_id"=>$id])->all();
        foreach ($tal as $tall){
            $tv = Tvlistings::find()->where(['id'=>$tall->tvl_id])->one();
//            foreach ($tall->tvlistings as $tl){
//            echo Json::encode($tv);
//                echo $tal['tvl_id']."--";
//                echo $tl['name']."--";
//                echo $tl['id']."++<br>";
//                if($tal['tvl_id']==$tl['id']){
                    $arr[]=[
                        "id"=>$tall['id'],
                        "dayTime"=>$tall['day_time'],
                        "name"=>$tv['name'],
                    ];
//                }
//            }
        }
//        foreach ($tv->tvlistings as $tl) {
//            $tal = Tvandtvlistings::find()
//                ->where(["tvl_id"=>$tl['id']])
//                ->one();
//            $arr[]=[
//                "id"=>$tal->id,
//                "dayTime"=>$tal->day_time,
//                "name"=>$tl['name'],
//            ];
//        }
//        var_dump($arr);
        $response->data=$arr;
    }
    public function actionTaldel(){
        $response = Yii::$app->response;
        $response->format = yii\web\Response::FORMAT_JSON;
        $session = Yii::$app->session;
        $redis = Yii::$app->redis;
        if((boolean)$redis->get($session['userData']['user']['auth_code'])){
            $id = Yii::$app->request->get("id");
            $response->data=Tvandtvlistings::findOne($id)->delete();
        };
    }
}
