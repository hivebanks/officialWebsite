<?php
require_once '../inc/common.php';
require_once 'db/us_base.php';

require_once '../inc/judge_format.php';


header("cache-control:no-cache,must-revalidate");
header("Content-Type:application/json;charset=utf-8");

/*
========================== 代理商登录（邮件） ==========================
GET参数
  email           Email地址
  pass_word_hash  密码HASH
返回
  errcode = 0     请求成功
  token            用户TOKEN
说明
  登录成功返回用户TOKEN,有效期2小时
*/

php_begin();
if (!isset($_SESSION)) {
    session_start();
}
$args = array('email', 'pass_word_hash','cfm_code');
chk_empty_args('GET', $args);

$timestamp = time();
// Email地址
$email = get_arg_str('GET', 'email', 255);
// 密码HASH
$pass_word_hash = get_arg_str('GET', 'pass_word_hash');
// 验证码
$cfm_code = get_arg_str('GET', 'cfm_code');
// 加盐加密代码
$salt = rand(10000000, 99999999);
// 密钥
$key = Config::TOKEN_KEY;
// 判断email地址是否有效
$is_email = isEmail($email);
if(!$is_email){
    exit_error('109','Email format not correct!');
}
if ($cfm_code != $_SESSION["authcode"])
    exit_error("139","图形验证码有误");
// 记录数组
$row_fail = array();
$variable = 'email';

// 判断该邮箱用户是否存在
$row = get_us_id_by_variable($email);

// 判断用户是否注册
if($row['us_id'] == null || $row['flag'] == 9){
    exit_error('112','This email address is not registered');
}elseif ($row['flag'] == 2){
    exit_error('118','该账号暂未审核通过');
}elseif ($row['flag'] == 3){
    exit_error('137','该账号被拒绝');
}

// 判断密码是否正确
$check_pass = check_pass($row['us_id'],$pass_word_hash);
if(!$check_pass){
    exit_error("1","密码错误");
}

// 生成token
$timestamp += 2*60*60;
$des = new Des();
$encryption_code = $row['us_id'] .',' . $timestamp . ',' . $salt;
$token = $des -> encrypt($encryption_code, $key);
//记录参数整理
$lgn_type = 'email';
$ca_ip = get_ip();
$ip_area = getIpInfo($ca_ip);
$utime = time();
$ctime = date('Y-m-d H:i:s');

// 返回数据做成
$rtn_ary = array();
$rtn_ary['errcode'] = '0';
$rtn_ary['errmsg'] = '';
$rtn_ary['token'] = $token;
$rtn_str = json_encode($rtn_ary);
php_end($rtn_str);
