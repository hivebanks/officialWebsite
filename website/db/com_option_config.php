<?php
/**
 * Created by IntelliJ IDEA.
 * User: liangyi
 * Date: 2018/9/10
 * Time: 下午4:17
 */
function get_com_price($type)
{
    $db = new DB_COM();
    $sql = "SELECT * FROM com_option_config WHERE option_name = '{$type}'";
    $db -> query($sql);
    $row = $db -> fetchAll();
    return $row;
}