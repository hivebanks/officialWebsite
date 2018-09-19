<?php
/**
 * Created by PhpStorm.
 * User: liangyi
 * Date: 2018/8/31
 * Time: 上午11:29
 */

require_once "../inc/common.php";
require_once "db/contact_us.php";
//php_begin();

$args = array('first_name', 'last_name','email',"content");
chk_empty_args('GET', $args);

$first_name = get_arg_str('GET', 'first_name');
$last_name = get_arg_str('GET', 'last_name');
$email = get_arg_str('GET', 'email');
$content = get_arg_str('GET', 'content');


$data = array();

if (sel_contact_us_info(get_ip())["limit_time"]+3*60 > time())
    exit_error("1","Please submit later.");

$data["ip"] = get_ip();
$data["first_name"] = $first_name;
$data["last_name"] = $last_name;
$data["email"] = $email;
$data["content"] = $content;
$data["limit_time"] = time();


if (!ins_contact_us_info($data))
    exit_error("1","failure");
else
    exit_ok();



