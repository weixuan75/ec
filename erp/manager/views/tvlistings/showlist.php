<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="icon-film"></i><?=$tvs->name ?>
            </div>
            <div class="card-block">
                'ID',<?=$tvs->id ?>
                <br>'名称',<?=$tvs->name ?>
                <br>'周{0，1，2，3，4，5，6}',<?=$tvs->weeks ?>
                <br>'天{[开始时间，结束时间]，[12321354，12321354]，[12321354，12321354]}',<?=$tvs->day ?>
                <br>'播放的店铺：0/null,全部店铺播放，[1,2,3,4]',<?=$tvs->shop_id ?>
                <br> '状态',<?=$tvs->state ?>
                <br>'设置默认，等于1时，失效的店铺播放默认的电视节目单',<?=$tvs->is_conf ?>
                <br>'介绍',<?=$tvs->content ?>
                <br>'操作员',<?=$tvs->user_id ?>
                <br>'创建时间',<?=$tvs->create_time ?>
                <br>'修改时间',<?=$tvs->update_time ?>
            </div>
            <div class="card-footer">
                <a href="<?=Url::to(['tvlistings/add']) ?>" class="btn btn-bg btn-primary"><i class="fa fa-dot-circle-o"></i> 添 加 内 容 </a>
                <a href="<?=$reqURL = (boolean)$reqURL ? $reqURL : Url::to(['manager/tvlistings']) ?>" class="btn btn-bg btn-danger"><i class="fa fa-dot-circle-o"></i> 返 回 列 表 </a>
            </div>
        </div>
    </div>
    <!--/.col-->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                节目内容列表
            </div>
            <div class="card-block">
                <div class="card-block">
                    <div class="col-sm-6 col-md-4">
                        <div class="btn btn-secondary btn-lg btn-block text-center">
                            <i class="icon-plus icons d-block" style="font-size: 10em"></i>
                        </div>
                    </div>
                </div>
                <script src="/layer/layer.js"></script>
                <script>
                    //页面层
                    layer.open({
                        type: 1,
                        skin: 'layui-layer-rim', //加上边框
//                        area: ['420px', '240px'], //宽高
                        content: '<form method="post" role="form">' +
                        '<div class="card-block">' +
                        '<div class="form-group field-tvlistingsdata-sort required">' +
                            '<label class="control-label" for="tvlistingsdata-sort">排序</label>' +
                            '<input type="text" id="tvlistingsdata-sort" class="form-control" name="TvlistingsData[sort]" aria-required="true">' +
                            '<p class="help-block help-block-error"></p>' +
                        '</div>' +
                        '<div class="form-group field-tvlistingsdata-name required">' +
                            '<label class="control-label" for="tvlistingsdata-name">名称</label>' +
                            '<input type="text" id="tvlistingsdata-name" class="form-control" name="TvlistingsData[name]" aria-required="true">' +
                            '<p class="help-block help-block-error"></p>' +
                        '</div>' +
                        '<div class="form-group field-tvlistingsdata-path required">' +
                        '<label class="control-label" for="tvlistingsdata-path">路径</label>' +
                        '<input type="text" id="tvlistingsdata-path" class="form-control" name="TvlistingsData[path]" aria-required="true">' +
                        '<p class="help-block help-block-error"></p>' +
                        '</div>' +
                        '<div class="form-group field-tvlistingsdata-type required">' +
                        '<label class="control-label" for="tvlistingsdata-type">类型：1图片，2视频</label>' +
                        '<input type="text" id="tvlistingsdata-type" class="form-control" name="TvlistingsData[type]" aria-required="true">' +
                        '<p class="help-block help-block-error"></p>' +
                        '</div>' +
                        '<div class="form-group field-tvlistingsdata-pay_time required">' +
                        '<label class="control-label" for="tvlistingsdata-pay_time">播放时间（秒）</label>' +
                        '<input type="text" id="tvlistingsdata-pay_time" class="form-control" name="TvlistingsData[pay_time]" aria-required="true">' +
                        '<p class="help-block help-block-error"></p>' +
                        '</div>' +
                        '<div class="form-group field-tvlistingsdata-state">' +
                        '<label class="control-label">状态</label>' +
                        '<input type="hidden" name="TvlistingsData[state]" value="">' +
                        '<div id="tvlistingsdata-state" value="0">' +
                        '<div class="radio"><label>' +
                        '<input type="radio" name="TvlistingsData[state]" value="0" checked="">' +
                        '<span class="badge badge-success">激活</span>' +
                        '</label>' +
                        '</div>' +
                        '<div class="radio">' +
                            '<label>' +
                            '<input type="radio" name="TvlistingsData[state]" value="1">' +
                            ' <span class="badge badge-danger">禁用</span>' +
                            '</label>' +
                            '</div>' +
                            '</div>' +
                            '<p class="help-block help-block-error"></p>' +
                        '</div>' +
                        '<div class="form-group field-tvlistingsdata-content required">' +
                            '<label class="control-label" for="tvlistingsdata-content">介绍</label>' +
                            '<input type="text" id="tvlistingsdata-content" class="form-control" name="TvlistingsData[content]" aria-required="true">' +
                            '<p class="help-block help-block-error"></p>' +
                        '</div>' +
                        '</div>' +
                        '<div class="card-footer">' +
                            '<button type="submit" class="btn btn-bg btn-primary"><i class="fa fa-dot-circle-o"></i> 提 交 </button>' +
                            '<button type="reset" class="btn btn-bg btn-danger"><i class="fa fa-ban"></i> 取 消 </button>' +
                        '</div>' +
                        '</form>'
                    });
                </script>

            </div>
        </div>
    </div>
    <!--/.col-->
</div>
