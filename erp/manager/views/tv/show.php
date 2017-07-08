<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<script type="text/javascript">
    function noNumbers(e)
    {
        var keynum;
        var keychar;
        keynum = window.event ? e.keyCode : e.which;
        keychar = String.fromCharCode(keynum);
        console.log(keynum+':'+keychar);
    }
</script>
<input type="text" onkeydown="return noNumbers(event)" />
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
                        <br>状态：<?=$tvs->state ?>
                        <br>介绍：<?=$tvs->content ?>
                        <br>操作员：<?=\app\erp\models\Sysadmindate::findOne($tvs->user_id)['nickname']?>
                        <br>创建时间：<?=date("Y\年m\月d\日 H:i:s", $tvs->create_time)?>
                        <br>修改时间：<?=date("Y\年m\月d\日 H:i:s", $tvs->update_time)?>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-hover table-outline">
                            <thead class="thead-default">
                            <tr>
                                <th width="20%">时间</th>
                                <th>节目</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input
                                            placeholder="上午3:50 = 0350（格式是24小时制）"
                                            type="text"
                                            class="form-control"
                                            id="day_time_inp"
                                            onkeyup="dayTimeInp(this);" value=""></td>
                                <td>
                                    <select class="form-control" id="tvl_op" onchange="tvlSelect(this)">
                                        <?php
                                        $tvlist = \app\erp\models\Tvlistings::find()->select(['id','name'])->where("state=1")->all();
                                        foreach ($tvlist as $tl){
                                            echo "<option value='".$tl['id']."'>[".$tl['id']."]".$tl['name']."</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-bg btn-primary" onclick="TvAdd(this)"> 添 加 </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?=Url::to(
                    ['tv/edit',
                        'id'=>$tvs->id,
                        "reqURL"=>
                            $reqURL3 = ((boolean)$reqURL ? $reqURL : Url::to(['/manager/tvlistings']))
                    ]); ?>" class="btn btn-bg btn-primary"> 编 辑 电 视 </a>
                <a href="<?=Url::to(['/manager/tv']) ?>" class="btn btn-bg btn-danger"> 返 回 列 表 </a>
            </div>
        </div>
    </div>
    <!--/.col-->
    <div class="col-md-8">
        <table class="table table-hover table-outline">
            <thead class="thead-default">
            <tr>
                <th width="20%">ID</th>
                <th width="20%">时间</th>
                <th>节目</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="htl">
            </tbody>
        </table>
    </div>
</div>
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

<script src="/layui/layui.js"></script>
<link href="/layui/css/layui.css" rel="stylesheet">
<script>
    function tvlDel(obj){
        $(obj.parentNode.parentNode).remove();
    }
    function TvAdd(obj){
        var inp =$(obj.parentNode.parentNode).find("#day_time_inp").val();
        var tvlop =$(obj.parentNode.parentNode).find("#tvl_op").val();
        if(inp && inp!=0 && inp.length >4){
            $.ajax({
                url:"index.php?r=app/tv/add",
                type:"get",
                data:{
                    "tv_id":<?=$tvs->id ?>,
                    'tvl_id': tvlop,
                    'day_time':inp
                },
                success:function (result,status,xhr) {
                    Tvlist();
                }
            });
        }else{
            layui.use('layer', function(){
                var layer = layui.layer;
                layer.msg('时间不正确');
            });
        }
    }
    function dayTimeInp(obj){
        $(obj).on("keyup",function () {
            var a = $(this).val();
            if(a.length<=5){
                if(a.indexOf(":")>0){
                    if(a.slice(0,2)>23){
                        var vaone2 = a.slice(2,5);
                        $(this).val("00"+vaone2);
                    }
                    if(a.slice(3,5)>59){
                        var vaone = a.slice(0,3);
                        $(this).val(vaone+"00");
                        console.log($(this).val());
                        return;
                    }
                    var b = a.slice(0,2);
                    b +=a.slice(2,5);
                    $(this).val(b);
                }else{
                    if(a.length>=2){
                        if(a.slice(0,2)>23){
                            var vaone2 = a.slice(2,4);
                            $(this).val("00:"+vaone2)
                        }else if(a.slice(2,4)>59){
                            var vaone = a.slice(0,2);
                            $(this).val(vaone+":00")
                        }else{
                            var b = a.slice(0,2);
                            b +=":"+a.slice(2,4);
                            $(this).val(b);
                        }
                    }
                }
            }else{
                $(this).val(a.slice(0,5));
            }
        }).keydown(function () {
            var keynum = window.event ? event.keyCode : event.which;
            if(keynum == 8){
                console.log(keynum);
                $(this).val("");
            }
        }).blur(function () {
            if($(this).val().length<5){
                layui.use('layer', function(){
                    var layer = layui.layer;
                    layer.msg('时间不正确');
                });
                $(this).val("");
            }
        });
    }
</script>
<script>
    $(function () {
        $("#edit_tvl_op").val($("#edit_tvl_inp").val());
    });
    function editChange(obj) {
        $("#edit_tvl_inp").val($(obj).val());
    }
</script>
<div id="edit_tvl" style="display: none">
    <select class='form-control' id='edit_tvl_op' onchange="editChange(this)">
        <?php
        $tvlist = \app\erp\models\Tvlistings::find()
            ->select(['id','name'])->where('state=1')->all();
        foreach ($tvlist as $tl){
            echo '<option value="'
                .$tl['id'].
                '">['
                .$tl['id'].']'.$tl['name'].'</option>';
        }
        ?>
    </select>
</div>

<script>
    $(function () {
        Tvlist();
    });
    function Tvlist(){
        $.ajax({
            url:"<?=Url::to(['/app/tv/showlist'])?>",
            type:"get",
            data:{
                "id":<?=$tvs->id ?>
            },
            success:function (result,status,xhr) {
                var htl = '';
                for(var i=0;i <result.length;i++){
                    htl+=Temp(
                        result[i].id,
                        result[i].dayTime,
                        result[i].name,
                        result[i].tvdId
                    );
                }
                $("#htl").html(htl);
                htl = '';
                console.log(htl);
            }
        });
    }

    function editAjax(id,dayTime,tvlId){
        layui.use('layer', function(){
            var html = '<div>' +
                '   <input type="text" class="form-control" id="edit_time_inp" onkeyup="dayTimeInp(this);" value="'+dayTime+'" placeholder="上午3:50 = 0350（格式是24小时制）" />' +
                '   <input type="text" class="form-control" id="edit_tvl_inp" value="'+tvlId+'"/>' +$("#edit_tvl").html()+
                '</div>';
            var layer = layui.layer;
            //在这里面输入任何合法的js语句
            layer.open({
                type: 1 //Page层类型
                ,area: ['400px', '200px']
                ,title: '编辑'
                ,shade: 0.6 //遮罩透明度
                ,maxmin: true //允许全屏最小化
                ,anim: 1 //0-6的动画形式，-1不开启
                ,btn:['确定']
                ,content: html
                ,yes: function(index){
                    console.log("测试成功");
                    Tvedit(id,$("#edit_time_inp").val(),$("#edit_tvl_inp").val());
                    layer.close(index);
                }
            });
        });
    }
    function Tvdel(obj,id){
        $.ajax({
            url:"<?=Url::to(['/app/tv/taldel'])?>",
            type:"post",
            data:{
                "_csrf":"<?= Yii::$app->request->csrfToken ?>",
                "id":id
            },
            success:function (result,status,xhr) {
                tvlDel(obj);
                Tvlist();
                console.log(result);
            }
        });
    }
    function Tvedit(id,dayTime,tvlId){
        $.ajax({
            url:"<?=Url::to(['/app/tv/taledit'])?>",
            type:"post",
            data:{
                "_csrf":"<?= Yii::$app->request->csrfToken ?>",
                "id":id,
                "tvlId":tvlId,
                "dayTime":dayTime
            },
            success:function (result,status,xhr) {
                Tvlist();
                console.log(result);
            }
        });
    }
    function Temp(tvlid,dayTime,tvlname,tvdId) {
        var tr =' <tr>' +
            '<td>'+tvlid+'</td>' +
            '<td>'+dayTime+'</td>' +
            '<td>'+tvlname+'</td>' +
            '<td><a href="javascript:;" onclick="editAjax('+tvlid+',\''+dayTime+'\',\''+tvdId+'\')" >编辑</a>' +
            '<a href="javascript:;" onclick="Tvdel(this,'+tvlid+')" > 删除</a></td>' +
            '</tr>';
        return tr;
    }
</script>