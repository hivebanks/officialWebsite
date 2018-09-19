<?php
/**
 * Created by PhpStorm.
 * User: liangyi
 * Date: 2018/8/31
 * Time: 上午11:32
 */


function sel_development_info()
{

    $db = new DB_COM();
    $sql = "select * from development order by id asc ";
    $db->query($sql);
    $rows = $db->fetchAll();
    return $rows;
}
