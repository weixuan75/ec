<?php
use yii\widgets\ActiveForm;
?>

    <form id="w0" action="/index.php?r=app/attachment/up" method="post" enctype="multipart/form-data" name="uploadimage">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken();?>">
        <div class="form-group field-uploadform-imagefile">
            <label class="control-label" for="uploadform-imagefile">Image File</label>
             <input type="file" id="uploadform-imagefile" name="UploadForm">
            <div class="help-block"></div>
        </div>
        <button>Submit</button>
    </form>
<?php
//var_dump(Yii::$app->params['uploadFileCon']);
