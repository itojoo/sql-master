<?php
/**
 * Created by PhpStorm.
 * User: leejiwoo
 * Date: 2017. 6. 10.
 * Time: 오후 6:51
 */
include ('db_connect.php');

// Change database to "test3_db"
//mysqli_select_db($conn,"firstboard"); //$conn->select_db("test3_db");

$title = $_GET['title'];
$content = $_GET['content'];
$name = $_GET['name'];
print_r($title);




$sql = "INSERT INTO board (title,content,name)
     VALUES ('$title','$content','$name')";
$conn -> query(
    $sql
);
echo $sql;
$conn -> close();

//echo ("<meta http-equiv='Refresh' content='1; URL=../person.php'>");

//$data = $_GET[];
//echo ($data);