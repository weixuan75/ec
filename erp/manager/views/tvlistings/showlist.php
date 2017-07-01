<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
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
                <input id="sysattachment-name" class="form-control" name="UploadForm" aria-required="true">
                <div class="help-block"></div>
            </div>
            <div class="form-group field-sysattachment-url required">
                <label class="control-label" for="sysattachment-url">web地址</label>
                <input id="sysattachment-url" class="form-control" name="SysAttachment[url]" aria-required="true">
                <div class="help-block"></div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
<div class="form-group field-tvlistings-name required">
    <label class="control-label" for="tvlistingData-sort">排序</label>
    <input type="text" id="tvlistingData-sort">
    <br>
    <label class="control-label" for="tvlistingData-name">名称</label>
    <input type="text" id="tvlistingData-name" >
    <br>
    <label class="control-label" for="tvlistingData-path">路径</label>
    <span id="tvlistingData-path"></span>
    <br>
    <label class="control-label" for="tvlistingData-type">类型</label>
    <span id="tvlistingData-type"></span>
    <br>
    <label class="control-label" for="tvlistingData-pay_time">播放时间</label>
    <input type="text" id="tvlistingData-pay_time" value="5">（秒）
    <br>
</div>
<div class="form-group field-tvlistings-state">
    <label class="control-label">状态</label>
        <div class="radio">
            <label>
                <input type="radio" name="tvlistingData-state" value="0" checked="">
                <span class="badge badge-success">激活</span>
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="tvlistingData-state" value="1">
                <span class="badge badge-danger">禁用</span>
            </label>
        </div>
</div>
<div class="form-group field-tvlistings-name required">
    <label class="control-label" for="tvlistingData-content">介绍</label>
    <input id="tvlistingData-content" value="<?=$tvs->name ?>">
</div>
<div class="card-footer">
    <button onclick="" class="btn btn-bg btn-primary"> 添 加 </button>
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
                    //"name":"3.jpg",
                    // "url":"http://a.com/uploders/image/2017/07/01/ab529d0bb1c296a292aba6d04dbee47a.jpg",
                    // "path":"uploders/image/2017/07/01/ab529d0bb1c296a292aba6d04dbee47a.jpg",
                    // "size":497977,
                    // "ext":"image/jpeg",
                    // "user_id":"1","upload_time":1498889737,"upload_ip":"2130706433","state":1,"auth_code":"c5c234e56f5a2ec7e2a41e5b08da6171","id":11}}
                    var img = data.data.url;
                    var name = data.data.name;
                    var type = data.data.type;
                    var ext = data.data.ext;
                    $("#tvlistingData-sort").val(0);
                    $("#tvlistingData-name").val(name);
                    $("#tvlistingData-path").html(img);
                    $("#tvlistingData-type").html(ext);
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


<input type="submit" value="保存addtd" onclick='TvlistingsDataAdd(
                    $("#tvlistingData-sort").val(),
                    $("#tvlistingData-name").val(),
                    $("#tvlistingData-path").html(),
                    $("#tvlistingData-type").html(),

                    $("#tvlistingData-pay_time").val(),
                    0,
                    $("#tvlistingData-content").html()
        );'>
<script>
    function TvlistingsDataAdd(
        sort,
        name,
        rootPath,
        type,
        payTime,
        pState,
        content
    ){
        $.ajax({
            url:"index.php?r=app/tvlistings/addtd",
            type:"post",
            data:{
                "_csrf":"<?= Yii::$app->request->csrfToken ?>",
                "sort":sort,
                "tv_id":<?=$tvs->id ?>,
                "name":name,
                "path":rootPath,
                "type":type,
                "pay_time": payTime,
                "state" : pState,
                "content":content
            },
            success:function (result,status,xhr) {
                alert("result:【"+result.state+"】【"+result.data+"】");
                alert("status:【"+status+"】");
                alert("xhr:【"+xhr+"】");
//                location.href("index.php?r=app/attachment/addtd");
            }});
        alert(
            $("#tvlistingData-sort").val(),
            $("#tvlistingData-name").val(),
            $("#tvlistingData-path").html(),
            $("#tvlistingData-type").html(),

            $("#tvlistingData-pay_time").val(),
            $("#tvlistingData-state").val(),
            $("#tvlistingData-content").html());
    }
</script>