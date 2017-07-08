<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="card">
    <div class="card-header">
        <strong>添加电视</strong>
    </div>
    <?php
    $form = ActiveForm::begin();
    ?>
    <div class="card-block">
        <?=$form->field($tv,'name')->textInput()?>
        <div class="form-group" id="x_time">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link font-2xl active" id="x_time_month" data-toggle="tab" href="#x_time_month_2" role="tab" aria-controls="home" aria-expanded="true"> 日 期 选 择 </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-2xl" id="x_time_weeks" data-toggle="tab" href="#x_time_weeks_2" role="tab" aria-controls="profile" aria-expanded="false"> 周 选 择 </a>
                </li>
            </ul>
            <script>
                $(function () {
                   $("#x_time_month").on("click",function () {
                       $("#x_time_weeks_2").html(" ");
                       $("#x_time_month_2").html($("#open_month").html());
                   });
                    $("#x_time_weeks").on("click",function () {
                        $("#x_time_month_2").html(" ");
                        $("#x_time_weeks_2").html($("#open_weeks").html());
                    });
                });
            </script>
            <div class="tab-content">
                <div class="tab-pane active" id="x_time_month_2" role="tabpanel" aria-expanded="true">
                        <script src="/layui/layui.js"></script>
                        <link href="/layui/css/layui.css" rel="stylesheet">
                        <div class="form-group field-tvlistings-day">
                            <?=$form->field($tv,'month')->hiddenInput()->label(false)?>
                            <p class="help-block help-block-error"></p>
                            <div class="layui-form-pane" style="margin-top: 15px;">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">范围选择</label>
                                    <div class="layui-input-inline">
                                        <input class="layui-input" placeholder="开始日" id="LAY_demorange_s">
                                    </div>
                                    <div class="layui-input-inline">
                                        <input class="layui-input" placeholder="截止日" id="LAY_demorange_e">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            layui.use('laydate', function(){
                                var laydate = layui.laydate;
                                var start = {
                                    format: 'YYYY-MM-DD',
                                    min: laydate.now(),
                                    max: '2099-06-16',
                                    istoday: false,
                                    istime:false,
                                    isclear:false,
                                    choose: function(datas){
                                        end.min = datas; //开始日选好后，重置结束日的最小日期
                                        end.start = datas;//将结束日的初始值设定为开始日
                                    }
                                };
                                var end = {
                                    format: 'YYYY-MM-DD',
                                    min: laydate.now(),
                                    max: '2099-06-16',
                                    istoday: false,
                                    istime:false,
                                    isclear:false,
                                    choose: function(datas){
                                        start.max = datas; //结束日选好后，重置开始日的最大日期
                                        $("#tv-month").val($("#LAY_demorange_s").val()+","+$("#LAY_demorange_s").val());
                                    }
                                };
                                document.getElementById('LAY_demorange_s').onclick = function(){
                                    start.elem = this;
                                    laydate(start);
                                }
                                document.getElementById('LAY_demorange_e').onclick = function(){
                                    end.elem = this
                                    laydate(end);
                                }
                                $("#LAY_demorange_s").on("change",function () {
                                    $("#tvlistings-start_time").val(' ');
                                });
                                $("#LAY_demorange_e").on("change",function () {
                                    $("#tvlistings-end_time").val(' ');
                                });
                            });
                        </script>
                </div>
                <div class="tab-pane" id="x_time_weeks_2" role="tabpanel" aria-expanded="false">

                </div>
            </div>
        </div>
        <?php
//        form->field($tv,'shop_id')->dropDownList(
//            \app\erp\models\Menu::find()->select(['name', 'id'])->orderBy('id')->column(),
//            ['prompt'=>'顶级目录']
//        )
        ?>

        <?php
        $tv_state = 1;
        if($tv->state!=1&&$tv->state=null){
            $tv_state=$tv->state;
        }
        ?>
        <?=$form->field($tv,'state')->radioList(Yii::$app->params['tvlistings']['state'][1],['value'=>$tv_state])?>
        <?php
        $tv_is_conf = 0;
        if($tv->is_conf!=0){
            $tv_is_conf=$tv->is_conf;
        }
        ?>
        <?=$form->field($tv,'is_conf')->radioList(Yii::$app->params['tvlistings']['is_conf'][1],['value'=>$tv_is_conf])?>
        <?=$form->field($tv,'content')->textInput()?>
    </div>
    <div class="card-footer">
        <?=Html::submitButton(' 提 交 ',["class"=>"btn btn-bg btn-primary"])?>
        <?=Html::resetButton(' 取 消 ',["class"=>"btn btn-bg btn-danger"])?>
    </div>
    <?php
    ActiveForm::end();
    ?>
</div>

<script src="/layui/layui.js"></script>
<link href="/layui/css/layui.css" rel="stylesheet">
<div style="display: none" id="open_month">
    <div class="form-group field-tvlistings-day">
        <?=$form->field($tv,'month')->hiddenInput()->label(false)?>
        <p class="help-block help-block-error"></p>
        <div class="layui-form-pane" style="margin-top: 15px;">
            <div class="layui-form-item">
                <label class="layui-form-label">范围选择</label>
                <div class="layui-input-inline">
                    <input class="layui-input" placeholder="开始日" id="LAY_demorange_s">
                </div>
                <div class="layui-input-inline">
                    <input class="layui-input" placeholder="截止日" id="LAY_demorange_e">
                </div>
            </div>
        </div>
    </div>
    <script>
        layui.use('laydate', function(){
            var laydate = layui.laydate;
            var start = {
                format: 'YYYY-MM-DD',
                min: laydate.now(),
                max: '2099-06-16',
                istoday: false,
                istime:false,
                isclear:false,
                choose: function(datas){
                    end.min = datas; //开始日选好后，重置结束日的最小日期
                    end.start = datas;//将结束日的初始值设定为开始日
                }
            };
            var end = {
                format: 'YYYY-MM-DD',
                min: laydate.now(),
                max: '2099-06-16',
                istoday: false,
                istime:false,
                isclear:false,
                choose: function(datas){
                    start.max = datas; //结束日选好后，重置开始日的最大日期
                    $("#tv-month").val($("#LAY_demorange_s").val()+","+$("#LAY_demorange_s").val());
                }
            };
            document.getElementById('LAY_demorange_s').onclick = function(){
                start.elem = this;
                laydate(start);
            }
            document.getElementById('LAY_demorange_e').onclick = function(){
                end.elem = this
                laydate(end);
            }
            $("#LAY_demorange_s").on("change",function () {
                $("#tvlistings-start_time").val(' ');
            });
            $("#LAY_demorange_e").on("change",function () {
                $("#tvlistings-end_time").val(' ');
            });
        });
    </script>
</div>
<div style="display: none" id="open_weeks">
    <?php
    $tv_weeks = "0,1,2,3,4,5,6";
    if(!is_null($tv->state)){
        $tv_weeks=$tv->weeks;
    }
    ?>
    <?=$form->field($tv,'weeks')->hiddenInput(['value'=>$tv_weeks])->label(false)?>
    <div class="form-group field-tvlistings-weeks required" id="weeks_bt">
        <button type="button" class="btn" onclick="editWeeks(this)">周日</button>
        <button type="button" class="btn" onclick="editWeeks(this)">周一</button>
        <button type="button" class="btn" onclick="editWeeks(this)">周二</button>
        <button type="button" class="btn" onclick="editWeeks(this)">周三</button>
        <button type="button" class="btn" onclick="editWeeks(this)">周四</button>
        <button type="button" class="btn" onclick="editWeeks(this)">周五</button>
        <button type="button" class="btn" onclick="editWeeks(this)">周六</button>
    </div>
    <script>
        $(function () {
            weeks_tmp(MaterialData,tvlistings_weeks);
        });

        //表单数据
        var tvlistings_weeks = $("#tvlistings-weeks").val();
        var tvlistings_weeks =tvlistings_weeks.substr(0,tvlistings_weeks.length).split(",");

        console.log("表单数据"+tvlistings_weeks);
        //完整数据
        var MaterialData = "0,1,2,3,4,5,6";
        var MaterialData = MaterialData.substr(0, MaterialData.length).split(",");
        console.log("完整数据"+MaterialData);
        console.log(MaterialData.join(","));
        //未选择的数据
        var falseWeeks = arrReat(tvlistings_weeks,MaterialData);
        console.log("未选择的数据"+falseWeeks);
        /**
         * 删除重复的数组
         * @param {Object} arr	子级数组
         * @param {Object} arrAll 父级数组
         */
        function arrReat(arr,arrAll){
            var temp = []; //临时数组1
            var temparray = []; //临时数组2
            for(var i = 0; i < arr.length; i++) {
                temp[arr[i]] = true; //巧妙地方：把数组B的值当成临时数组1的键并赋值为真
            };
            for(var i = 0; i < arrAll.length; i++) {
                if(!temp[arrAll[i]]) {
                    temparray.push(arrAll[i]);
                    //巧妙地方：同时把数组A的值当成临时数组1的键并判断是否为真，
                    //如果不为真说明没重复，就合并到一个新数组里，
                    //这样就可以得到一个全新并无重复的数组
                };
            };
            return temparray;
        }
        //模版
        function weeks_tmp(Data,weeks) {
            for(var i =0;i < Data.length;i++){
                for(var j =0;j<weeks.length;j++){
                    if(Data[i]==weeks[j]){
                        var weeks_bt = document.getElementById("weeks_bt");
                        var button_weeks = weeks_bt.getElementsByTagName("button");
                        $(button_weeks[i]).addClass("btn-primary");
                    }
                }
            }
//                $("#weeks_bt").append();
        }

        //            添加
        var num = 0;
        function editWeeks(obj){
            $(obj).toggleClass("btn-primary");
            if($(obj).attr("class").indexOf("btn-primary")>0){
//                    表单数组累加值
                tvlistings_weeks.push($(obj).index());
                tvlistings_weeks = tvlistings_weeks.sort();
                console.log(tvlistings_weeks);
                $("#tvlistings-weeks").val(tvlistings_weeks.join(","));
            }else{
                tvlistings_weeks.pop($(obj).index());
                tvlistings_weeks = tvlistings_weeks.sort();
                console.log(tvlistings_weeks);
                $("#tvlistings-weeks").val(tvlistings_weeks.join(","));
            }
        }
        //            删除
    </script>
</div>