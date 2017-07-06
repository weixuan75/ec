<?php

namespace app\erp\manager\controllers;
use app\erp\admin\controllers\ConfController;
use app\erp\models\Tv;
use app\erp\models\Tvandtvlistings;
use Yii;
use yii\data\Pagination;

/**
 * Default controller for the `manager` module
 */
class TvController extends ConfController {
    public function actionIndex(){
        $hostURL = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $reqURL = Yii::$app->request->get('reqURL');
        $params = Yii::$app->params['tvlistings'];
        $model = Tv::find();
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
    public function actionShow(){
        $hostURL = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if(!(boolean)Yii::$app->request->get('reqURL')
            &&!(boolean)Yii::$app->request->get('tv_id')){
            return $this->redirect(['/manager/tvlistings']);
        }
        $reqURL = Yii::$app->request->get('reqURL');
        $tv_id = Yii::$app->request->get('tv_id');
        $tvs = Tv::find()->where("id=:id",[':id'=>$tv_id])->one();
        return $this->render(
            'show',[
            'tvs'=>$tvs,
            'reqURL' => $reqURL,
            'hostURL' => $hostURL,
        ]);
    }
    public function actionAdd(){
        
    }
    public function actionTv(){
        $model = Tv::find()->with('tvlistings')->where("id=1")->one();
        var_dump($model->tvlistings);
    }
    public function actionEdit(){
        $reqURL = Yii::$app->request->get('reqURL');
        $id = Yii::$app->request->get('id');
        $tv = Tv::findOne($id);
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isPost){
            $tv->load($post);
            if ($tv->save()){
                Yii::$app->session->setFlash('info', '修改成功');
                $reqURL = (boolean)$reqURL ? $reqURL : ["/manager/tv"];
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
            return $this->redirect(['/manager/tv']);
        }
        $id = Yii::$app->request->get('id');
        $state = Yii::$app->request->get('state');
        $reqURL = (boolean)Yii::$app->request->get('reqURL') ? Yii::$app->request->get('reqURL'): '/manager/tvlistings';
        $model = Tv::findOne($id);
        $model->state = $state;
        if($model->save()){
            return $this->redirect($reqURL);
        }
        return $this->redirect($reqURL);
    }
}
