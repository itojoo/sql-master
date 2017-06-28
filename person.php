<?php

include ('include/db_connect.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Title</title>
</head>
<body>
<form action="include/db_insert.php" method="get">
    <label for="name">이름 : </label><input type="text" name="name">
    <label for="title">제목 : </label><input type="text" name="title">
    <label for="content">내용 : </label><input type="text" name="content">
    <input type="submit" value="작성">
</form>

<?
//mysqli_select_db($conn,"firstboard"); //$conn->select_db("test3_db");
$sql= "select name, title, content from board";
$result = mysqli_query($conn,$sql);
echo "
<table>

";
if($result === FALSE) { 
    yourErrorHandler(mysqli_error($mysqli));
}
else{
	while($row=mysqli_fetch_array($result)){
		echo "
		<tr>
			<td>{$row['name']}</td>
			<td>{$row['title']}</td>
			<td>{$row['content']}</td>
		<tr>
		";
	}
}
/*
*/
?>
</body>
</html>