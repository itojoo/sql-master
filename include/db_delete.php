<?php
/**
 * Created by PhpStorm.
 * User: leejiwoo
 * Date: 2017. 6. 10.
 * Time: 오후 6:51
 */
include ('db_connect.php');

$uid = $_GET['uid'];
print_r($_GET);

//if() 삭제> 리스트 안나오게 

/*$sql = "INSERT INTO board (uid, date_delete)
     VALUES ('$uid', NOW())";*/
$sql = "UPDATE board
        SET date_delete = NOW()
        WHERE uid = '$uid'";
echo mysqli_query($conn,$sql);
echo $sql;


//echo ("<meta http-equiv='Refresh' content='1; URL=../person.php'>");

//$data = $_GET[];
//echo ($data);