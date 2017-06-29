<?php
namespace app\erp\util;
/**
 * User: weixuan
 * Date: 2017/6/29
 * Time: 9:33
 */
class SysConf
{
    /**
     * 唯一ID值
     * @param string $prefix
     * @return string
     */
    function uuid($prefix = ''){
        $chars = md5(uniqid(mt_rand(), true));
        $uuid  = substr($chars,0,8) . '-';
        $uuid .= substr($chars,8,4) . '-';
        $uuid .= substr($chars,12,4) . '-';
        $uuid .= substr($chars,16,4) . '-';
        $uuid .= substr($chars,20,12);
        return $prefix . $uuid;
    }
}