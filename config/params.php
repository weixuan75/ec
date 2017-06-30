<?php

return [
    'adminEmail' => 'admin@example.com',
//    系统用户状态
    'sysadmin'=>[
        'list'=>10,
        'state'=>[
            ['未激活','激活','禁用','删除'],
            [
                '<span class="badge badge-warning">未激活</span>',
                '<span class="badge badge-success">激活</span>',
                '<span class="badge badge-danger">禁用</span>',
                '<span class="badge badge-default">删除</span>'
            ],
        ],
    ],
//    菜单状态
    'menu'=>[
        'list'=>10,
        'state'=>[
            ['启动','禁用'],
            [
                '<span class="badge badge-success">激活</span>',
                '<span class="badge badge-danger">禁用</span>',
            ]
        ],
    ],
//    菜单状态
    'tvlistings'=>[
        'list'=>10,
        'state'=>[
            ['启动','禁用'],
            [
                '<span class="badge badge-success">激活</span>',
                '<span class="badge badge-danger">禁用</span>',
            ]
        ],
        'is_conf'=>[
            ['默认','关闭'],
            [
                '<span class="badge badge-success">默认</span>',
                '<span class="badge badge-danger">关闭</span>',
            ]
        ],
        'weeks'=>["周日","周一","周二","周三","周四","周五","周六",],
    ],
];
