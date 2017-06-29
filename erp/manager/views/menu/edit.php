<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="card">
    <div class="card-header">
        <strong>添加菜单</strong>
    </div>
    <?php
    $form = ActiveForm::begin([
//            'options' => ['class' => 'form-horizontal'],
    ]);
    ?>
    <div class="card-block">
        <?=$form->field($menu,'name')->textInput()?>
        <?=$form->field($menu,'ename')->textInput()?>
        <?=$form->field($menu,'menu_pid')->dropDownList(['0'=>'radio1','1'=>'radio2'])?>
        <?=$form->field($menu,'content')->textInput()?>
        <?=$form->field($menu,'sys_admin_id')->textInput()?>
        <?=$form->field($menu,'state')->textInput()?>
    </div>
    <div class="card-footer">
        <?=Html::submitButton('<i class="fa fa-dot-circle-o"></i> 提 交 ',["class"=>"btn btn-bg btn-primary"])?>
        <?=Html::resetButton('<i class="fa fa-ban"></i> 取 消 ',["class"=>"btn btn-bg btn-danger"])?>
    </div>
    <?php
    ActiveForm::end();
    ?>
</div>