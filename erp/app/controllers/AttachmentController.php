<?php

namespace app\erp\app\controllers;
use app\erp\admin\controllers\ConfController;
use app\erp\models\UploadForm;
use app\erp\util\Uploader;
use Yii;
use yii\web\UploadedFile;

/**
 * Default controller for the `manager` module
 */
class AttachmentController extends ConfController {
    public function actionIndex(){
        $model = new UploadForm();
        if (Yii::$app->request->isPost) {
            $arr = UploadedFile::getInstance($model, 'imageFile');
            print_r($model);
            echo "<br>————————————————————————————————————————<br>";
            print_r($arr);
            Yii::$app->end();
//            if ($model->upload()) {
//                // 文件上传成功
//                return;
//            }
        }
        return $this->render("index",['model' => $model]);
    }
    public function actionUpload(){

        $model = new UploadForm();
        $CONFIG = Yii::$app->params['uploadFileCon'];
//        $action = Yii::$app->request->post('action');
        $action = 'uploadimage';
        if(Yii::$app->request->isPost){
            $base64 = "upload";
            switch (htmlspecialchars($action)) {
                case 'uploadimage':
                    $config = array(
                        "pathFormat" => $CONFIG['imagePathFormat'],
                        "maxSize" => $CONFIG['imageMaxSize'],
                        "allowFiles" => $CONFIG['imageAllowFiles']
                    );
                    $fieldName = $CONFIG['imageFieldName'];
                    break;
                case 'uploadscrawl':
                    $config = array(
                        "pathFormat" => $CONFIG['scrawlPathFormat'],
                        "maxSize" => $CONFIG['scrawlMaxSize'],
                        "allowFiles" => $CONFIG['scrawlAllowFiles'],
                        "oriName" => "scrawl.png"
                    );
                    $fieldName = $CONFIG['scrawlFieldName'];
                    $base64 = "base64";
                    break;
                case 'uploadvideo':
                    $config = array(
                        "pathFormat" => $CONFIG['videoPathFormat'],
                        "maxSize" => $CONFIG['videoMaxSize'],
                        "allowFiles" => $CONFIG['videoAllowFiles']
                    );
                    $fieldName = $CONFIG['videoFieldName'];
                    break;
                case 'uploadfile':
                default:
                    $config = array(
                        "pathFormat" => $CONFIG['filePathFormat'],
                        "maxSize" => $CONFIG['fileMaxSize'],
                        "allowFiles" => $CONFIG['fileAllowFiles']
                    );
                    $fieldName = $CONFIG['fileFieldName'];
                    break;
            }
            /* 生成上传实例对象并完成上传 */
            $up = new Uploader($fieldName, $config, $base64);
            /**
             * 得到上传文件所对应的各个参数,数组结构
             * array(
             *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
             *     "url" => "",            //返回的地址
             *     "title" => "",          //新文件名
             *     "original" => "",       //原始文件名
             *     "type" => ""            //文件类型
             *     "size" => "",           //文件大小
             * )
             */
            /* 返回数据 */
            return json_encode($up->getFileInfo());
        }
        return $this->render("up",['model' => $model]);
    }
}
