<?php
/**
 * Created by IntelliJ IDEA.
 * User: liangyi
 * Date: 2018/9/10
 * Time: 下午5:36
 */

function get_bit_account($us_id)
{
    $db = new DB_COM();
    //充值信息存在，返回原先的地址
    $sql = "SELECT * FROM asset_account WHERE  bind_us_id = '{$us_id}' limit 1";
    $db->query($sql);
    $rows = $db->fetchRow();
    if ($rows["bind_flag"] == 1) {
        return $rows;
    }

    //分配新的地址
    $sql = "SELECT * FROM asset_account WHERE  bind_flag = '0' limit 1";
    $db->query($sql);
    $rows = $db->fetchRow();
    return $rows;
}
