<?php
/**
 * Created by PhpStorm.
 * User: leejiwoo
 * Date: 2017. 6. 10.
 * Time: 오후 6:52
 */
header("Content-Type: text/html; charset=UTF-8");

$db_host = "114.200.199.84";
$db_user = "root";
$db_password = "dnjfanWkd";
$db_name = "test3_db";
$conn = mysqli_connect($db_host,$db_user,$db_password);
if(mysqli_connect_errno()){
    echo "Mysql 연결 오류".mysqli_connect_error();
}else{
    echo "Mysql 연결 성공~";
}