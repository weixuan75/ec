<?php

namespace app\erp\app\controllers;
use app\erp\models\Tvlistings;
use app\erp\models\TvlistingsData;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

/**
 * Default controller for the `manager` module
 */
class TvlistingsController extends Controller {
    public function actionIndex(){
        /**
         * 店铺ID
         * 内容状态 = 1
         * 播放时间周期
         * 待修改
         */
        $response = Yii::$app->response;
        $response->format = yii\web\Response::FORMAT_JSON;
        $tv = Tvlistings::find()
            ->joinWith('tvlistingsData')
            ->where(['state'=>1])
            ->where('ec_tvlistings_data.state = 1')
            ->one();
        if((boolean)$tv){
//            $tvModel = (boolean)$tv->tvlistingsData ?$tv->tvlistingsData:null;
            $tvModel = $tv->tvlistingsData;
            $arr = [];
            foreach ($tvModel as $k =>$tm){
                if($tm['state']==1){
                    $arr[] = [
                        "name"=>$tm["name"],
                        "path"=>$tm["path"],
                        "type"=>$tm["type"],
                        "pay_time"=>$tm["pay_time"]
                    ];
                }
            }
            $response->data= $arr;
            Yii::$app->end();
        }
        $response->data=['state' => '400','data'=>"无数据"];
    }
    public function actionTime(){
        /**
         * 店铺ID
         * 内容状态 = 1
         * 播放时间周期
         * 待修改
         */
        $response = Yii::$app->response;
        $response->format = yii\web\Response::FORMAT_JSON;
        $tv = Tvlistings::find()
            ->joinWith('tvlistingsData')
            ->where(['state'=>1])
            ->where('ec_tvlistings_data.state = 1')
            ->one();
        if((boolean)$tv){
//            $tvModel = (boolean)$tv->tvlistingsData ?$tv->tvlistingsData:null;
            $tvModel = $tv->tvlistingsData;
            $arr = [];
            foreach ($tvModel as $k =>$tm){
                if($tm['state']==1){
                    $arr[] = [
                        "name"=>$tm["name"],
                        "path"=>$tm["path"],
                        "type"=>$tm["type"],
                        "pay_time"=>$tm["pay_time"]
                    ];
                }
            }
            $response->data= $arr;
            Yii::$app->end();
        }
        $response->data=['state' => '400','data'=>"无数据"];
    }
    public function actionIndex3(){
        /**
         * 店铺ID
         * 内容状态 = 1
         * 播放时间周期
         * 待修改
         */
        $response = Yii::$app->response;
        $response->format = yii\web\Response::FORMAT_JSON;
        $tv = Yii::$app->db->createCommand('select `day` from `ec_tv` order by `id` desc limit 1;')->queryOne();
//        $tv = Yii::$app->db->createCommand('SELECT * FROM ec_tvlistings WHERE state=1')->queryOne();
//        $tv = Yii::$app->db->createCommand('SELECT * FROM ec_tvlistings WHERE state=1')->queryOne();
//        if((boolean)$tv){
////            $tvModel = (boolean)$tv->tvlistingsData ?$tv->tvlistingsData:null;
//            $tvModel = $tv->tvlistingsData;
//            $arr = [];
//            foreach ($tvModel as $k =>$tm){
//                if($tm['state']==1){
//                    $arr[] = [
//                        "name"=>$tm["name"],
//                        "path"=>$tm["path"],
//                        "type"=>$tm["type"],
//                        "pay_time"=>$tm["pay_time"]
//                    ];
//                }
//            }
//            $response->data= $tv;
//            Yii::$app->end();
//        }
//        $response->data=['state' => '400','data'=>"无数据"];
        $response->data=$tv;
    }
    public function actionIndex2(){
        /**
         * 店铺ID
         * 内容状态 = 1
         * 播放时间周期
         * 待修改
         */
        $response = Yii::$app->response;
        $response->format = yii\web\Response::FORMAT_JSON;
        $tv = Tvlistings::find()
            ->joinWith('tvlistingsData')
            ->where('state = 1')
            ->where('ec_tvlistings_data.state = 1')
            ->one();
        $tv['weeks'];
//        if((boolean)$tv){
////            $tvModel = (boolean)$tv->tvlistingsData ?$tv->tvlistingsData:null;
//            $tvModel = $tv->tvlistingsData;
//            $arr = [];
//            foreach ($tvModel as $k =>$tm){
//                if($tm['state']==1){
//                    $arr[] = [
//                        "name"=>$tm["name"],
//                        "path"=>$tm["path"],
//                        "type"=>$tm["type"],
//                        "pay_time"=>$tm["pay_time"]
//                    ];
//                }
//            }
//            $response->data= $arr;
//            Yii::$app->end();
//        }
        $arr = explode(",",$tv['weeks']);
        foreach ($arr as $a){
            if(date("w") == $arr){
                $response->data=[ date("w"),$arr];
            }
        }
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
//        id=32&state=0&reqURL
//        id=32
        $id = Yii::$app->request->get('id');
//        state=0
        $state = Yii::$app->request->get('state');
        $reqURL = Yii::$app->request->get('reqURL');
        $model = TvlistingsData::findOne($id);
        $model->state = $state;
        $model->save();
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
