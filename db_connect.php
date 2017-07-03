<?php
/**
 * Created by PhpStorm.
 * User: leejiwoo
 * Date: 2017. 6. 10.
 * Time: 오전 12:49
 */
$db_host = "127.0.0.1";
$db_user = "root";
$db_password = "sutoset";
$db_name = "firstdb";
$conn = new mysqli($db_host,$db_user,$db_password,$db_name);
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}