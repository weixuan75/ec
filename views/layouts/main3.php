<?php
use yii\helpers\Url;
use yii\helpers\Json;

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>后台管理平台</title>

    <script src="/js/jquery-3.2.1.min.js"></script>
<!--    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">-->
    <!-- Icons -->
    <link href="coreui/css/font-awesome.min.css" rel="stylesheet">
    <link href="coreui/css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="coreui/css/style.css" rel="stylesheet">
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
<header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler hidden-lg-up" type="button">☰</button>
    <a class="navbar-brand" href="<?php echo yii\helpers\Url::to(['/manager']); ?>"></a>
    <ul class="nav navbar-nav hidden-md-down">
        <li class="nav-item">
            <a class="nav-link navbar-toggler sidebar-toggler" href="#">☰</a>
        </li>
    </ul>
    <ul class="nav navbar-nav ml-auto">
        <?php
        $auth_code = Yii::$app->session['userData']['user']['auth_code'];
        $redis = Yii::$app->redis;
        $user = Json::decode($redis->get($auth_code),true);
        ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img src="coreui/img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                <span class="hidden-md-down"><?=$user['data']['nickname']?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="<?= Url::to(['/admin/public/logout']); ?>"><i class="fa fa-lock"></i>退出</a>
            </div>
        </li>

    </ul>
</header>

<div class="app-body">
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i>电视节目管理</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['/manager/tvlistings/index']); ?>" target="_top"> 电视列表</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['/manager/tvlistings/indexl']); ?>" target="_top"> 节目列表</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>

    <!-- Main content -->
    <main class="main">
        <div class="container-fluid">
            <div class="animated fadeIn">
                <?= $content ?>
            </div>
        </div>
        <!-- /.conainer-fluid -->
    </main>

    <aside class="aside-menu">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab"><i class="icon-list"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><i class="icon-speech"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#settings" role="tab"><i class="icon-settings"></i></a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="timeline" role="tabpanel">
                <div class="callout m-0 py-h text-muted text-center bg-faded text-uppercase">
                    <small><b>Today</b>
                    </small>
                </div>
                <hr class="transparent mx-1 my-0">
                <div class="callout callout-warning m-0 py-1">
                    <div class="avatar float-right">
                        <img src="coreui/img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    </div>
                    <div>Meeting with
                        <strong>Lucas</strong>
                    </div>
                    <small class="text-muted mr-1"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
                    <small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA</small>
                </div>
                <hr class="mx-1 my-0">
                <div class="callout callout-info m-0 py-1">
                    <div class="avatar float-right">
                        <img src="coreui/img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    </div>
                    <div>Skype with
                        <strong>Megan</strong>
                    </div>
                    <small class="text-muted mr-1"><i class="icon-calendar"></i>&nbsp; 4 - 5pm</small>
                    <small class="text-muted"><i class="icon-social-skype"></i>&nbsp; On-line</small>
                </div>
                <hr class="transparent mx-1 my-0">
                <div class="callout m-0 py-h text-muted text-center bg-faded text-uppercase">
                    <small><b>Tomorrow</b>
                    </small>
                </div>
                <hr class="transparent mx-1 my-0">
                <div class="callout callout-danger m-0 py-1">
                    <div>New UI Project -
                        <strong>deadline</strong>
                    </div>
                    <small class="text-muted mr-1"><i class="icon-calendar"></i>&nbsp; 10 - 11pm</small>
                    <small class="text-muted"><i class="icon-home"></i>&nbsp; creativeLabs HQ</small>
                    <div class="avatars-stack mt-h">
                        <div class="avatar avatar-xs">
                            <img src="coreui/img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="coreui/img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="coreui/img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="coreui/img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="coreui/img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                    </div>
                </div>
                <hr class="mx-1 my-0">
                <div class="callout callout-success m-0 py-1">
                    <div>
                        <strong>#10 Startups.Garden</strong>Meetup</div>
                    <small class="text-muted mr-1"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
                    <small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA</small>
                </div>
                <hr class="mx-1 my-0">
                <div class="callout callout-primary m-0 py-1">
                    <div>
                        <strong>Team meeting</strong>
                    </div>
                    <small class="text-muted mr-1"><i class="icon-calendar"></i>&nbsp; 4 - 6pm</small>
                    <small class="text-muted"><i class="icon-home"></i>&nbsp; creativeLabs HQ</small>
                    <div class="avatars-stack mt-h">
                        <div class="avatar avatar-xs">
                            <img src="coreui/img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="coreui/img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="coreui/img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="coreui/img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="coreui/img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="coreui/img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="coreui/img/avatars/8.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                    </div>
                </div>
                <hr class="mx-1 my-0">
            </div>
            <div class="tab-pane p-1" id="messages" role="tabpanel">
                <div class="message">
                    <div class="py-1 pb-3 mr-1 float-left">
                        <div class="avatar">
                            <img src="coreui/img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            <span class="avatar-status badge-success"></span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted">Lukasz Holeczek</small>
                        <small class="text-muted float-right mt-q">1:52 PM</small>
                    </div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                    <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-1 pb-3 mr-1 float-left">
                        <div class="avatar">
                            <img src="coreui/img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            <span class="avatar-status badge-success"></span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted">Lukasz Holeczek</small>
                        <small class="text-muted float-right mt-q">1:52 PM</small>
                    </div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                    <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-1 pb-3 mr-1 float-left">
                        <div class="avatar">
                            <img src="coreui/img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            <span class="avatar-status badge-success"></span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted">Lukasz Holeczek</small>
                        <small class="text-muted float-right mt-q">1:52 PM</small>
                    </div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                    <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-1 pb-3 mr-1 float-left">
                        <div class="avatar">
                            <img src="coreui/img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            <span class="avatar-status badge-success"></span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted">Lukasz Holeczek</small>
                        <small class="text-muted float-right mt-q">1:52 PM</small>
                    </div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                    <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-1 pb-3 mr-1 float-left">
                        <div class="avatar">
                            <img src="coreui/img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            <span class="avatar-status badge-success"></span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted">Lukasz Holeczek</small>
                        <small class="text-muted float-right mt-q">1:52 PM</small>
                    </div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                    <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                </div>
            </div>
            <div class="tab-pane p-1" id="settings" role="tabpanel">
                <h6>Settings</h6>

                <div class="aside-options">
                    <div class="clearfix mt-2">
                        <small><b>Option 1</b>
                        </small>
                        <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                            <input type="checkbox" class="switch-input" checked="">
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                    <div>
                        <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
                    </div>
                </div>

                <div class="aside-options">
                    <div class="clearfix mt-1">
                        <small><b>Option 2</b>
                        </small>
                        <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                            <input type="checkbox" class="switch-input">
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                    <div>
                        <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
                    </div>
                </div>

                <div class="aside-options">
                    <div class="clearfix mt-1">
                        <small><b>Option 3</b>
                        </small>
                        <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                            <input type="checkbox" class="switch-input">
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                </div>

                <div class="aside-options">
                    <div class="clearfix mt-1">
                        <small><b>Option 4</b>
                        </small>
                        <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                            <input type="checkbox" class="switch-input" checked="">
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                </div>

                <hr>
                <h6>System Utilization</h6>

                <div class="text-uppercase mb-q mt-2">
                    <small><b>CPU Usage</b>
                    </small>
                </div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="text-muted">348 Processes. 1/4 Cores.</small>

                <div class="text-uppercase mb-q mt-h">
                    <small><b>Memory Usage</b>
                    </small>
                </div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="text-muted">11444GB/16384MB</small>

                <div class="text-uppercase mb-q mt-h">
                    <small><b>SSD 1 Usage</b>
                    </small>
                </div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="text-muted">243GB/256GB</small>

                <div class="text-uppercase mb-q mt-h">
                    <small><b>SSD 2 Usage</b>
                    </small>
                </div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="text-muted">25GB/256GB</small>
            </div>
        </div>
    </aside>


</div>

<footer class="app-footer">
    Copyright &copy; 2017.Company EnchangCN 恩优畅品 All rights reserved
</footer>

<!-- Bootstrap and necessary plugins -->
<script src="coreui/assets/js/libs/tether.min.js"></script>
<script src="coreui/assets/js/libs/bootstrap.min.js"></script>
<script src="coreui/assets/js/libs/pace.min.js"></script>
<!-- Plugins and scripts required by all views -->
<!--<script src="coreui/assets/js/libs/Chart.min.js"></script>-->

<!-- GenesisUI main scripts -->
<script src="coreui/js/app.js"></script>
<!--<script src="../../web/js/jquery-3.2.1.min.js"></script>-->
<!-- Plugins and scripts required by this views -->
<!-- Custom scripts required by this view -->
<!--<script src="coreui/js/views/main.js"></script>-->

</body>
</html>
