<?php
/**
 * Created by PhpStorm.
 * User: leejiwoo
 * Date: 2017. 6. 10.
 * Time: 오전 12:49
 */
$db_host = "127.0.0.1";
$db_user = "root";
$db_password = "";
$db_name = "firstdb";
$conn = mysqli_connect($db_host,$db_user,$db_password,$db_name);
if (mysqli_connect_errno($conn)){
    echo "데이터 베이스 연결 실패".mysqli_connect_errno();
}else{
    echo "성공~!";
}