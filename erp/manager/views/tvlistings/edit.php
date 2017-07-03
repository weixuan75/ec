<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="card">
    <div class="card-header">
        <strong>添加节目</strong>
    </div>
    <?php
    $form = ActiveForm::begin();
    ?>
    <div class="card-block">
        <?=$form->field($tv,'name')->textInput()?>
        <?php
        $tv_weeks = "0,4,5,6";
        if(!is_null($tv->state)){
            $tv_weeks=$tv->state;
        }
        ?>
        <?=$form->field($tv,'weeks')->textInput(['value'=>$tv_weeks])?>
        <div class="form-group field-tvlistings-weeks required" id="weeks_bt">
<!--            <button type="button" class="btn btn-secondary">周日</button>-->
<!--            <button type="button" class="btn btn-secondary">周一</button>-->
<!--            <button type="button" class="btn btn-secondary">周二</button>-->
<!--            <button type="button" class="btn btn-secondary">周三</button>-->
<!--            <button type="button" class="btn btn-secondary">周四</button>-->
<!--            <button type="button" class="btn btn-primary">周五</button>-->
<!--            <button type="button" class="btn btn-primary">周六</button>-->
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
            function editWeeks(obj){
                $(obj).toggleClass("btn-primary");
                if($(obj).attr("class").indexOf("btn-primary")>0){

                }else{
                    
                }
            }
//            删除
        </script>
        <?=$form->field($tv,'day')->textInput()?>
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
        <?=Html::submitButton('<i class="fa fa-dot-circle-o"></i> 提 交 ',["class"=>"btn btn-bg btn-primary"])?>
        <?=Html::resetButton('<i class="fa fa-ban"></i> 取 消 ',["class"=>"btn btn-bg btn-danger"])?>
    </div>
    <?php
    ActiveForm::end();
    ?>
</div>