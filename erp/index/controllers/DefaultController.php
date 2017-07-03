<?php

namespace app\erp\index\controllers;

use app\erp\admin\controllers\ConfController;

/**
 * Default controller for the `index` module
 */
class DefaultController extends ConfController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
