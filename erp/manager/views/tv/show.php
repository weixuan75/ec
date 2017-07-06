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
                                <td><input placeholder="上午3:50 = 0350（格式是24小时制）" type="text" class="form-control" id="day_time_inp" onblur="changS()" value=""></td>
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
                        <script src="/layui/layui.js"></script>
                        <link href="/layui/css/layui.css" rel="stylesheet">
                        <script>
                            function changS() {
                                var va = $("#day_time_inp").val();
                                if(va.length>4){
                                    layui.use('layer', function(){
                                        var layer = layui.layer;
                                        layer.msg('格式错误,正确:3:50 = 0350，最大23:59');
                                    });
                                }else if (va>=2400){
                                    layui.use('layer', function(){
                                        var layer = layui.layer;
                                        layer.msg('格式错误,正确:3:50 = 0350，最大23:59');
                                    });
                                }else if (va.slice(2,4)>59){
                                    var vaone = va.slice(0,2);
                                    layui.use('layer', function(){
                                        var layer = layui.layer;
                                        layer.msg('分钟超出');
                                    });
                                    $("#day_time_inp").val(vaone+":00")
                                }else {
                                    $("#day_time_inp").val(va.slice(0,2)+":"+va.slice(2,4));
                                }
                            }
                            function tvlDel(obj){
                                $(obj.parentNode.parentNode).remove();
                            }
                            function TvAdd(obj){
                                var inp =$(obj.parentNode.parentNode).find("#day_time_inp").val();
                                var tvlop =$(obj.parentNode.parentNode).find("#tvl_op").val();
                                if(inp && inp!=0){
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
                                        layer.msg('时间不能为空');
                                    });
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?=Url::to(
                    ['tv/edit',
                        'id'=>$tvs->id,
                        "reqURL"=>
                            $reqURL3 = ((boolean)$reqURL ? $reqURL : Url::to(['/manager/tvlistings']))
                    ]); ?>" class="btn btn-bg btn-primary"><i class="fa fa-dot-circle-o"></i> 编 辑 电 视 </a>
                <a href="<?=Url::to(['/manager/tv']) ?>" class="btn btn-bg btn-danger"><i class="fa fa-dot-circle-o"></i> 返 回 列 表 </a>
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
                        result[i].name);
                }
                $("#htl").html(htl);
                htl = '';
                console.log(htl);
            }
        });
    }
    function Tvdel(obj,id){
        $.ajax({
            url:"<?=Url::to(['/app/tv/taldel'])?>",
            type:"get",
            data:{
                "id":id
            },
            success:function (result,status,xhr) {
                tvlDel(obj);
                Tvlist();
                console.log(result);
            }
        });
    }
    function Temp(tvlid,dayTime,tvlname) {
        var tr =' <tr>' +
            '<td>'+tvlid+'</td>' +
            '<td>'+dayTime+'</td>' +
            '<td>'+tvlname+'</td>' +
            '<td>编辑 <a href="javascript:;" onclick="Tvdel(this,'+tvlid+')" > 删除</a></td>' +
            '</tr>';
        return tr;
    }
    function editTal(id,daytime,tlId) {
        
    }
</script>
<div>
    <td>
        <input
                placeholder='上午3:50 = 0350（格式是24小时制）'
                type='text'
                class='form-control'
                id='day_time_inp'
                onblur='changS()'
                value=''
        />
    </td>
    <td>
        <select
                class='form-control'
                id='tvl_op'
                onchange='tvlSelect(this)'
        >
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
    </td>
    <td>
        <button type='button' class='btn btn-bg btn-primary' onclick='TvAdd(this)'> 添 加 </button>
    </td>
</div>