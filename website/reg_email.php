<?php
require_once '../inc/common.php';
require_once '../inc/judge_format.php';
require_once "db/us_base.php";
require_once "../inc/common_agent_email_service.php";
header("cache-control:no-cache,must-revalidate");
header("Content-Type:application/json;charset=utf-8");

/*
========================== 代理商注册（邮件） ==========================
GET参数
  email           Email地址
  pass_word_hash  密码HASH
  pass_word       原始密码
返回
  errcode = 0     请求成功
说明
  会调用send_email给注册邮箱发送验证链接，有效时间15分钟
*/
if (!isset($_SESSION)) {
    session_start();
}
php_begin();
$args = array('email', 'pass_word_hash', 'real_name', 'cfm_code');
chk_empty_args('GET', $args);

// Email地址
$email = get_arg_str('GET', 'email', 255);
$pass_word_hash = get_arg_str('GET', 'pass_word_hash');
$real_name = get_arg_str('GET', 'real_name');
$cfm_code = get_arg_str('GET', 'cfm_code');
$is_email = isEmail($email);
if (!$is_email) {
    exit_error('100', 'Email format not correct!');
}
if ($cfm_code != $_SESSION["authcode"])
    exit_error("139", "图形验证码有误");


// 创建用户ca_id
$us_id = get_guid();

// 用户基本信息数组
$data_base = array();
// 用户绑定信息数组

$variable = 'email';
// 当前时间戳
$timestamp = time();
// 判断邮箱是否已存在
$row = get_us_id_by_variable($email);

if ($row) {
    if ($row["flag"] == 1)
        exit_error("1", "该邮箱已注册");
    else {
        $teltime = 1;
        $teltime = strtotime($row['ctime']) + 15 * 60;
        if ($teltime > $timestamp) {
            //判断是否可以进行注册
            if ($row && $row['email'] == $email) {
                exit_error('121', '待确认，请前往邮箱验证');
            }
        } else {
            $url = 'http://ow.fnying.com/website/cfm_email.php';
            $timestamp += 15 * 60;
            $title = '邮箱验证链接';
            $des = new Des();
            $body = $url . "?cfm_hash=";
            $salt = rand(10000000, 99999999);
            $encryption_code = $row["us_id"] . ',' . $email . ',' . $timestamp . ',' . $salt;
            $body .= urlencode($des->encrypt($encryption_code, Config::TOKEN_KEY));

            $la_id = 'E0C27B19-00E3-CFDC-27F9-B9D534F2301F';
            $output_array = send_email_by_agent_service($email, $title, $body, $la_id);

            if ($output_array["errcode"] == "0") {
                $ret = upd_ctime_for_us_id($row['us_id'], date("Y-m-d H:i:s"));
                if ($ret) {
                    exit_ok('Please verify email as soon as possible!');
                } else {
                    exit_error('101', 'Create failed! Please try again!');
                }
            } else {
                exit_error('124', '邮件发送失败请稍后重试！');
            }
        }
    }
} else {
    // 基本信息参数设定
    $data_base['us_id'] = $us_id;

// 绑定参数设定
    $data_base['email'] = $email;
    $data_base['real_name'] = $real_name;
    $data_base['pass_word_hash'] = $pass_word_hash;
    $data_base['flag'] = '0';
    $data_base['ctime'] = date("Y-m-d H:i:s");
    $data_base['key_code'] = $us_id;

    $url = 'http://ow.fnying.com/website/cfm_email.php';

    $timestamp += 15 * 60;
    $title = '邮箱验证链接';
    $des = new Des();
    $body = $url . "?cfm_hash=";
    $salt = rand(10000000, 99999999);
    $encryption_code = $us_id . ',' . $email . ',' . $timestamp . ',' . $salt;
    $body .= urlencode($des->encrypt($encryption_code, Config::TOKEN_KEY));

    $la_id = 'E0C27B19-00E3-CFDC-27F9-B9D534F2301F';
    $output_array = send_email_by_agent_service($email, $title, $body, $la_id);

    if ($output_array["errcode"] == "0") {
        $ret = ins_reg_info($data_base);
        if ($ret) {
            exit_ok('Please verify email as soon as possible!');
        } else {
            exit_error('101', 'Create failed! Please try again!');
        }
    } else {
        exit_error('124', '邮件发送失败请稍后重试！');
    }


}


