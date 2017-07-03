<?php
/**
 * Created by PhpStorm.
 * User: leejiwoo
 * Date: 2017. 6. 10.
 * Time: 오후 6:52
 */
 error_reporting(E_ALL & ~E_NOTICE);
 ini_set("display_errors",1);

header("Content-Type: text/html; charset=UTF-8");

$db_host = "127.0.0.1";
$db_user = "root";
$db_password = "autoset";
$db_name = "firstboard";
$conn = mysqli_connect($db_host,$db_user,$db_password);
if(mysqli_connect_errno()){
    echo "Mysql 연결 오류".mysqli_connect_error();
}else{
    //echo "Mysql 연결 성공~";
}
mysqli_select_db($conn,$db_name); 
$sql = "set session character_set_connection=utf8;";
//mysqli_query($conn,$sql);