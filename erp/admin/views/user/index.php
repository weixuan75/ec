<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card-footer">
            <a href="<?=Url::to(['/admin/user/add']) ?>" class="btn btn-bg btn-primary"><i class="fa fa-dot-circle-o"></i> 添 加 管 理 员 </a>
        </div>
        <div class="card">
            <div class="card-header">
                会员列表
            </div>
            <div class="card-block">
                <?php
                /*
                ?>
                <div class="row">
                    <div class="col-sm-12 col-lg-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="callout callout-info">
                                    <small class="text-muted">New Clients</small>
                                    <br>
                                    <strong class="h4">9,123</strong>
                                    <div class="chart-wrapper"><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                                        <canvas id="sparkline-chart-1" width="100" height="30" style="display: block; width: 100px; height: 30px;"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                            <div class="col-sm-6">
                                <div class="callout callout-danger">
                                    <small class="text-muted">Recuring Clients</small>
                                    <br>
                                    <strong class="h4">22,643</strong>
                                    <div class="chart-wrapper"><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                                        <canvas id="sparkline-chart-2" width="100" height="30" style="display: block; width: 100px; height: 30px;"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                        <hr class="mt-0">
                        <ul class="horizontal-bars">
                            <li>
                                <div class="title">
                                    Monday
                                </div>
                                <div class="bars">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 34%" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    Tuesday
                                </div>
                                <div class="bars">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 56%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 94%" aria-valuenow="94" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    Wednesday
                                </div>
                                <div class="bars">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 67%" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    Thursday
                                </div>
                                <div class="bars">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 91%" aria-valuenow="91" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    Friday
                                </div>
                                <div class="bars">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 73%" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    Saturday
                                </div>
                                <div class="bars">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 53%" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    Sunday
                                </div>
                                <div class="bars">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 9%" aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 69%" aria-valuenow="69" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>
                            <li class="legend">
                                <span class="badge badge-pill badge-info"></span>
                                <small>New clients</small>&nbsp;
                                <span class="badge badge-pill badge-danger"></span>
                                <small>Recurring clients</small>
                            </li>
                        </ul>
                    </div>
                    <!--/.col-->
                    <div class="col-sm-6 col-lg-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="callout callout-warning">
                                    <small class="text-muted">Pageviews</small>
                                    <br>
                                    <strong class="h4">78,623</strong>
                                    <div class="chart-wrapper"><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                                        <canvas id="sparkline-chart-3" width="100" height="30" style="display: block; width: 100px; height: 30px;"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                            <div class="col-sm-6">
                                <div class="callout callout-success">
                                    <small class="text-muted">Organic</small>
                                    <br>
                                    <strong class="h4">49,123</strong>
                                    <div class="chart-wrapper"><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                                        <canvas id="sparkline-chart-4" width="100" height="30" style="display: block; width: 100px; height: 30px;"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                        <hr class="mt-0">
                        <ul class="horizontal-bars type-2">
                            <li>
                                <i class="icon-user"></i>
                                <span class="title">Male</span>
                                <span class="value">43%</span>
                                <div class="bars">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <i class="icon-user-female"></i>
                                <span class="title">Female</span>
                                <span class="value">37%</span>
                                <div class="bars">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 37%" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <i class="icon-globe"></i>
                                <span class="title">Organic Search</span>
                                <span class="value">191,235
                                                        <span class="text-muted small">(56%)</span>
                                                    </span>
                                <div class="bars">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 56%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <i class="icon-social-facebook"></i>
                                <span class="title">Facebook</span>
                                <span class="value">51,223
                                                        <span class="text-muted small">(15%)</span>
                                                    </span>
                                <div class="bars">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <i class="icon-social-twitter"></i>
                                <span class="title">Twitter</span>
                                <span class="value">37,564
                                                        <span class="text-muted small">(11%)</span>
                                                    </span>
                                <div class="bars">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 11%" aria-valuenow="11" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <i class="icon-social-linkedin"></i>
                                <span class="title">LinkedIn</span>
                                <span class="value">27,319
                                                        <span class="text-muted small">(8%)</span>
                                                    </span>
                                <div class="bars">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 8%" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider text-center">
                                <button type="button" class="btn btn-sm btn-link text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="show more"><i class="icon-options"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <!--/.col-->
                    <div class="col-sm-6 col-lg-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="callout">
                                    <small class="text-muted">CTR</small>
                                    <br>
                                    <strong class="h4">23%</strong>
                                    <div class="chart-wrapper"><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                                        <canvas id="sparkline-chart-5" width="100" height="30" style="display: block; width: 100px; height: 30px;"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                            <div class="col-sm-6">
                                <div class="callout callout-primary">
                                    <small class="text-muted">Bounce Rate</small>
                                    <br>
                                    <strong class="h4">5%</strong>
                                    <div class="chart-wrapper"><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                                        <canvas id="sparkline-chart-6" width="100" height="30" style="display: block; width: 100px; height: 30px;"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                        <hr class="mt-0">
                        <ul class="icons-list">
                            <li>
                                <i class="icon-screen-desktop bg-primary"></i>
                                <div class="desc">
                                    <div class="title">iMac 4k</div>
                                    <small>Lorem ipsum dolor sit amet</small>
                                </div>
                                <div class="value">
                                    <div class="small text-muted">Sold this week</div>
                                    <strong>1.924</strong>
                                </div>
                                <div class="actions">
                                    <button type="button" class="btn btn-link text-muted"><i class="icon-settings"></i>
                                    </button>
                                </div>
                            </li>
                            <li>
                                <i class="icon-screen-smartphone bg-info"></i>
                                <div class="desc">
                                    <div class="title">Samsung Galaxy Edge</div>
                                    <small>Lorem ipsum dolor sit amet</small>
                                </div>
                                <div class="value">
                                    <div class="small text-muted">Sold this week</div>
                                    <strong>1.224</strong>
                                </div>
                                <div class="actions">
                                    <button type="button" class="btn btn-link text-muted"><i class="icon-settings"></i>
                                    </button>
                                </div>
                            </li>
                            <li>
                                <i class="icon-screen-smartphone bg-warning"></i>
                                <div class="desc">
                                    <div class="title">iPhone 6S</div>
                                    <small>Lorem ipsum dolor sit amet</small>
                                </div>
                                <div class="value">
                                    <div class="small text-muted">Sold this week</div>
                                    <strong>1.163</strong>
                                </div>
                                <div class="actions">
                                    <button type="button" class="btn btn-link text-muted"><i class="icon-settings"></i>
                                    </button>
                                </div>
                            </li>
                            <li>
                                <i class="icon-user bg-danger"></i>
                                <div class="desc">
                                    <div class="title">Premium accounts</div>
                                    <small>Lorem ipsum dolor sit amet</small>
                                </div>
                                <div class="value">
                                    <div class="small text-muted">Sold this week</div>
                                    <strong>928</strong>
                                </div>
                                <div class="actions">
                                    <button type="button" class="btn btn-link text-muted"><i class="icon-settings"></i>
                                    </button>
                                </div>
                            </li>
                            <li>
                                <i class="icon-social-spotify bg-success"></i>
                                <div class="desc">
                                    <div class="title">Spotify Subscriptions</div>
                                    <small>Lorem ipsum dolor sit amet</small>
                                </div>
                                <div class="value">
                                    <div class="small text-muted">Sold this week</div>
                                    <strong>893</strong>
                                </div>
                                <div class="actions">
                                    <button type="button" class="btn btn-link text-muted"><i class="icon-settings"></i>
                                    </button>
                                </div>
                            </li>
                            <li>
                                <i class="icon-cloud-download bg-danger"></i>
                                <div class="desc">
                                    <div class="title">Ebook</div>
                                    <small>Lorem ipsum dolor sit amet</small>
                                </div>
                                <div class="value">
                                    <div class="small text-muted">Downloads</div>
                                    <strong>121.924</strong>
                                </div>
                                <div class="actions">
                                    <button type="button" class="btn btn-link text-muted"><i class="icon-settings"></i>
                                    </button>
                                </div>
                            </li>
                            <li>
                                <i class="icon-camera bg-warning"></i>
                                <div class="desc">
                                    <div class="title">Photos</div>
                                    <small>Lorem ipsum dolor sit amet</small>
                                </div>
                                <div class="value">
                                    <div class="small text-muted">Uploaded</div>
                                    <strong>12.125</strong>
                                </div>
                                <div class="actions">
                                    <button type="button" class="btn btn-link text-muted"><i class="icon-settings"></i>
                                    </button>
                                </div>
                            </li>
                            <li class="divider text-center">
                                <button type="button" class="btn btn-sm btn-link text-muted" data-toggle="tooltip" data-placement="top" title="show more"><i class="icon-options"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <!--/.col-->
                </div>*/
                ?>
                <!--/.row-->
                <br>
                <table class="table table-hover table-outline mb-0 hidden-sm-down">
                    <thead class="thead-default">
                    <tr>
                        <th class="text-center"><i class="icon-people"></i>
                        </th>
                        <th class="text-center">用户</th>
                        <th class="text-center">状态</th>
                        <th class="text-center">电话</th>
                        <th class="text-center">邮箱</th>
                        <th class="text-center">会员组</th>
                        <th class="text-center">登陆</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($managers as $manager): ?>
                        <!-- row -->
                                <?php
//                                date('Y-m-d H:i:s', $manager->logintime);
//                                long2ip($manager->loginip);
//                                date("Y-m-d H:i:s", $manager->createtime);
                                ?>
                                <?php
                //                if (Yii::$app->session->hasFlash('info')) {
                //                    echo Yii::$app->session->getFlash('info');
                //                }
                                ?>
                    <tr>
                        <td class="text-center">
                            <div class="avatar">
                                <img src="/coreui/img/avatars/1.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                <span class="avatar-status badge-success"></span>
                            </div>
                        </td>
                        <td class="text-center">
                            <div><?= $manager->account; ?></div>
                            <div class="small text-muted">
                                <span>注册时间</span>| <?=date("Y-m-d H:i:s", $manager->create_time);?>
                            </div>
                        </td>
                        <?php
//                        <td class="text-center">
//                            <img src="/coreui/img/flags/USA.png" alt="USA" style="height:24px;">
//                        </td>
                        ?>
                        <td class="text-center">
                            <?=Yii::$app->params['sysadmin']['state'][1][$manager->state];?>
                        </td>
                        <td class="text-center">
                            <i class="fa fa-phone fa-lg"></i>
                            <?= $manager->phone;?>
                        </td>
                        <td class="text-center">
                            <i class="fa fa-envelope fa-lg"></i>
                            <?= $manager->email;?>
                        </td>
                        <td class="text-center">
                            <?=time()?>
                        </td>
                        <td class="text-center">
                            <?=long2ip($manager->login_ip);?>
                            <?=date("Y-m-d H:i:s", $manager->create_time);?>
                        </td>
                        <td class="text-center">
                            禁用
                            激活
                            <?php if ($manager->id != 1): ?>
                                <a href="<?php echo yii\helpers\Url::to(['user/del', 'id' => $manager->id]) ?>">删除</a>
                            <?php endif; ?>
                            编辑
                        </td>
                    </tr>
            <?php endforeach; ?>
                    </tbody>
                </table>

            <div class="pagination pull-right">
                <?= yii\widgets\LinkPager::widget([
                    'pagination' => $pager,
                    'prevPageLabel' => '&#8249;',
                    'nextPageLabel' => '&#8250;'
                ]); ?>
            </div>
            </div>
        </div>
    </div>
    <!--/.col-->
</div>
