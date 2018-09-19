<?php
require_once '../inc/common.php';
require_once 'db/us_recharge_request.php';

header("cache-control:no-cache,must-revalidate");
header("Content-Type:application/json;charset=utf-8");

php_begin();

$args = array('token','type');
chk_empty_args('GET', $args);
$token = get_arg_str('GET', 'token', 128);
$us_id = check_token($token);

$type = get_arg_str('GET', 'type');

if($type == "sms" || $type == "email" || $type == "upload_file"){


}else
    exit_error("1","非法字段");
// 密码HASH


$rows = get_recharge_list($us_id,$type);

// 返回数据做成
$rtn_ary = array();
$rtn_ary['errcode'] = '0';
$rtn_ary['errmsg'] = '';
$rtn_ary['rows'] = $rows;
$rtn_str = json_encode($rtn_ary);
php_end($rtn_str);
