<?php
/**
 * Created by PhpStorm.
 * User: leejiwoo
 * Date: 2017. 6. 10.
 * Time: 오후 6:51
 */
include ('db_connect.php');

$title = $_GET['title'];
$content = $_GET['content'];
$name = $_GET['name'];
print_r($_GET);


$sql = "INSERT INTO board (title,content,`name`, date_add)
     VALUES ('$title','$content','$name', NOW())";
echo mysqli_query($conn,$sql);
echo $sql;


//echo ("<meta http-equiv='Refresh' content='1; URL=../person.php'>");

//$data = $_GET[];
//echo ($data);