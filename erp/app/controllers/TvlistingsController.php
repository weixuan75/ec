<?php

namespace app\erp\app\controllers;
use app\erp\admin\controllers\ConfController;
use app\erp\models\Tvlistings;
use Yii;
use yii\data\Pagination;
use yii\helpers\Json;

/**
 * Default controller for the `manager` module
 */
class TvlistingsController extends ConfController {
    public function actionIndex(){
//        店铺的ID
        $sthopId = YIi::$app->request->get("shop_id");
        if(!is_null($sthopId)){
            $model = Tvlistings::find()
                //状态必须是激活状态
                ->where("state=0")
                ->orderBy("id DESC")
                ->one();
            var_dump((boolean)$model);
        }else{
            $model = Tvlistings::find()
                //状态必须是激活状态
                ->where("state=0")
                ->orderBy("id DESC")
                ->one();
            var_dump((boolean)$model);
        }
//        更加店铺的ID播放指定的广告
        //没有ID
        //播放默认的广告
        //没有默认的广告播放最后一条广告
        //状态必须是激活状态
        $model = Tvlistings::find()
            //状态必须是激活状态
            ->where("state=0")
            ->orderBy("id DESC")
            ->one();
        var_dump((boolean)$model);

        $tv_id = Yii::$app->request->get('tv_id');
        $tvs = Tvlistings::find()
            ->with("tvlistingsData")
            ->where("id=:id",[':id'=>$tv_id])
            ->one();
//       var_dump($tvs);
//        $arr = $tvs->toArray();
//        $arr['tvlistingsData']=$tvs['tvlistingsData'];
//       echo Json::encode($arr);
        return Json::encode($model);
    }
}
