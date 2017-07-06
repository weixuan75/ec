<?php
use yii\helpers\Html;
use yii\helpers\Url;
if (Yii::$app->session->hasFlash('info')) {
    echo Yii::$app->session->getFlash('info');
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="card-footer">
            <a href="<?=Url::to(['tv/add']) ?>" class="btn btn-bg btn-primary"><i class="fa fa-dot-circle-o"></i> 添 加 电 视 </a>
        </div>
        <div class="card">
            <div class="card-header">
                电视列表
            </div>
            <div class="card-block">
                <table class="table table-hover table-outline mb-0 hidden-sm-down">
                    <thead class="thead-default">
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">名称</th>
                        <th class="text-center">介绍</th>
                        <th class="text-center">操作员</th>
                        <th class="text-center">状态</th>
                        <th class="text-center">时间</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($managers as $manager): ?>
                        <tr id="list_<?=$manager->id?>">
                            <td class="text-center"><?=$manager->id?></td>
                            <td class="text-center"><?=$manager->name?></td>
                            <td class="text-center"><?=$manager->content?></td>
                            <td class="text-center"><?=\app\erp\models\Sysadmindate::findOne($manager->user_id)['nickname']?></td>
                            <td class="text-center"><?=Yii::$app->params['tvlistings']['state'][1][$manager->state]?></td>
                            <td class="text-center">
                                <?=date("Y-m-d H:i:s", $manager->create_time)?>~<?=date("m-d H:i:s", $manager->update_time)?>
                            </td>
                            <td class="text-center">
                                <a href="<?=Url::to(['tv/show', 'tv_id' => $manager->id,'reqURL'=>($hostURL."#list_".$manager->id)]) ?>">详情</a>
                                <?php
                                if ((boolean)$manager->state) {
                                    ?>
                                    <a href="<?= Url::to(['/manager/tv/tvstate', 'id' => $manager->id,'state'=>0,'reqURL'=>(Url::to(['/manager/tvlistings'])."#list_".$manager->id)]) ?>"
                                       >禁用</a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="<?= Url::to(['/manager/tv/tvstate', 'id' => $manager->id,'state'=>1,'reqURL'=>(Url::to(['/manager/tvlistings'])."#list_".$manager->id)]) ?>"
                                       >启动</a>
                                    <?php
                                }
                                ?>
                                <a href="<?=Url::to(['tv/del', 'id' => $manager->id,'reqURL'=>(Url::to(['/manager/tv'])."#tvData_".$manager->id)]) ?>">删除</a>
                                <a href="<?=Url::to(['/manager/tv/edit','id'=>$manager->id,'reqURL'=>(Url::to(['/manager/tv/edit'])."#tvData_".$manager->id)]) ?>">编辑</a>
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
                <?php
//
//                echo "获取域名或主机地址"."<br>";
//                echo $_SERVER['HTTP_HOST']."<br>"; #localhost
//
//                echo "获取网页地址"."<br>";
//                echo $_SERVER['PHP_SELF']."<br>"; #/blog/testurl.php
//
//                echo "获取网址参数"."<br>";
//                echo $_SERVER["QUERY_STRING"]."<br>"; #id=5
//
//                echo "获取用户代理"."<br>";
//                echo $_SERVER['HTTP_REFERER']."<br>";
//
//                echo "获取完整的url"."<br>";
//                echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."<br>";
//                echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']."<br>";
//                #http://localhost/blog/testurl.php?id=5
//
//                echo "包含端口号的完整url"."<br>";
//                echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]."<br>";
//                #http://localhost:80/blog/testurl.php?id=5
//
//                echo "只取路径"."<br>";
//                $url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]."<br>";
//                echo dirname($url);
                ?>
            </div>
        </div>
    </div>
    <!--/.col-->
</div>
