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
        <li class="nav-item px-1">
            <a class="nav-link" href="#">控制台</a>
        </li>
        <li class="nav-item px-1">
            <a class="nav-link" href="#">用户</a>
        </li>
        <li class="nav-item px-1">
            <a class="nav-link" href="#">设置</a>
        </li>
    </ul>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item hidden-md-down">
            <a class="nav-link" href="#"><i class="icon-bell"></i><span class="badge badge-pill badge-danger">5</span></a>
        </li>
        <li class="nav-item hidden-md-down">
            <a class="nav-link" href="#"><i class="icon-list"></i></a>
        </li>
        <li class="nav-item hidden-md-down">
            <a class="nav-link" href="#"><i class="icon-location-pin"></i></a>
        </li>
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

                <div class="dropdown-header text-center">
                    <strong>Account</strong>
                </div>

                <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> Updates<span class="badge badge-info">42</span></a>
                <a class="dropdown-item" href="#"><i class="fa fa-envelope-o"></i> Messages<span class="badge badge-success">42</span></a>
                <a class="dropdown-item" href="#"><i class="fa fa-tasks"></i> Tasks<span class="badge badge-danger">42</span></a>
                <a class="dropdown-item" href="#"><i class="fa fa-comments"></i> Comments<span class="badge badge-warning">42</span></a>

                <div class="dropdown-header text-center">
                    <strong>设置</strong>
                </div>

                <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
                <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> 设置</a>
                <a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="badge badge-default">42</span></a>
                <a class="dropdown-item" href="#"><i class="fa fa-file"></i> Projects<span class="badge badge-primary">42</span></a>
                <div class="divider"></div>
                <a class="dropdown-item" href="#"><i class="fa fa-shield"></i> Lock Account</a>
                <a class="dropdown-item" href="<?= Url::to(['/admin/public/logout']); ?>"><i class="fa fa-lock"></i>退出</a>
            </div>
        </li>
        <li class="nav-item hidden-md-down">
            <a class="nav-link navbar-toggler aside-menu-toggler" href="#">☰</a>
        </li>

    </ul>
</header>

<div class="app-body">
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.html"><i class="icon-speedometer"></i> 控制台 <span class="badge badge-info">NEW</span></a>
                </li>
                <li class="nav-title">
                    UI Elements
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i> Components</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="/coreui/components-buttons.html"><i class="icon-puzzle"></i> Buttons</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/coreui/components-social-buttons.html"><i class="icon-puzzle"></i> Social Buttons</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/coreui/components-cards.html"><i class="icon-puzzle"></i> Cards</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/coreui/components-forms.html"><i class="icon-puzzle"></i> Forms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/coreui/components-modals.html"><i class="icon-puzzle"></i> Modals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/coreui/components-switches.html"><i class="icon-puzzle"></i> Switches</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/coreui/components-tables.html"><i class="icon-puzzle"></i> Tables</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/coreui/components-tabs.html"><i class="icon-puzzle"></i> Tabs</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-star"></i> Icons</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="/coreui/icons-font-awesome.html"><i class="icon-star"></i> Font Awesome</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/coreui/icons-simple-line-icons.html"><i class="icon-star"></i> Simple Line Icons</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/coreui/widgets.html"><i class="icon-calculator"></i> 组件 <span class="badge badge-info">NEW</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/coreui/charts.html"><i class="icon-pie-chart"></i> 图表</a>
                </li>
                <li class="divider"></li>
                <li class="nav-title">
                    附加页面
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-menu"></i>菜单管理</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['/manager/menu']); ?>" target="_top"><i class="icon-options"></i>系统后台</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/coreui/pages-register.html" target="_top"><i class="icon-options"></i>会员菜单</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i>管理员</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['/admin/user']); ?>" target="_top"><i class="icon-options"></i>管理员列表</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['/admin/']); ?>" target="_top"><i class="icon-options"></i>管理员组</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['/admin/role']); ?>" target="_top"><i class="icon-options"></i>管理员角色</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['/admin/fun']); ?>" target="_top"><i class="icon-options"></i>管理员功能</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i>电视节目管理</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['/manager/tv']); ?>" target="_top"><i class="icon-options"></i>电视列表</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['/manager/tvlistings']); ?>" target="_top"><i class="icon-options"></i>节目列表</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['/admin/']); ?>" target="_top"><i class="icon-options"></i>节目日志表</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-star"></i>网页</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['/admin/public/login']); ?>" target="_top"><i class="icon-star"></i>登陆</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/coreui/pages-register.html" target="_top"><i class="icon-star"></i>注册</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/coreui/pages-404.html" target="_top"><i class="icon-star"></i> Error 404</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/coreui/pages-500.html" target="_top"><i class="icon-star"></i> Error 500</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>

    <!-- Main content -->
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a>
            </li>
            <li class="breadcrumb-item active">控制台</li>

            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu hidden-md-down">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
                    <a class="btn btn-secondary" href="./"><i class="icon-graph"></i> &nbsp;控制台</a>
                    <a class="btn btn-secondary" href="#"><i class="icon-settings"></i> &nbsp;设置</a>
                </div>
            </li>
        </ol>
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
