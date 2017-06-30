<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="card">
    <div class="card-header">
        <strong>添加会员</strong>
    </div>
    <?php
    $form = ActiveForm::begin();
    ?>
    <div class="card-block">
        <?=$form->field($admin,'account')->textInput()?>
        <?=$form->field($admin,'email')->textInput()?>
        <?=$form->field($admin,'phone')->textInput()?>
        <?=$form->field($admin,'password')->passwordInput()?>
        <?=$form->field($admin,'repass')->passwordInput()?>
        <?php
        $sysadmin_state = 0;
        if($admin->state!=0||$admin->state!=null){
            $sysadmin_state=$admin->state;
        }
        ?>
        <?=$form->field($admin,'state')->radioList(Yii::$app->params['sysadmin']['state'][1],['value'=>$sysadmin_state])?>
        <?=$form->field($admin,'sys_group_id')->textInput()?>
    </div>
    <div class="card-footer">
        <?=Html::submitButton('<i class="fa fa-dot-circle-o"></i> 提 交 ',["class"=>"btn btn-bg btn-primary"])?>
        <?=Html::resetButton('<i class="fa fa-ban"></i> 取 消 ',["class"=>"btn btn-bg btn-danger"])?>
    </div>
    <?php
    ActiveForm::end();
    ?>

</div>