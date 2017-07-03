<?php

namespace app\erp\app\controllers;
use app\erp\admin\controllers\ConfController;
use app\erp\models\SysAttachment;
use app\erp\models\TvlistingsData;
use app\erp\models\UploadForm;
use app\erp\util\Upload;
use app\erp\util\Uploader;
use Yii;
use yii\helpers\Json;
use yii\web\UploadedFile;

/**
 * Default controller for the `manager` module
 */
class AttachmentController extends ConfController {
    public function actionIndex(){
        $model = new UploadForm();
        if (Yii::$app->request->isPost) {
            $arr = UploadedFile::getInstance($model, 'imageFile');
            print_r($model);
            echo "<br>————————————————————————————————————————<br>";
            print_r($arr);
            Yii::$app->end();
        }
        return $this->render("index",['model' => $model]);
    }
    public function actionIn(){
        $model = new TvlistingsData();
    $this->layout = false;
        return $this->render("in",['model' => $model]);
    }

    public function actionAdd(){
        $response = Yii::$app->response;
        $response->format = yii\web\Response::FORMAT_JSON;
        $model = new SysAttachment();
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isPost){
            $session = Yii::$app->session;
            $redis = Yii::$app->redis;
            $userData = Json::decode($redis->get($session['userData']['user']['auth_code']),true);
            $userId = $userData['user']['id'];
            $model->name = $post['name'];
            $model->url = $post['url'];
            $model->path = $post['path'];
            $model->size = $post['size'];
            $model->ext = $post['ext'];
            $model->user_id = $userId;
            $model->upload_time = time();
            $model->upload_ip = (string)ip2long(Yii::$app->request->userIP);
            $model->state = 1;
            $model->auth_code = md5($post['url']);
            if($model->save()){
                $response->data=['state' => '200','data'=>"保存成功"];
                Yii::$app->end();
            }
            $response->data = $model->errors;
        }
    }

    public function actionUp(){
        $response = Yii::$app->response;
        $response->format = yii\web\Response::FORMAT_JSON;
        if(Yii::$app->request->isPost){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $model = new SysAttachment();
                $date = date("Y/m/d");
                $upload=new Upload('UploadForm','uploders/image/'.$date);
                $dest=$upload->uploadFile();
                if(!(boolean)$dest){
                    throw new \Exception();
                }
                $arr = array();
                $arr["name"]=$upload->getName();
                $arr["size"]=$upload->getSize();
                $arr["type"]=$upload->getType();
                $arr["webURL"]="http://".$_SERVER['SERVER_NAME']."/".$dest;
                $arr["rootPath"]=$dest;

                $session = Yii::$app->session;
                $redis = Yii::$app->redis;
                $userData = Json::decode($redis->get($session['userData']['user']['auth_code']),true);
                if(!(boolean)$userData){
                    throw new \Exception();
                }
                $userId = $userData['user']['id'];
                $model->name = $upload->getName();
                $model->url = "http://".$_SERVER['SERVER_NAME']."/".$dest;
                $model->path = $dest;
                $model->size = $upload->getSize();
                $model->ext = $upload->getType();
                $model->user_id = $userId;
                $model->upload_time = time();
                $model->upload_ip = (string)ip2long(Yii::$app->request->userIP);
                $model->state = 1;
                $model->auth_code = md5($dest);
                if(!$model->save()){
                    throw new \Exception();
                }
                $transaction->commit();
                $response->data=['state' => '200','data'=>$model];
                Yii::$app->end();
            }catch (\Exception $e){
                $response->data = $e;
                $transaction->rollBack();
            }
        }
    }
}
