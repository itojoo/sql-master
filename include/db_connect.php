<?php
/**
 * Created by PhpStorm.
 * User: leejiwoo
 * Date: 2017. 6. 10.
 * Time: 오후 6:52
 */
header("Content-Type: text/html; charset=UTF-8");

$db_host = "127.0.0.1";
$db_user = "root";
$db_password = "apmsetup";
$db_name = "firstboard";
$conn = mysqli_connect($db_host,$db_user,$db_password);
if(mysqli_connect_errno()){
    echo "Mysql 연결 오류".mysqli_connect_error();
}else{
    echo "Mysql 연결 성공~";
}
$sql = "set session character_set_connection=utf8;";
$conn -> query($sql);