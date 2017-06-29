<?php

return [
    'adminEmail' => 'admin@example.com',
//    系统用户状态
    'admin'=>[
        'list'=>10
    ],
    'sysadmin'=>[
        ['未激活','激活','禁用','删除'],
        [
            '<span class="badge badge-warning">未激活</span>',
            '<span class="badge badge-success">激活</span>',
            '<span class="badge badge-danger">禁用</span>',
            '<span class="badge badge-default">删除</span>'],
        ],
//    菜单状态
    'menu'=>[
        'list'=>10
    ],
    'menuState'=>[
        ['启动','禁用'],
        [
            '<span class="badge badge-success">激活</span>',
            '<span class="badge badge-danger">禁用</span>',
        ]
    ]
];
