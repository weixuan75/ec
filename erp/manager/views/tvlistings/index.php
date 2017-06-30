<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card-footer">
            <a href="<?=Url::to(['tvlistings/add']) ?>" class="btn btn-bg btn-primary"><i class="fa fa-dot-circle-o"></i> 添 加 节 目 </a>
        </div>
        <div class="card">
            <div class="card-header">
                节目列表
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
                        <tr>
                            <td class="text-center"><?=$manager->id?></td>
                            <td class="text-center"><?=$manager->name?></td>
                            <td class="text-center"><?=$manager->content?></td>
                            <td class="text-center"><?=$manager->user_id?></td>
                            <td class="text-center"><?=Yii::$app->params['tvlistings']['state'][1][$manager->state]?></td>
                            <td class="text-center">
                                <?=date("Y-m-d H:i:s", $manager->create_time)?>~<?=date("m-d H:i:s", $manager->update_time)?>
                            </td>
                            <td class="text-center">
                                禁用
                                激活
                                <a href="<?=Url::to(['user/del', 'id' => $manager->id]) ?>">删除</a>
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
