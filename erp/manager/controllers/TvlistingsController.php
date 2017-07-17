<?php

namespace app\erp\manager\controllers;
use app\erp\admin\controllers\ConfController;
use app\erp\models\SysAttachment;
use app\erp\models\Tv;
use app\erp\models\Tvandtvlistings;
use app\erp\models\Tvlistings;
use app\erp\models\TvlistingsData;
use Yii;
use yii\data\Pagination;
use yii\helpers\Json;

/**
 * Default controller for the `manager` module
 */
class TvlistingsController extends ConfController {
    public function actionIndex(){
        $hostURL = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $reqURL = Yii::$app->request->get('reqURL');
        $params = Yii::$app->params['tvlistings'];
        $model = Tvlistings::find();
        $count = $model->count();
        $pageSize = $params['list'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $managers = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render(
            "index", [
                'managers' => $managers,
                'pager' => $pager,
                'params' => $params,
                'hostURL' => $hostURL,
                'reqURL' => $reqURL,
            ]);
    }
    public function actionAdd(){
        $reqURL = Yii::$app->request->get('reqURL');
        $tv = new Tvlistings();
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isPost){
            if($tv->add($post)){
                return $this->redirect(["tvlistings/showlist",'tv_id'=>$tv->getPrimaryKey(),'reqURL'=>$reqURL]);
            }
            var_dump($tv->add($post));
            var_dump($tv->errors);
        }
        return $this->render(
            'edit',[
            'tv'=>$tv,
            'reqURL' => $reqURL,
        ]);
    }
//    public function actionEdit(){
//        $reqURL = Yii::$app->request->get('reqURL');
//        $id = Yii::$app->request->get('id');
//        $tv = Tv::findOne($id);
//        $post = Yii::$app->request->post();
//        if(Yii::$app->request->isPost){
//            $tv->load($post);
//            if ($tv->save()){
//                Yii::$app->session->setFlash('info', '修改成功');
//                $reqURL = (boolean)$reqURL ? $reqURL : ["/manager/tvlistings/index"];
//                return $this->redirect($reqURL);
//            }
//        }
//        return $this->render(
//            'edit',[
//            'tv'=>$tv,
//            'reqURL' => $reqURL,
//        ]);
//    }
    public function actionEdit(){
        $reqURL = Yii::$app->request->get('reqURL');
        $id = Yii::$app->request->get('id');
        $tv = Tvlistings::findOne($id);
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isPost){
            $tv->load($post);
            if ($tv->save()){
                Yii::$app->session->setFlash('info', '修改成功');
                $reqURL = (boolean)$reqURL ? $reqURL : ["/manager/tvlistings/index"];
                return $this->redirect($reqURL);
            }
        }
        return $this->render(
            'edit',[
            'tv'=>$tv,
            'reqURL' => $reqURL,
        ]);
    }
    public function actionTvstate(){
        if(!(boolean)Yii::$app->request->get('id')
            &&!(Yii::$app->request->get('state')==1||Yii::$app->request->get('state')==0)){
            return $this->redirect(['/manager/tvlistings']);
        }
        $id = Yii::$app->request->get('id');
        $state = Yii::$app->request->get('state');
        $reqURL = (boolean)Yii::$app->request->get('reqURL') ? Yii::$app->request->get('reqURL'): '/manager/tvlistings';
        $model = Tvlistings::findOne($id);
        $model->state = $state;
        if($model->save()){
            return $this->redirect($reqURL);
        }
        return $this->redirect($reqURL);
    }
    public function actionTvdstate(){
        if(!(boolean)Yii::$app->request->get('id')
            &&!(Yii::$app->request->get('state')==1||Yii::$app->request->get('state')==0)){
            return $this->redirect(['/manager/tvlistings']);
        }
        $id = Yii::$app->request->get('id');
        $state = Yii::$app->request->get('state');
        $reqURL = (boolean)Yii::$app->request->get('reqURL') ? Yii::$app->request->get('reqURL'): '/manager/tvlistings';
        $model = TvlistingsData::findOne($id);
        $model->state = $state;
        if($model->save()){
            return $this->redirect($reqURL);
        }
//        var_dump($model->errors);

        return $this->redirect($reqURL);

    }
    public function actionShowlist(){
        $hostURL = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if(!(boolean)Yii::$app->request->get('reqURL')
            &&!(boolean)Yii::$app->request->get('tv_id')){
            return $this->redirect(['/manager/tvlistings']);
        }
        $reqURL = Yii::$app->request->get('reqURL');
        $tv_id = Yii::$app->request->get('tv_id');
        $tvs = Tvlistings::find()
            ->where("id=:id",[':id'=>$tv_id])
            ->one();
        return $this->render(
            'showlist',[
                'tvs'=>$tvs,
                'reqURL' => $reqURL,
                'hostURL' => $hostURL,
        ]);
    }
    public function actionTvlist(){
        $hostURL = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if(!(boolean)Yii::$app->request->get('reqURL')
            &&!(boolean)Yii::$app->request->get('tv_id')){
            return $this->redirect(['/manager/tvlistings']);
        }
        $reqURL = Yii::$app->request->get('reqURL');
        $tv_id = Yii::$app->request->get('tv_id');
        $tvs = Tv::find()
            ->where("id=:id",[':id'=>$tv_id])
            ->one();
        $tvd = $tvs['day'];
        if((boolean)$tvd){
            $tvd = $tvd;
        }else{
            $tvd = null;
        }
        return $this->render(
            'tvlist',[
                'tvs'=>$tvs,
                'reqURL' => $reqURL,
                'tv_data' => $tvd,
                'hostURL' => $hostURL,
        ]);
    }
}
