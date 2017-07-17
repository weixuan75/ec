<?php

namespace app\erp\app\controllers;
use app\erp\models\Sysadmindate;
use app\erp\models\SysAttachment;
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
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isPost){
            $model = new TvlistingsData();
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
    public function actionEditajax(){
        $response = Yii::$app->response;
        $response->format = yii\web\Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isPost){
            $model = TvlistingsData::find()->where(['id'=>$post["id"],'tv_id'=>$post["tvid"]])->one();
            $session = Yii::$app->session;
            $redis = Yii::$app->redis;
            if(!(boolean)$redis->get($session['userData']['user']['auth_code'])){
                return $this->redirect(['/admin/public/login']);
            }
            $model->sort = $post['sort'];
            $model->name = $post['name'];
            $model->state = $post['state'];
            $model->type = $post['type'];
            $model->pay_time = $post['payTime'];
            $model->path = $post['url'];
            $model->content = $post['content'];
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
    public function actionTvdel(){
        $response = Yii::$app->response;
        $response->format = yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');
        $model = TvlistingsData::findOne($id);
        $att = SysAttachment::find()->where("url=:url",[':url'=>$model->path])->one();
        if(!$model->delete()){
            $model=null;
            $response->data=[$model,$att];
        };
        if(!$att->delete()){
            $att=null;
            $response->data=[$model,$att];
        };
        $response->data=[$model,$att];
    }

    public function actionShowlist(){
        $response = Yii::$app->response;
        $response->format = yii\web\Response::FORMAT_JSON;
        $tv_id = Yii::$app->request->get('tv_id');
        $tvd = TvlistingsData::find()
            ->where("tv_id=:id",[':id'=>$tv_id])->all();
        $arr =[];
        foreach ($tvd as $t){
            $user = Sysadmindate::findOne($t['user_id']);

            $arr[] = [
                'id'=>$t['id'],
                'sort'=>$t['sort'],
                'tvId'=>$t['tv_id'],
                'name'=>$t['name'],
                'path'=>$t['path'],
                'type'=>$t['type'],
                'pay_time'=>$t['pay_time'],
                'state'=>$t['state'],
                'content'=>$t['content'],
                'user'=>$user['nickname'],
                'create_time'=>date('Y-m-d H:i:s',$t['create_time'])
            ];
        }
        if((boolean)$tvd){
            $tvd = $tvd;
        }else{
            $tvd = null;
        }
        $response->data=$arr;
    }
}
