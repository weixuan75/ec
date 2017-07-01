<html>
<head>
    <meta charset="utf-8">
    <title>layer弹层组件移动版</title>
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link href="demo.css" type="text/css" rel="stylesheet">
</head>
<script src="/js/jquery-3.2.1.min.js"></script>
<body>
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
<?php
//ActiveForm::end()
?>
<input type="submit" value="保存fileUploadAdd" onclick='fileUploadAdd(
"fileName",
"fileUrl",
"filePath",
26565,
"fileExt",
1
        );'>
<script>
    function fileUploadAdd(
        fileUrl,
        fileName,
        filePath,
        fileSize,
        fileExt,
        fileState,
    ){
        $.ajax({
            url:"<?= \yii\helpers\Url::to(['/app/attachment/add'])?>",
            type:"post",
            data:{
                "_csrf":"<?= Yii::$app->request->csrfToken ?>",
                'name':fileName,
                'url':fileUrl,
                'path':filePath,
                'size':fileSize,
                'ext':fileExt,
                'state':fileState
            },
            success:function (result,status,xhr) {
                alert("result:【"+result.state+"】【"+result.data+"】");
                alert("status:【"+status+"】");
                alert("xhr:【"+xhr+"】");
//                location.href("index.php?r=app/attachment/addtd");
            }});
    }
</script>

<input type="submit" value="保存addtd" onclick='TvlistingsDataAdd(
        1,
        1,
        "name11111111111",
        "webURL",
        "rootPath",
        1,
        3,
        1,
        "content",
        45820
        );'>
<script>
    function TvlistingsDataAdd(
        sort,
        tv_id,
        name,
        webURL,
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
                "tv_id":tv_id,
                "name":name,
                "url":webURL,
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
    }
</script>
</body>
</html>