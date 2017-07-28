<?php

include ('db_connect.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Title</title>
</head>
<body>
<?php
$uid=$_GET['uid'];

$sql= "select `name`, title, content, date_add, date_delete from board where uid = '$uid'";
$result = mysqli_query($conn,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
if($row=mysqli_fetch_array($result)){
	echo "
		<div>이름 : {$row['name']}</div>
		<div>제목 :{$row['title']}</div>
		<div>{$row['content']}</div>
		<div>추가일 : {$row['date_add']}</div>
		<div>삭제일 : {$row['date_del']}</div>
	";
}
echo"<div><a href='bbs_frm.php?uid=$uid'>수정</a> <a href='bbs_frm.php?re_uid=$uid'>답변</a> <a href='bbs_lst.php'>목록</a></div>"
?>
</body>
</html>

