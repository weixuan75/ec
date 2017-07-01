<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="icon-film"></i><?=$tvs->name ?>
            </div>
            <div class="card-block">
                'ID',<?=$tvs->id ?>
                <br>'名称',<?=$tvs->name ?>
                <br>'周{0，1，2，3，4，5，6}',<?=$tvs->weeks ?>
                <br>'天{[开始时间，结束时间]，[12321354，12321354]，[12321354，12321354]}',<?=$tvs->day ?>
                <br>'播放的店铺：0/null,全部店铺播放，[1,2,3,4]',<?=$tvs->shop_id ?>
                <br> '状态',<?=$tvs->state ?>
                <br>'设置默认，等于1时，失效的店铺播放默认的电视节目单',<?=$tvs->is_conf ?>
                <br>'介绍',<?=$tvs->content ?>
                <br>'操作员',<?=$tvs->user_id ?>
                <br>'创建时间',<?=$tvs->create_time ?>
                <br>'修改时间',<?=$tvs->update_time ?>
            </div>
            <div class="card-footer">
                <a href="<?=Url::to(['tvlistings/add']) ?>" class="btn btn-bg btn-primary"><i class="fa fa-dot-circle-o"></i> 添 加 内 容 </a>
                <a href="<?=$reqURL = (boolean)$reqURL ? $reqURL : Url::to(['manager/tvlistings']) ?>" class="btn btn-bg btn-danger"><i class="fa fa-dot-circle-o"></i> 返 回 列 表 </a>
            </div>
        </div>
    </div>
    <!--/.col-->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                节目内容列表
            </div>
            <div class="card-block">
                <div class="card-block">
                    <div class="col-sm-6 col-md-4">
                        <div class="btn btn-secondary btn-lg btn-block text-center">
                            <i class="icon-plus icons d-block" style="font-size: 10em"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.col-->
</div>

<style>
    .btn {margin: 3px;}
    .imagelistAll>ul {list-style: none}
    .imagelistAll>ul>li {list-style: none;	float: left}
    .imagelistFile>img,.imagelistAll>ul>li>img{margin:5px;padding:5px;	border: 1px solid #9d9d9d}
    .imagelistFile *,imagelistAll *{float: left}
    .imagelistAll>ul>li>.shouImg{border: 5px solid #419641;}
    .demo {width: 620px;margin: 30px auto;}
    .demo p {line-height: 32px;}
    .btn2 {position: relative;overflow: hidden;margin: auto;display: inline-block;*display: inline;padding: 20px;font-size: 20px;line-height: 68px;*line-height: 60px;color: #fff;text-align: center;vertical-align: middle;cursor: pointer;border: 1px solid #cccccc;border-color: #e6e6e6 #e6e6e6 #bfbfbf;border-bottom-color: #b3b3b3;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;}
    .btn2 input ,.ImageOne{width: 100%;padding: 30px;line-height: 68px;position: absolute;top: 0;left: 0;margin: 0;border: solid transparent;opacity: 0;filter: alpha(opacity = 0);cursor: pointer;}
</style>
<div class="col-md-6 mb-2">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active  font-2xl" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-expanded="true"><i class="icon-picture icons"></i> 图 片</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  font-2xl" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-expanded="false"><i class="icon-film icons "></i> 视 频</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="home2" role="tabpanel" aria-expanded="true">
            <script src="/js/jquery.form.js"></script>
            <div class="row col-xs-12">
                <div id="main"  class="row col-xs-12">
                    <div class="demo">
                        <div class="btn2" style="background: #09c">
                            <span>添加图片</span>
                            <div id="fileuploada">
                                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                                <input id="fileupload" type="file" name="UploadForm">
                            </div>
                        </div>
                        <div id="filesStr"></div>
                        <div id="showimg"></div>
                    </div>
                </div>
                <div class="imagelistFile text-center row col-xs-12" id="imagelistFile"></div>
            </div>
        </div>
        <div class="tab-pane" id="profile2" role="tabpanel" aria-expanded="false">
            <div class="form-group field-sysattachment-name required">
                <label class="control-label" for="sysattachment-name">附件名称</label>
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                <input type="text" id="sysattachment-name" class="form-control" name="UploadForm" aria-required="true">
                <div class="help-block"></div>
            </div>
            <div class="form-group field-sysattachment-url required">
                <label class="control-label" for="sysattachment-url">web地址</label>
                <input type="text" id="sysattachment-url" class="form-control" name="SysAttachment[url]" aria-required="true">
                <div class="help-block"></div>
            </div>

        </div>
    </div>
</div>

<script>
    $(function () {
        var bar = $('.bar');
        var percent = $('.percent');
        var showimg = $('#showimg');
        var progress = $(".progress");
        var files = $("#files");
        var btn = $(".btn span");
        var urlPOST = "<?= \yii\helpers\Url::to(['/app/attachment/up'])?>";
        $("#fileuploada").wrap(
            "<form id=\"myupload\" " +
            "action=\"" + urlPOST +
            "\" method='post' enctype='multipart/form-data'></form>"
        );
        $("#fileupload").change(function() {
            $("#myupload").ajaxSubmit({
                dataType: 'json',
                beforeSend: function() {
                    showimg.empty();
                    progress.show();
                    var percentVal = "0%";
                    bar.width(percentVal);
                    percent.html(percentVal);
                    btn.html("上传中...");
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal);
                    percent.html(percentVal);
                },
                success: function(data) {
                    var img = data.webURL;
                    var name = data.name;
                    var size = data.size;
                    var type = data.type;
                    var webURL = data.webURL;
                    var rootPath = data.rootPath;
                },
                error:function(xhr){
                    btn.html("重新添加");
                    bar.width('0');
                    files.html(xhr.responseText);
                }
            });
        });
    });
</script>