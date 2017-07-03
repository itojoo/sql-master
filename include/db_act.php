<?php
/**
 * Created by PhpStorm.
 * User: leejiwoo
 * Date: 2017. 6. 10.
 * Time: 오후 6:51
 */
include ('db_connect.php');

$mod = $_GET['mod'];
$uid = $_GET['uid'];
$title = $_GET['title'];
$content = $_GET['content'];
$name = $_GET['name'];
print_r($_GET);

//if() 삭제> 리스트 안나오게 

$sql = "INSERT INTO board (title,content,`name`, date_add)
     VALUES ('$title','$content','$name', NOW())";
echo mysqli_query($conn,$sql);
echo $sql;


//echo ("<meta http-equiv='Refresh' content='1; URL=../person.php'>");

//$data = $_GET[];
//echo ($data);