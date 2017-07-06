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
            ['禁用','启动'],
            [
                '<span class="badge badge-danger">禁用</span>',
                '<span class="badge badge-success">启动</span>',
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
    'uploadFileCon'=>json_decode('{
  "imageActionName":"uploadimage",
  "imageFieldName":"upfile",
  "imageMaxSize":2048000,
  "imageAllowFiles":[
    ".png",
    ".jpg",
    ".jpeg",
    ".gif",
    ".bmp"],
  "imageCompressEnable":true,
  "imageCompressBorder":1600,
  "imageInsertAlign":"none",
  "imageUrlPrefix":"",
  "imagePathFormat":"/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}",
  "scrawlActionName":"uploadscrawl",
  "scrawlFieldName":"upfile",
  "scrawlPathFormat":"/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}",
  "scrawlMaxSize":2048000,
  "scrawlUrlPrefix":"",
  "scrawlInsertAlign":"none",
  "snapscreenActionName":"uploadimage",
  "snapscreenPathFormat":"/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}",
  "snapscreenUrlPrefix":"",
  "snapscreenInsertAlign":"none",
  "catcherLocalDomain":["127.0.0.1",
    "localhost"],"catcherActionName":"catchimage",
  "catcherFieldName":"source",
  "catcherPathFormat":"/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}",
  "catcherUrlPrefix":"",
  "catcherMaxSize":2048000,
  "catcherAllowFiles":[".png",
    ".jpg",
    ".jpeg",
    ".gif",
    ".bmp"],
  "videoActionName":"uploadvideo",
  "videoFieldName":"upfile",
  "videoPathFormat":"/upload/video/{yyyy}{mm}{dd}/{time}{rand:6}",
  "videoUrlPrefix":"",
  "videoMaxSize":102400000,
  "videoAllowFiles":[".flv",
    ".swf",
    ".mkv",
    ".avi",
    ".rm",
    ".rmvb",
    ".mpeg",
    ".mpg",
    ".ogg",
    ".ogv",
    ".mov",
    ".wmv",
    ".mp4",
    ".webm",
    ".mp3",
    ".wav",
    ".mid"],
  "fileActionName":"uploadfile",
  "fileFieldName":"upfile",
  "filePathFormat":"/upload/file/{yyyy}{mm}{dd}/{time}{rand:6}",
  "fileUrlPrefix":"",
  "fileMaxSize":51200000,
  "fileAllowFiles":[".png",
    ".jpg",
    ".jpeg",
    ".gif",
    ".bmp",
    ".flv",
    ".swf",
    ".mkv",
    ".avi",
    ".rm",
    ".rmvb",
    ".mpeg",
    ".mpg",
    ".ogg",
    ".ogv",
    ".mov",
    ".wmv",
    ".mp4",
    ".webm",
    ".mp3",
    ".wav",
    ".mid",
    ".rar",
    ".zip",
    ".tar",
    ".gz",
    ".7z",
    ".bz2",
    ".cab",
    ".iso",
    ".doc",
    ".docx",
    ".xls",
    ".xlsx",
    ".ppt",
    ".pptx",
    ".pdf",
    ".txt",
    ".md",
    ".xml"],
  "imageManagerActionName":"listimage",
  "imageManagerListPath":"/upload/image/",
  "imageManagerListSize":20,
  "imageManagerUrlPrefix":"",
  "imageManagerInsertAlign":"none",
  "imageManagerAllowFiles":[".png",
    ".jpg",
    ".jpeg",
    ".gif",
    ".bmp"],
  "fileManagerActionName":"listfile",
  "fileManagerListPath":"/upload/file/",
  "fileManagerUrlPrefix":"",
  "fileManagerListSize":20,
  "fileManagerAllowFiles":[".png",
    ".jpg",
    ".jpeg",
    ".gif",
    ".bmp",
    ".flv",
    ".swf",
    ".mkv",
    ".avi",
    ".rm",
    ".rmvb",
    ".mpeg",
    ".mpg",
    ".ogg",
    ".ogv",
    ".mov",
    ".wmv",
    ".mp4",
    ".webm",
    ".mp3",
    ".wav",
    ".mid",
    ".rar",
    ".zip",
    ".tar",
    ".gz",
    ".7z",
    ".bz2",
    ".cab",
    ".iso",
    ".doc",
    ".docx",
    ".xls",
    ".xlsx",
    ".ppt",
    ".pptx",
    ".pdf",
    ".txt",
    ".md",
    ".xml"]}',true),
];

