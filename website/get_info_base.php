<?php
require_once '../inc/common.php';
require_once 'db/us_base.php';
require_once 'db/com_option_config.php';
header("cache-control:no-cache,must-revalidate");
header("Content-Type:application/json;charset=utf-8");

php_begin();
if (!isset($_SESSION)) {
    session_start();
}
$args = array('token');
chk_empty_args('GET', $args);
$token = get_arg_str('GET', 'token', 128);
$us_id = check_token($token);

$row = get_info_by_id($us_id);

// 返回数据做成
$rtn_ary = array();
$rtn_ary['errcode'] = '0';
$rtn_ary['errmsg'] = '';
$rtn_ary['row'] = $row;
$rtn_str = json_encode($rtn_ary);
php_end($rtn_str);
