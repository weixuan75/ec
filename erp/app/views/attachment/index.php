<?php
use yii\widgets\ActiveForm;
?>

<?php
$form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
]) ?>

<?= $form->field($model, 'imageFile')->fileInput() ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>
<?php
var_dump(Yii::$app->params['uploadFileCon']);
