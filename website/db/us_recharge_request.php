<?php
/**
 * Created by IntelliJ IDEA.
 * User: liangyi
 * Date: 2018/9/11
 * Time: 上午9:45
 */

function us_recharge_quest($data) {


    $db = new DB_COM();
    $sql = $db ->sqlInsert("us_recharge_request", $data);
    $q_id = $db->query($sql);
    if (!$q_id){
        exit_error("133", "创建充值订单失败");
    }

    return $q_id;
}

function get_recharge_list($us_id,$type)
{
    $db = new DB_COM();
    $sql = "SELECT * FROM us_recharge_request WHERE us_id = '{$us_id}' and type = '{$type}'";
    $db->query($sql);
    $rows = $db->fetchAll();
    return $rows;
}
