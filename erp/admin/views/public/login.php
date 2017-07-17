<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<!DOCTYPE html>
<html lang="cn">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
    <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->
    <title>CoreUI Bootstrap 4 Admin Template</title>
    <!-- Icons -->
    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="/css/site.css" rel="stylesheet">
    <link href="coreui/css/font-awesome.min.css" rel="stylesheet">
    <link href="coreui/css/simple-line-icons.css" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="coreui/css/style.css" rel="stylesheet">

</head>
<body class="app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group mb-0">
                <div class="card p-2">
                    <div class="card-block">
                        <?php
                        $form = ActiveForm::begin();
                        ?>
                        <h1>注册</h1>
                        <p class="text-muted">登录您的帐户</p>
                        <?=$form->field(
                            $admin,
                            'account',
                            ['template' => '<div class="input-group mb-1"><span class="input-group-addon"><i class="icon-user"></i></span>{input}</div>{error}']
                        )->textInput(['placeholder'=>"账号"])?>
                        <?=$form->field($admin,'password',['template' => '<div class="input-group mb-2"><span class="input-group-addon"><i class="icon-lock"></i></span>{input}</div>{error}']
                        )->passwordInput(['placeholder'=>"密码"])?>
                        <div class="row">
                            <div class="col-6">
                                <?=Html::submitInput('登陆',['class'=>"btn btn-primary px-2"])?>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-link px-0">忘记密码?</button>
                            </div>
                        </div>
                        <?php
                            ActiveForm::end();
                        ?>
                    </div>
                </div>
                <div class="card card-inverse card-primary py-3 hidden-md-down" style="width:44%">
                    <div class="card-block text-center">
                        <div>
<!--                            <h2>Sign up</h2>-->
<!--                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>-->
<!--                            <button type="button" class="btn btn-primary active mt-1">Register Now!</button>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap and necessary plugins -->
<script src="coreui/assets/js/libs/jquery.min.js"></script>
<script src="coreui/assets/js/libs/tether.min.js"></script>
<script src="coreui/assets/js/libs/bootstrap.min.js"></script>
</body>
</html>