<?php

namespace app\erp\app\controllers;
use app\erp\admin\controllers\ConfController;
use app\erp\models\SysAttachment;
use app\erp\models\UploadForm;
use app\erp\util\Uploader;
use Yii;
use yii\helpers\Json;
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
    /**
     * Ajax 添加附件数据库信息
     * @param $name 附件名称
     * @param $oldname 文件原名称
     * @param $path 附件路径
     * @param $size 附件大小
     * @param $ext 扩展名
     * @param $uploadtime 上传时间
     * @param $upload_ip 上传IP
     */
    public function ajaxAtt($name,$oldname,$path,$size,$ext,$uploadtime,$upload_ip){
        $session = Yii::$app->session;
        $redis = Yii::$app->redis;
        if(!(boolean)$redis->get($session['userData']['user']['auth_code'])){
            return false;
        }+
            $SysAttachment = new SysAttachment();
//             'name' => '附件名称',
            $SysAttachment->name = $name;
//            'oldname' => '文件原名称',
            $SysAttachment->oldname = $oldname;
//            'path' => '附件路径',
            $SysAttachment->path = $path;
//            'size' => '附件大小',
            $SysAttachment->size = $size;
//            'ext' => '扩展名',
            $SysAttachment->ext = $ext;
//            'user_id' => '操作员ID',
            $SysAttachment->user_id = $redis->get($session['userData']['user']['id']);
//            'uploadtime' => '上传时间',
            $SysAttachment->uploadtime = $uploadtime;
//            'upload_ip' => '上传IP',
            $SysAttachment->upload_ip = $upload_ip;
//            'state' => '状态',
            $SysAttachment->state = 1;
//            'authcode' => '附件路径MD5值',
            $SysAttachment->authcode = md5($path);

            if($SysAttachment->save()){
                return true;
            }
        return false;
    }
}
