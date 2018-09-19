<?php
/**
 * Created by PhpStorm.
 * User: liangyi
 * Date: 2018/8/31
 * Time: 上午11:32
 */


function ins_contact_us_info($data_base)
{

    $db = new DB_COM();
    $sql = $db ->sqlInsert("contact_us", $data_base);
    $q_id = $db->query($sql);
    if ($q_id == 0)
        return false;
    return true;
}


function sel_contact_us_info($ip)
{

    $db = new DB_COM();
    $sql = "select * from contact_us where ip = '{$ip}' order by id desc limit 1";
    $db->query($sql);
    $row = $db->fetchRow();
    return $row;
}
