<?php

namespace app\erp\manager\controllers;

use app\erp\admin\controllers\UserController;
use app\erp\models\Menu;
use yii\web\Controller;

/**
 * Default controller for the `manager` module
 */
class MenuController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionAdd(){
        $Menu = new Menu();
        return $this->render(
            'edit',[
                'menu'=>$Menu
        ]);
    }
}
