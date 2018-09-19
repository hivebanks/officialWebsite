<?php
/**
 * Created by PhpStorm.
 * User: liangyi
 * Date: 2018/8/31
 * Time: 上午11:15
 */
require_once "../inc/common.php";
require_once "db/development.php";

$rows = sel_development_info();

$rtn_ary = array();
$rtn_ary['errcode'] = '0';
$rtn_ary['errmsg'] = '';
$rtn_ary['rows'] = $rows;
$rtn_str = json_encode($rtn_ary);

php_end($rtn_str);