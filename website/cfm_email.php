<?php
require_once '../inc/common.php';
require_once '../inc/judge_format.php';
require_once 'db/us_base.php';
require_once "../inc/common_agent_email_service.php";

header("cache-control:no-cache,must-revalidate");
header("Content-Type:application/json;charset=utf-8");

/*
========================== 邮箱验证确认 ==========================
GET参数
  cfm_hash        验证HASH
返回
  errcode = 0     请求成功
说明
*/

php_begin();
$args = array('cfm_hash');
chk_empty_args('GET', $args);

// 现在的时间戳
$now_time = time();
// 获取hash_code
$hash_code = $_GET['cfm_hash'];
$key = Config::TOKEN_KEY;
// 获取token并解码
$des = new Des();
$decryption_code = $des->decrypt($hash_code, $key);
$code_conf = explode(',', $decryption_code);
// 获取token中的需求信息
$us_id = $code_conf[0];
$email = $code_conf[1];
$timestamp = $code_conf[2];
$email_confirm = $code_conf[3];
$is_email = isEmail($email);
if (!$is_email) {
    exit_error('100', 'Email format not correct!');
}
if ($email_confirm != 'email') {
    $email_confirm = '注册';
} else {
    $email_confirm = '绑定';
}
$variable = 'email';
// 判断邮箱是否已存在
$row = get_us_id_by_variable($email);

if ($row) {
    // 判断是否注册完成
    if ($row['us_id'] && $row['flag'] == 1) {
        exit_error('105', '已注册用户，请登陆！');
    }
}

// 判断是否注册
if (!$row['us_id'] && ($email_confirm == '注册')) {
    exit_error('112', 'This email address is not registered');
}
//判断是否可以进行验证
if ($row['ctime'] > $now_time) {
    upd_reg_flag($us_id);
    exit_error('116', $row['limt_time'] - $now_time);

}

if (upd_pass_for_us_id($us_id)) {
    exit_ok();
} else {
    exit_error('101', "操作失败请重试");
}


