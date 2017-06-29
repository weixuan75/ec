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
        return $this->redirect(['login']);
    }
    public function actionLogin(){
        $this->layout = false;
        $session = Yii::$app->session;
        $redis = Yii::$app->redis;
        if((boolean)$redis->get($session['userData']['user']['auth_code'])){
            return $this->redirect(['/manager']);
        };
        $admin = new Sysadmin();
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isPost){
            if ($admin->login($post)){
                return $this->redirect(['/manager']);
            }
        }
        return $this->render(
            'login',
            ["admin"=>$admin]);
    }
    public function actionLogout(){
        $session = Yii::$app->session;
        $redis = Yii::$app->redis;
        $redis->del($session['userData']['user']['auth_code']);
        $session->removeAll();
        return $this->redirect(['login']);
    }
}
