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
        $tv_state = 1;
        if($tv->state!=1&&$tv->state=null){
            $tv_state=$tv->state;
        }
        ?>
        <?=$form->field($tv,'state')->radioList(Yii::$app->params['tvlistings']['state'][1],['value'=>$tv_state])?>
        <?=$form->field($tv,'content')->textInput()?>
    </div>
    <div class="card-footer">
        <?=Html::submitButton('<i class="fa fa-dot-circle-o"></i> 提 交 ',["class"=>"btn btn-bg btn-primary"])?>
        <a class="btn btn-bg btn-danger" href="<?=$reqURL?>"><i class="fa fa-ban"></i> 取 消</a>
    </div>
    <?php
    ActiveForm::end();
    ?>
</div>