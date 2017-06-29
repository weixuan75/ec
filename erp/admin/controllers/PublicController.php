<?php

namespace app\erp\admin\controllers;

use app\erp\admin\models\Sysadmin;
use yii\helpers\Json;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `admin` module
 */
class PublicController extends Controller{
    /**
     * 登陆
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect(['public/login']);
    }
    public function actionLogin()
    {
        $this->layout = false;
        $admin = new Sysadmin();
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isPost){
            if ($admin->login($post)){
                $redis = Yii::$app->redis;
                $redis->set("user",Json::encode($post));
                return $redis->get("user");
                Yii::$app->end();
            }
        }
        return $this->render(
            'login',
            ["admin"=>$admin]);
    }
}
