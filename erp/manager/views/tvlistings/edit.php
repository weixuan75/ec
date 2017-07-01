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
        <?=$form->field($tv,'weeks')->textInput(['value'=>"0，1，2，3，4，5，6"])?>
        <div class="form-group field-tvlistings-weeks required">
            <button type="button" class="btn btn-secondary">周日</button>
            <button type="button" class="btn btn-secondary">周一</button>
            <button type="button" class="btn btn-secondary">周二</button>
            <button type="button" class="btn btn-secondary">周三</button>
            <button type="button" class="btn btn-secondary">周四</button>
            <button type="button" class="btn btn-secondary">周五</button>
            <button type="button" class="btn btn-secondary">周六</button>
        </div>
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