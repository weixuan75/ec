<?php

namespace app\erp\admin\controllers;

use yii\web\Controller;
use Yii;
/**
 * Default controller for the `admin` module
 */
class ConfController extends Controller{
    public function init(){
        $session = Yii::$app->session;
        $redis = Yii::$app->redis;
        if(!(boolean)$redis->get($session['userData']['user']['auth_code'])){
            return $this->redirect(['public/login']);
        };
    }
}
