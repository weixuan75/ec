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
                <div class="row">
                <div class="col-md-4">
                    ID：<?=$tvs->id ?>
                    <br>名称：<?=$tvs->name ?>
                    <br>周：<?php
                    $weeks = explode(",",$tvs->weeks);
                    foreach ($weeks as $k){
                        echo "<a class='btn btn-secondary'>".Yii::$app->params['tvlistings']['weeks'][$k]."</a>";
                    }
                    ?>
                    <br>天：<?=$tvs->day ?>
                    <br>播放的店铺：<?= (boolean)$tvs->shop_id ? $tvs->shop_id : '全部' ?>
                    <br>状态：<?=$tvs->state ?>
                    <br>设置默认：<?=Yii::$app->params['tvlistings']['is_conf'][1][$tvs->is_conf]?><i>等于1时，失效的店铺播放默认的电视节目单</i>
                    <br>介绍：<?=$tvs->content ?>
                    <br>操作员：<?=\app\erp\models\Sysadmindate::findOne($tvs->user_id)['nickname']?>
                    <br>创建时间：<?=date("Y\年m\月d\日 H:i:s", $tvs->create_time)?>
                    <br>修改时间：<?=date("Y\年m\月d\日 H:i:s", $tvs->update_time)?>
                </div>
            </div>
            </div>
            <div class="card-footer">
                <a href="<?=Url::to(
                        ['/manager/tvlistings/edit',
                            'id'=>$tvs->id,
                            "reqURL"=>
                                $reqURL = ((boolean)$reqURL ? $reqURL : Url::to(['/manager/tvlistings']))]); ?>" class="btn btn-bg btn-primary"><i class="fa fa-dot-circle-o"></i> 编 辑 节目 </a>
                <a href="<?=$reqURL = (boolean)$reqURL ? $reqURL : Url::to(['/manager/tvlistings']) ?>" class="btn btn-bg btn-danger"><i class="fa fa-dot-circle-o"></i> 返 回 列 表 </a>
            </div>
        </div>
    </div>
    <!--/.col-->
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <table class="table table-hover table-outline mb-0 hidden-sm-down">
                <thead class="thead-default">
                <tr>
                    <th class="text-center">排序</th>
                    <th class="text-center">路径</th>
                    <th class="text-center">名称</th>
                    <th class="text-center">状态</th>
                    <th class="text-center">类型</th>
                    <th class="text-center">播放时间</th>
                    <th class="text-center">介绍</th>
                    <th class="text-center">操作员</th>
                    <th class="text-center">创建时间</th>
                    <th class="text-center">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if((boolean)$tv_data) {
                    foreach ($tv_data as $td):
                        ?>
                        <tr id="tvData_<?= $td->id ?>">
                            <td class="text-center"><?= $td->sort ?></td>
                            <td class="text-center">
                                <div class="avatar">
                                    <img src="<?= $td->path ?>" class="img-avatar">
                                </div>
                            </td>
                            <td class="text-center"><?= $td->name ?></td>
                            <td class="text-center"><?= Yii::$app->params['tvlistings']['state'][1][$td->state] ?></td>
                            <td class="text-center"><?= $td->type ?></td>
                            <td class="text-center"><?= $td->pay_time ?></td>
                            <td class="text-center"><?= $td->content ?></td>
                            <td class="text-center"><?= $td->user_id ?></td>
                            <td class="text-center"><?= date("Y-m-d H:i:s", $td->create_time) ?></td>
                            <td class="text-center">
                                <?php
                                if ((boolean)$td->state) {
                                    ?>
                                    <a href="<?= Url::to(['/manager/tvlistings/tvdstate', 'id' => $td->id,'state'=>0,'reqURL'=>(Url::to(['/manager/tvlistings/showlist','tv_id' => $tvs->id])."#tvData_".$td->id)]) ?>"
                                       class="btn btn-bg btn-danger">禁用</a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="<?= Url::to(['/manager/tvlistings/tvdstate', 'id' => $td->id,'state'=>1,'reqURL'=>(Url::to(['/manager/tvlistings/showlist','tv_id' => $tvs->id])."#tvData_".$td->id)]) ?>"
                                       class="btn btn-bg btn-primary">启动</a>
                                    <?php
                                }
                                ?>
                                <a href="<?= Url::to(['/app/tvlistings/tvdDel', 'id' => $td->id]) ?>"
                                   class="btn btn-bg btn-primary">删除</a>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                }
                ?>
                </tbody>
            </table>
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
<script>
    $(function () {
        $("#addTVD").hide();
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
                    var img = data.data.url;
                    var name = data.data.name;
                    var type = data.data.type;
                    var ext = data.data.ext;
                    $("#addTVD").show();
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

<script>
    function TvlistingsDataAdd(sort,name,rootPath,type,payTime,pState,content){
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
                TvList();
                $("#addTVD").hide();
                alert("result:【"+result.state+"】【"+result.data+"】");
                alert("status:【"+status+"】");
                alert("xhr:【"+xhr+"】");
                $("#tvlistingData-name").val(null);
                $("#tvlistingData-path").html(null);
                $("#tvlistingData-type").html(null);
//                location.href("index.php?r=app/attachment/addtd");
            }
        });
    }
    function TvlistingsDataAddmp4(sort,name,rootPath,type,payTime,pState,content){
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
                TvList();
                $("#addTVD").hide();
                alert("result:【"+result.state+"】【"+result.data+"】");
                alert("status:【"+status+"】");
                alert("xhr:【"+xhr+"】");
                $("#tvlistingData-name").val(null);
                $("#tvlistingData-path").html(null);
                $("#tvlistingData-type").html(null);
//                location.href("index.php?r=app/attachment/addtd");
            }
        });
    }

    function TvList(){
        $.ajax({
            url:"index.php?r=app/tvlistings/tvs",
            type:"get",
            data:{
//                "_csrf":"<?//= Yii::$app->request->csrfToken ?>//",
                "tv_id":<?=$tvs->id ?>
            },
            success:function (result,status,xhr) {
                alert(status);
//                $("#addTVD").hide();
//                alert("result:【"+result.state+"】【"+result.data+"】");
//                alert("status:【"+status+"】");
//                alert("xhr:【"+xhr+"】");
//                $("#tvlistingData-name").val(null);
//                $("#tvlistingData-path").html(null);
//                $("#tvlistingData-type").html(null);
////                location.href("index.php?r=app/attachment/addtd");
            }
        });
    }
</script>