<?php

namespace app\erp\admin\controllers;

use yii\web\Controller;

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
        return $this->render('login');
    }
}
