<?php

namespace app\erp\admin\controllers;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends ConfController{
    public function actionIndex(){
        return $this->render('index');
    }
}
