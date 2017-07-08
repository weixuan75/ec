# 系统管理员
DROP TABLE IF EXISTS `ec_sys_admin`;
CREATE TABLE IF NOT EXISTS `ec_sys_admin` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '系统会员ID',
  `account` varchar(20) NOT NULL COMMENT '账号',
  `email` varchar(100) NOT NULL COMMENT '电子邮件',
  `phone` varchar(15) NOT NULL COMMENT '电话',
  `password` varchar(500) DEFAULT NULL COMMENT '密码',
  `state` TINYINT(4) DEFAULT '0' COMMENT '状态',
  `token_code` varchar(200) DEFAULT NULL COMMENT 'token码',
  `autho_code` varchar(200) DEFAULT NULL COMMENT '认证码',
  `login_ip` varchar(40) DEFAULT NULL COMMENT '登陆IP地址',
  `login_time` bigint(20) DEFAULT NULL COMMENT '登陆时间',
  `sys_group_id` int(11) DEFAULT NULL COMMENT '会员组',
  `create_time` bigint(20) DEFAULT NULL COMMENT '创建时间',
  `update_time` bigint(20) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sys_admin_account` (`account`),
  UNIQUE KEY `sys_admin_email` (`email`),
  UNIQUE KEY `sys_admin_phone` (`phone`),
  KEY `sys_admin_account_password` (`account`,`password`),
  KEY `sys_admin_email_password` (`email`,`password`),
  KEY `sys_admin_phone_password` (`phone`,`password`),
  UNIQUE KEY `sys_admin_autho_code` (`autho_code`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='系统管理员主表';
# 系统管理员详细表
DROP TABLE IF EXISTS `ec_sys_admin_date`;
CREATE TABLE IF NOT EXISTS `ec_sys_admin_date` (
  `sys_admin_id` bigint NOT NULL COMMENT '系统会员ID',
  `nickname` varchar(20) NOT NULL COMMENT '昵称',
  `birthday` BIGINT NOT NULL COMMENT '生日',
  `head_portrait` varchar(300) DEFAULT NULL COMMENT '头像',
  `adress` varchar(200) DEFAULT NULL COMMENT '家庭住址',
  `tabbing` varchar(40) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`sys_admin_id`),
  UNIQUE KEY `sys_admin_date_nickname` (`nickname`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='系统管理员资料';
# 系统会员组
DROP TABLE IF EXISTS `ec_sys_group`;
CREATE TABLE IF NOT EXISTS `ec_sys_group` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '会员组ID',
  `sys_group_pid` int NOT NULL COMMENT '父级组ID',
  `name` varchar(20) NOT NULL COMMENT '组名称',
  `ename` varchar(50) NOT NULL COMMENT '组英文名称',
  `content` varchar(500) NOT NULL COMMENT '组介绍',
  `sys_admin_id` varchar(36) DEFAULT NULL COMMENT '组管理员',
  `state` TINYINT DEFAULT '0' COMMENT '状态',
  `create_time` bigint DEFAULT NULL COMMENT '创建时间',
  `update_time` bigint DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sys_group_name` (`name`),
  UNIQUE KEY `sys_group_ename` (`ename`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='系统会员组';
#系统角色组
DROP TABLE IF EXISTS `ec_sys_role`;
CREATE TABLE IF NOT EXISTS `ec_sys_role` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '组ID',
  `sys_role_pid` int NOT NULL COMMENT '父级组ID',
  `name` varchar(20) NOT NULL COMMENT '组名称',
  `ename` varchar(50) NOT NULL COMMENT '组英文名称',
  `content` varchar(15) NOT NULL COMMENT '组介绍',
  `sys_admin_id` varchar(36) DEFAULT NULL COMMENT '角色管理员',
  `state` TINYINT DEFAULT '0' COMMENT '状态',
  `create_time` bigint DEFAULT NULL COMMENT '创建时间',
  `update_time` bigint DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sys_role_name` (`name`),
  UNIQUE KEY `sys_role_ename` (`ename`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='系统角色';
#系统组对角色
DROP TABLE IF EXISTS `ec_sys_group_role`;
CREATE TABLE IF NOT EXISTS `ec_sys_group_role` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `sys_role_id` int NOT NULL COMMENT '父级组ID',
  `sys_group_id` int NOT NULL COMMENT '父级组ID',
  `update_time` bigint DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='系统会员组和角色的中间表';
#系统功能
DROP TABLE IF EXISTS `ec_sys_function`;
CREATE TABLE IF NOT EXISTS `ec_sys_function` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '方法ID',
  `name` varchar(20) NOT NULL COMMENT '方法名称',
  `ename` varchar(50) NOT NULL COMMENT '组英文名称',
  `content` varchar(15) NOT NULL COMMENT '组介绍',
  `url` varchar(36) DEFAULT NULL COMMENT '授权URL',
  `fun_code` VARCHAR(500) DEFAULT NULL COMMENT '方法代码',
  `state` TINYINT DEFAULT '0' COMMENT '状态',
  `create_time` bigint DEFAULT NULL COMMENT '创建时间',
  `update_time` bigint DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sys_function_name` (`name`),
  UNIQUE KEY `sys_function_name_ename` (`ename`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='系统方法';
#系统功能角色
DROP TABLE IF EXISTS `ec_sys_role_function`;
CREATE TABLE IF NOT EXISTS `ec_sys_role_function` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `sys_role_id` int NOT NULL COMMENT '角色ID',
  `sys_fun_id` int NOT NULL COMMENT '方法ID',
  `update_time` bigint DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='系统方法组和角色的中间表';

# 管理员日志表
DROP TABLE IF EXISTS `ec_sys_function`;
CREATE TABLE IF NOT EXISTS `ec_sys_function` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '方法ID',
  `name` varchar(20) NOT NULL COMMENT '方法名称',
  `ename` varchar(50) NOT NULL COMMENT '组英文名称',
  `content` varchar(15) NOT NULL COMMENT '组介绍',
  `url` varchar(36) DEFAULT NULL COMMENT '授权URL',
  `fun_code` VARCHAR(500) DEFAULT NULL COMMENT '方法代码',
  `state` TINYINT DEFAULT '0' COMMENT '状态',
  `create_time` bigint DEFAULT NULL COMMENT '创建时间',
  `update_time` bigint DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sys_function_name` (`name`),
  UNIQUE KEY `sys_function_name_ename` (`ename`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='系统方法';

# 管理员日志表
DROP TABLE IF EXISTS `ec_log_sys_admin`;
CREATE TABLE IF NOT EXISTS `ec_log_sys_admin` (
  `id` BIGINT NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `admin_id` BIGINT NOT NULL COMMENT '管理员ID',
  `content` TEXT NOT NULL COMMENT '操作内容',
  `state` TINYINT DEFAULT '0' COMMENT '状态',
  `tag` TINYINT DEFAULT NULL COMMENT '操作标签',
  `time` bigint DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='管理员登陆日志表';


/**
广告
 */
#广告操作日志表
#广告版位
##名称
##类型
-- 矩形横幅
-- 固定位置
-- 漂浮移动
-- 对联广告
-- 图片轮换
-- 图片列表
-- 文字广告
-- 代码广告
-- 尺寸
--     宽
--     高
-- 描述

#广告模板表
--   标题
--   所属版位
--   广告类型
--     图片
--     动画
--   上线时间
--   下线时间
--   图片地址
--   文字提示

#广告参数表

#广告列表

# 附件表

DROP TABLE IF EXISTS `ec_sys_attachment`;
CREATE TABLE IF NOT EXISTS `ec_sys_attachment` (
  `id` int(10) UNSIGNED NOT NULL  COMMENT '附件ID',
  `name` char(50) NOT NULL  COMMENT '附件名称',
  `path` char(200) NOT NULL  COMMENT '附件路径',
  `size` int(10) UNSIGNED NOT NULL DEFAULT '0'  COMMENT '附件大小',
  `ext` char(10) NOT NULL  COMMENT '扩展名',
  `user_id` BIGINT UNSIGNED NOT NULL DEFAULT '0'  COMMENT '操作员ID',
  `uploadtime` BIGINT UNSIGNED NOT NULL DEFAULT '0'  COMMENT '上传时间',
  `upload_ip` VARCHAR(30) NOT NULL  COMMENT '上传IP',
  `stat` tinyint NOT NULL DEFAULT '0'  COMMENT '状态',
  `authcode` char(32) NOT NULL  COMMENT '附件路径MD5值',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='附件表';

# 菜单表
DROP TABLE IF EXISTS `ec_menu`;
CREATE TABLE IF NOT EXISTS `ec_menu` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `menu_pid` int NOT NULL COMMENT '父级ID',
  `name` varchar(100) NOT NULL COMMENT '名称',
  `ename` varchar(100) NOT NULL COMMENT '英文名称',
  `content` varchar(500) NOT NULL COMMENT '介绍',
  `url` varchar(500) NOT NULL COMMENT 'url',
  `sys_admin_id` varchar(36) DEFAULT NULL COMMENT '管理员',
  `state` TINYINT DEFAULT '0' COMMENT '状态',
  `create_time` bigint DEFAULT NULL COMMENT '创建时间',
  `update_time` bigint DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_name` (`name`),
  UNIQUE KEY `menu_ename` (`ename`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='菜单';

# 平台表
DROP TABLE IF EXISTS `ec_platform`;
CREATE TABLE IF NOT EXISTS `ec_platform` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(100) NOT NULL COMMENT '名称',
  `ename` varchar(100) NOT NULL COMMENT '英文名称',
  `content` varchar(500) NOT NULL COMMENT '介绍',
  `sys_admin_id` varchar(36) DEFAULT NULL COMMENT '管理员',
  `auth_code` varchar(36) DEFAULT NULL COMMENT '授权码',
  `state` TINYINT DEFAULT '0' COMMENT '状态',
  `create_time` bigint DEFAULT NULL COMMENT '创建时间',
  `update_time` bigint DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `platform_name` (`name`),
  UNIQUE KEY `platform_ename` (`ename`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='平台';

# 仓库主表
# 仓库会员表
# 仓库操作日志表
# 仓库入库订单表
# 仓库入库记录表

# 仓库库存记录表

# 仓库出库记录表
# 仓库出库订单表

# 店铺
DROP TABLE IF EXISTS `ec_store`;
CREATE TABLE IF NOT EXISTS `ec_store` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '店铺ID',
  `code` varchar(200) NOT NULL COMMENT '店铺编号',
  `name` varchar(100) NOT NULL COMMENT '店铺名称',
  `ename` varchar(100) NOT NULL COMMENT '店铺英文名称',
  `image` varchar(200) NOT NULL COMMENT '店铺照片',
  `images` varchar(1000) NOT NULL COMMENT '店内照片',
  `content` varchar(1000) NOT NULL COMMENT '店铺介绍',
  `phone` varchar(200) NOT NULL COMMENT '店铺联系电话',
  `map_location` varchar(200) NOT NULL COMMENT '地图定位',
  `adress` varchar(200) NOT NULL COMMENT '店铺地址',
  `shop_use_id` BIGINT DEFAULT NULL COMMENT '店铺负责人ID',
  `state` TINYINT DEFAULT '0' COMMENT '状态',
  `create_time` bigint DEFAULT NULL COMMENT '创建时间',
  `update_time` bigint DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ec_store_name` (`name`),
  UNIQUE KEY `ec_store_ename` (`ename`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='店铺主表';
# 店铺用户表
DROP TABLE IF EXISTS `ec_store_user`;
CREATE TABLE IF NOT EXISTS `ec_store_user` (
  `id` BIGINT NOT NULL AUTO_INCREMENT COMMENT '主键',
  `store_id` BIGINT NOT NULL COMMENT '店铺ID',
  `user_id` BIGINT NOT NULL COMMENT '用户ID',
  `state` TINYINT DEFAULT '0' COMMENT '状态',
  `job` TINYINT DEFAULT '0' COMMENT '职位：1、老板，2、店员',
  `create_time` bigint DEFAULT NULL COMMENT '创建时间',
  `update_time` bigint DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='店铺会员关联';
# 店铺购物车
# 店铺收藏记录表
# 店铺销货订单表
# 店铺进货订单表
# 店铺销货记录表
# 店铺进货记录表

-- --------------------------------------------------------------------
# 用户主表
DROP TABLE IF EXISTS `ec_user`;
CREATE TABLE IF NOT EXISTS `ec_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `account` varchar(20) NOT NULL COMMENT '账号',
  `email` varchar(50) NOT NULL COMMENT '电子邮件',
  `phone` varchar(15) NOT NULL COMMENT '电话',
  `password` varchar(500) DEFAULT NULL COMMENT '密码',
  `state` TINYINT(4) DEFAULT '0' COMMENT '状态',
  `autho_code` varchar(36) DEFAULT NULL COMMENT '认证码',
  `token_code` varchar(36) DEFAULT NULL COMMENT 'token码',
  `login_ip` varchar(40) DEFAULT NULL COMMENT '登陆IP地址',
  `login_time` bigint(20) DEFAULT NULL COMMENT '登陆时间',
  `sys_group_id` int(11) DEFAULT NULL COMMENT '会员组',
  `create_time` bigint(20) DEFAULT NULL COMMENT '创建时间',
  `update_time` bigint(20) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ec_user_account` (`account`),
  UNIQUE KEY `ec_user_email` (`email`),
  UNIQUE KEY `ec_user_phone` (`phone`),
  UNIQUE KEY `ec_user_autho_code` (`autho_code`),
  UNIQUE KEY `ec_user_token_code` (`token_code`),
  KEY `ec_user_account_password` (`account`,`password`),
  KEY `ec_user_email_password` (`email`,`password`),
  KEY `ec_user_phone_password` (`phone`,`password`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='会员主表';
# 用户资料
DROP TABLE IF EXISTS `ec_user_date`;
CREATE TABLE IF NOT EXISTS `ec_user_date` (
  `user_id` BIGINT NOT NULL COMMENT '会员ID',
  `autho_code` varchar(36) DEFAULT NULL COMMENT '认证码',
  `nickname` varchar(20) NOT NULL COMMENT '昵称',
  `birthday` BIGINT NOT NULL COMMENT '生日',
  `head_portrait` varchar(300) DEFAULT NULL COMMENT '头像',
  `adress` varchar(200) DEFAULT NULL COMMENT '家庭住址',
  `tabbing` varchar(40) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `sys_admin_date_nickname` (`nickname`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='会员资料';
# 用户地址
DROP TABLE IF EXISTS `ec_user_adress`;
CREATE TABLE IF NOT EXISTS `ec_user_adress` (
  `user_id` BIGINT NOT NULL COMMENT '会员ID',
  `autho_code` varchar(200) DEFAULT NULL COMMENT '认证码',
  `adress` text NOT NULL COMMENT '地址JSON',
  `time` bigint DEFAULT NULL COMMENT '创建修改时间',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `ec_user_adress_autho_code` (`autho_code`),
  KEY `ec_user_adress_autho_code` (`user_id`,`autho_code`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='用户地址表';

# 用户群组表
DROP TABLE IF EXISTS `ec_user_group`;
CREATE TABLE IF NOT EXISTS `ec_user_group` (
  `user_id` BIGINT NOT NULL COMMENT '会员ID',
  `autho_code` varchar(200) DEFAULT NULL COMMENT '认证码',
  `adress` text NOT NULL COMMENT '地址JSON',
  `time` bigint DEFAULT NULL COMMENT '创建修改时间',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `ec_user_adress_autho_code` (`autho_code`),
  KEY `ec_user_adress_autho_code` (`user_id`,`autho_code`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='用户地址表';

# 用户等级表

# 用户分销表

# 用户等级表
# 用户积分表
# 用户余额表
# 用户购物车
# 用户订单表
# 用户支付记录表
# 用户浏览表
# 用户收藏表

# 电视节目表
DROP TABLE IF EXISTS `ec_tvlistings`;
CREATE TABLE IF NOT EXISTS `ec_tvlistings` (
  `id` BIGINT NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(100) NOT NULL COMMENT '名称',
  `ename` varchar(100) NOT NULL COMMENT '英文名称',
  `weeks` varchar(100) NOT NULL COMMENT '周{0，1，2，3，4，5，6}',
  `day` varchar(100) NOT NULL COMMENT '天{[开始时间，结束时间]，[12321354，12321354]，[12321354，12321354]}',
  `shop_id` varchar(500) NOT NULL COMMENT '播放的店铺：0/null,全部店铺播放，[1,2,3,4]',
  `state` TINYINT DEFAULT '0' COMMENT '状态',
  `is_conf` TINYINT DEFAULT '0' COMMENT '设置默认，等于1时，失效的店铺播放默认的电视节目单',
  `content` varchar(500) NOT NULL COMMENT '介绍',
  `user_id` BIGINT DEFAULT NULL COMMENT '操作员',
  `create_time` bigint DEFAULT NULL COMMENT '创建时间',
  `update_time` bigint DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tvlistings_name` (`name`),
  UNIQUE KEY `tvlistings_ename` (`ename`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='电视节目主单';

# 电视节目表
DROP TABLE IF EXISTS `ec_tvlistings_data`;
CREATE TABLE IF NOT EXISTS `ec_tvlistings_data` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sort` BIGINT NOT NULL COMMENT '排序',
  `tv_id` BIGINT NOT NULL COMMENT '父级ID',
  `name` varchar(100) NOT NULL COMMENT '名称',
  `path` varchar(300) NOT NULL COMMENT '路径',
  `type` TINYINT NOT NULL COMMENT '类型：1图片，2视频',
  `pay_time` TINYINT NOT NULL COMMENT '播放时间（秒）',
  `state` TINYINT DEFAULT '0' COMMENT '状态',
  `content` varchar(500) NOT NULL COMMENT '介绍',
  `user_id` BIGINT DEFAULT NULL COMMENT '操作员',
  `create_time` bigint DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tvlistings_name` (`name`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='电视节目详细内容';
# 电视节目单播放情况

# 产品主表
DROP TABLE IF EXISTS `ec_product`;
CREATE TABLE IF NOT EXISTS `ec_product` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '方法ID',
  `one_image` int NOT NULL COMMENT '父级方法ID',
  `title` varchar(20) NOT NULL COMMENT '方法名称',
  `ename` varchar(50) NOT NULL COMMENT '组英文名称',
  `content` varchar(15) NOT NULL COMMENT '组介绍',
  `url` varchar(36) DEFAULT NULL COMMENT '角色管理员',
  `state` TINYINT DEFAULT '0' COMMENT '状态',
  `create_time` bigint DEFAULT NULL COMMENT '创建时间',
  `update_time` bigint DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`title`),
  UNIQUE KEY `ename` (`ename`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='产品基本信息';

# 产品资料
DROP TABLE IF EXISTS `ec_product_data`;
CREATE TABLE IF NOT EXISTS `ec_product_data` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '方法ID',
  `sys_fun_pid` int NOT NULL COMMENT '父级方法ID',
  `name` varchar(20) NOT NULL COMMENT '方法名称',
  `ename` varchar(50) NOT NULL COMMENT '组英文名称',
  `content` varchar(15) NOT NULL COMMENT '组介绍',
  `url` varchar(36) DEFAULT NULL COMMENT '角色管理员',
  `state` TINYINT DEFAULT '0' COMMENT '状态',
  `create_time` bigint DEFAULT NULL COMMENT '创建时间',
  `update_time` bigint DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `ename` (`ename`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='产品详细信息';

# 产品模型
DROP TABLE IF EXISTS `ec_model_product`;
CREATE TABLE IF NOT EXISTS `ec_model_product` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '方法ID',
  `sys_fun_pid` int NOT NULL COMMENT '父级方法ID',
  `name` varchar(20) NOT NULL COMMENT '方法名称',
  `ename` varchar(50) NOT NULL COMMENT '组英文名称',
  `content` varchar(200) NOT NULL COMMENT '组介绍',
  `url` varchar(36) DEFAULT NULL COMMENT '角色管理员',
  `state` TINYINT DEFAULT '0' COMMENT '状态',
  `create_time` bigint DEFAULT NULL COMMENT '创建时间',
  `update_time` bigint DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `ename` (`ename`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT ='产品参数';


Select ec_tv.name,B.name from A inner join B on A.id=B.id

select
  *
from
    ec_tvandtvlistings left join ec_tv on ec_tvandtvlistings.tv_id=ec_tv.id
   left join ec_tvlistings on ec_tvandtvlistings.tvl_id=ec_tvlistings.id
   ec_tvlistings right join ec_tvlistings_data on ec_tvlistings.id=ec_tvlistings_data.tv_id

SELECT * FROM
  ec_tv,ec_tvandtvlistings,ec_tvlistings,ec_tvlistings_data
WHERE
  ec_tv.id=4
AND ec_tv.id=ec_tvandtvlistings.tv_id
AND ec_tvandtvlistings.tvl_id=ec_tvlistings.id
AND ec_tvlistings.id = ec_tvlistings_data.tv_id
AND ec_tv.state=1
AND ec_tv.state=ec_tvlistings.state
AND ec_tvlistings.state = ec_tvlistings_data.state;

SELECT
  i.num_iid, i.title, i.price, SUM(iv.user_visits)
  AS uv,it.buyer_num,it.item_num,it.item_num*i.price
  AS turnover
FROM (
    items AS i
    RIGHT JOIN
    item_visit_stats AS iv
      ON i.num_iid=iv.num_iid
  )
  LEFT JOIN (
              SELECT
                num_iid,SUM(buyer_num) AS buyer_num,SUM(item_num) AS item_num
              FROM
                item_trade_stats
              WHERE
                seller_nick="XXXX" AND business_day
                BETWEEN '2010-08-14' AND '2010-08-15' GROUP BY num_iid
            )
    AS it ON it.num_iid=iv.num_iid
WHERE i.nick="XXXX" AND iv.business_day BETWEEN '2010-08-14' AND '2010-08-15'
GROUP BY i.num_iid ORDER BY uv DESC
