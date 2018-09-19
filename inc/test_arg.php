<?php
//======================================
// 函数: 取得自动测试数据
// 参数: $arg           字段名
// 返回: 测试数据
// 说明: config.php AUTO_TEST_FLAG = true 时有效
//======================================
function get_test_arg($arg)
{

  $args = array(
    'us_id'=>'640C3986-5EC2-EABA-59C1-B9C6EC4FF610',
    'email'=>'test@hivebanks.com',
    'pass_word_hash'=>'8cb2237d0679ca88db6464eac60da96345513964',
    'cfm_code'=>'1234',
    'invit_code'=>'ABCD5678',
    'country_code'=>'86',
    'cellphone'=>'13912345678',
    'token'=>'/cUJtHoz7CRGr9Dc56jGmoXIXaOsPPWJbaeicrzWlZqtxOVG1C6TuDmZj8LeHu/HNQuEaNsie7eHYl5h+YsT2g==',
    'text_type'=>'CONFIM_PASS',
    'hash_type'=>'ID',
    'text'=>'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
    'text_hash'=>'80256f39a9d308650ac90d9be9a72a9562454574',
    'log_id' =>'/cUJtHoz7CRGr9Dc50256f39a9d308650ac90d',
    'is_void' => '0',
    'pf_id' => '0256f39a9d3086506f39a9d308azWlZqtxOVG',
    'ba_id' => '641C3986-5EC2-EABA-59C1-B9C6EC4FF610',
    'bit_type' => '100',
    'bit_address' =>'JtHoz7CRGr9Dc56jGmoXIXaOsPPWJbaeicrzWlZqtxOVG1C69Dc50256f39a9d3086TuDmZj8LeHu/HNQuEaNsie7eHYl5h',
    'bit_addree' => 'JtHoz7CRGr9Dc56jGmoXIXaOsPPWJbaqweqweicrzWlZqtxOVG1C69Dc50256f39a9d3086TuDmZj8LeHu/HNQuEaNsie7eHYl5h',
    'bit_amount' => '156', 
    'chg_amount' => '300',
    'tx_hash' => 'f39a9d30865GmoXIXaOsPPWJbaeicrzWlZqtxOVG1C69Dc50256f39a06f39a9d308azWlZqt',
    'tx_id' => '642C3986-5EC2-EABA-59C1-B9C6EC4FF610',
    'file_type' => 'file',
    'file_url'  => '39a9d30865GmoXIXaOsPPWJbaeicrzWlZqtxOVG1C69Dc50256',
    'file_hash' => 'sPPWJbaeicrzWlZqtxOVG1C69Dc50256f39a06f39a9d308azW',
    'qa_id' => 'euihrfuewry8238472384huh3248fne35rye3yt345vgf6u76i',
    'withdraw_rate' => '0.98',
    'withdraw_min_amount' => '100',
    'withdraw_max_amount' => '10000',
    'limit_time' => '2019-09-08 00:00:00',
    'recharge_rate' => '0.83',
    'recharge_min_amount' => '100',
    'recharge_max_amount' => '10000',
    'tl_id' => '7CRGr9Dc56jGmoXIXaOsPPWJbaqweqweicrzWlZqtxOVG1C69Dc50256',
    'confirm_result' => '1',
  );

  if (array_key_exists($arg, $args))
    return $args[$arg];

  return 'test_' . $arg;

}
?>
