<?php
/**
 * Created by IntelliJ IDEA.
 * User: liangyi
 * Date: 2018/9/10
 * Time: 下午1:39
 */
function get_us_id_by_variable($email)
{
    $db = new DB_COM();
    $sql = "SELECT * FROM us_base WHERE email = '{$email}' ORDER BY utime DESC LIMIT 1 ";
    $db -> query($sql);
    $row = $db -> fetchRow();
    return $row;
}
function ins_reg_info($data)
{
    $db = new DB_COM();
    $sql = $db->sqlInsert("us_base", $data);
    $q_id = $db->query($sql);
    if ($q_id == 0)
        return false;
    return true;
}

function upd_pass_for_us_id($us_id)
{
    $db = new DB_COM();
    $sql = "UPDATE us_base SET flag = 1 WHERE us_id = '{$us_id}'";
    $db -> query($sql);
    $count = $db -> affectedRows();
    return $count;
}
function upd_reg_flag($us_id)
{
    $db = new DB_COM();
    $sql = "UPDATE us_base SET flag = 9 WHERE us_id = '{$us_id}'";
    $db -> query($sql);
    $count = $db -> affectedRows();
    return $count;
}
function check_pass($us_id,$pass_word_hash)
{
    $db = new DB_COM();
    $sql = "SELECT * FROM us_base WHERE us_id = '{$us_id}' AND pass_word_hash = '{$pass_word_hash}'  AND flag = '1'";
    $db -> query($sql);
    $count = $db -> affectedRows();
    return $count;
}

function upd_ctime_for_us_id($us_id,$time)
{
    $db = new DB_COM();
    $sql = "UPDATE us_base SET ctime = '{$time}' WHERE us_id = '{$us_id}'";
    $db -> query($sql);
    $count = $db -> affectedRows();
    return $count;
}
function get_info_by_id($us_id)
{
    $db = new DB_COM();
    $sql = "SELECT * FROM us_base WHERE us_id = '{$us_id}' ORDER BY utime DESC LIMIT 1 ";
    $db -> query($sql);
    $row = $db -> fetchRow();
    return $row;
}